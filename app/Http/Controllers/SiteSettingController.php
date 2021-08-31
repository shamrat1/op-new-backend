<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use App\PaymentSetting;
use App\BetSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index(){
        $setting = SiteSetting::get()->first();
        $payment = PaymentSetting::get()->first();
        $bet = BetSetting::get()->first();
        return view('admin.setting.index',compact(['setting','payment','bet']));
    }

    public function createOrPatch(Request $request){
        // @dd($request->all());
        $this->validate($request,[
            'betting' => 'required|boolean',
            'backend_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'notice' => 'nullable|string',
            'withdraw_date' => 'required|numeric|digits_between:1,2',
            'isDepositable' => 'required|boolean',
            'isWithdrawable' => 'required|boolean',
        ]);
            // dd($request->all());
        if($request->has('id')){
            SiteSetting::find($request->input('id'))->update([
                'betting' => $request->input('betting'),
                'backend_number' => $request->input('backend_number'),
                'notice' => $request->input('notice'),
                'withdraw_date' => $request->input('withdraw_date'),
                'isWithdrawable' => $request->input('isWithdrawable'),
                'isDepositable' => $request->input('isDepositable')
            ]);
            return redirect()->back();
        }else{
            SiteSetting::create([
               'betting' => $request->input('betting'),
               'backend_number' => $request->input('backend_number'),
               'notice' => $request->input('notice'),
                'withdraw_date' => $request->input('withdraw_date'),
                'isDepositable' => 'required|boolean',
                'isWithdrawable' => 'required|boolean',
            ]);
            return redirect()->back();
        }
    }

    public function paymentCreateOrPatch(Request $request){
        $this->validate($request,[
            'lowest_amount' => 'required|integer',
            'highest_amount' => 'required|integer'
        ]);

        if($request->has('id')){
            PaymentSetting::find($request->id)->update($request->all());
        }else{
            PaymentSetting::create($request->all());
        }

        return redirect()->back();
    
    }


    public function betCreateOrPatch(Request $request){

        $this->validate($request,[
            'lowest_amount' => 'required|integer',
            'highest_amount' => 'required|integer'
        ]);
        
        if($request->has('id')){
            BetSetting::find($request->id)->update($request->all());
        }else{
            BetSetting::create($request->all());
        }
        return redirect()->back();
    }
}
