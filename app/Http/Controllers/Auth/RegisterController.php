<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Club;
use App\Credit;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $clubs = Club::get();

        if($request->hasAny(['sponser','club'])){

            $input = $request->only(['sponser', 'club']);

            
                $validator = Validator::make($input, [
                    'sponser' => 'required_unless:club,null|email|exists:users,email',
                    'club' => 'required_unless:sponser,null|integer|exists:clubs,id'
                ]);
            

            if ($validator->fails()) {
                // dd($validator->errors());
                if($validator->errors()->has(['sponser','club'])){
                    alertify()->error('Sponser & Club both are not valid');
                    return view('auth.register')->with('clubs', $clubs);
                }else if ($validator->errors()->first('club')) {
                    alertify()->error("Club is not valid.");
                    return view('auth.register')->with([
                        'clubs' => $clubs,
                        'sponserEmail' => $input['sponser']
                    ]);
                } else {
                    alertify()->error("Sponser email is not valid.");
                    return view('auth.register')->with([
                        'clubs' => $clubs,
                        'selectedClub' => $input['club']
                    ]);
                }
            } else {
                return view('auth.register')->with([
                    'clubs' => $clubs,
                    'selectedClub' => $input['club'],
                    'sponserEmail' => $input['sponser']
                ]);
            }
        }

        
        return view('auth.register')->with('clubs', $clubs);
        
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
    try{
        DB::beginTransaction();
        $user = $this->create(array_merge($request->all(),['name'=>$request->username]));

        Credit::create([
            'user_id' => $user->id,
            'amount' => 0
        ]);

        $this->guard()->login($user);
        DB::commit();
    }catch(Exception $e){
        DB::rollBack();
        dd($e);
    }
        
        alertify()->success("Account Created. check your email for varification.");
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['nullable', 'string', 'max:255'],
            'username' => ['required','string','min:4','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required','string','min:4'],
            'sponser' => ['nullable','string','max:255','exists:users,username'],
            'mobile' => ['required','numeric','digits_between:11,13'],
            'club_id' => ['nullable','numeric']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $sponser = User::where('username',$data["sponser"])->first();
        // dd(empty($data['club_id']));
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'mobile' => $data['mobile'],
            'sponser_email' => empty($sponser->email) ? 'onplay365@gmail.com' : $sponser->email,
            'club_id' => empty($data['club_id']) ? 1 : $data['club_id']
        ]);
    }
}
