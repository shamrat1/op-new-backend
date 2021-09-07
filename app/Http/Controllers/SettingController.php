<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::get();
        return view("admin.setting.setting",compact("settings"));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            "key" => "required|string",
            "value" => "required|string",
        ]);
        Setting::updateOrCreate([
            "key" => Str::slug(strtolower($request->key)),
        ],[
            "value" => $request->value,
        ]);

        return redirect()->back();
    }
}
