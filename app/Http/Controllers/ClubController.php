<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Http\Traits\AdminAlertify;
use App\User;
use App\Role;
use App\Transaction;

class ClubController extends Controller
{
    use AdminAlertify;
    
    public function index(){
        $users = User::get();
        $clubs = Club::with('users','owner')->get();
        return view('admin.club.index',compact('clubs','users'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'user_id' => 'required|numeric|exists:users,id|unique:clubs,user_id'
        ]);

        // save club
        Club::create($request->only('name','user_id'));

        // set role of club owner
        $roleId = Role::where('name','Club Owner')->first()->id;
        $owner = User::find($request->user_id);
        // dd($roleId,$owner);
        $owner->roles()->attach($roleId);
        $this->showSuccessAlert("A new Club added successfully.");
        return redirect()->back();
    }

    public function getClubStatement()
    {
        if(auth()->user()->hasRole('CLub Owner')){
            $users = auth()->user()->ownClub->users;
            $transactions = Transaction::whereType('onBet')->whereIn('user_id',collect($users)->pluck('id')->toArray())->orderBy('id','desc')->paginate(50);
            return view('pages.account.statement',compact('transactions'));
        }
        return redirect()->back();
        
    }

    public function getFollowerHistory($username)
    {
        $user = User::whereUsername($username)->with('placedBets','placedBets.match')->first();
    }
}
