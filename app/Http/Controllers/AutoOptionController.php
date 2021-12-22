<?php

namespace App\Http\Controllers;

use App\AutoMainOption;
use App\AutoOption;
use App\AutoOptionDetail;
use Illuminate\Http\Request;

class AutoOptionController extends Controller
{
    public function index()
    {
        $option = AutoOption::paginate(15);
        $mainOptions = AutoMainOption::paginate(15);
        $optionDetails = AutoOptionDetail::paginate(15);

        return view("admin.auto-option.index",compact([
            'option', 'mainOptions', 'optionDetails'
        ]));
    }

    public function storeOption(Request $request)
    {
        $request->validate([
            "name" => "required|string|unique:auto_options,name"
        ]);

        AutoOption::create($request->all());

        return redirect()->back();
    }

    public function storeOptionSecondary(Request $request)
    {
        $request->validate([
            "name" => "required|string|unique:auto_main_options,name"
        ]);

        AutoMainOption::create($request->all());

        return redirect()->back();
    }

    public function storeOptionThird(Request $request)
    {
        $request->validate([
            "name" => "required|string|unique:auto_option_details,name"
        ]);

        AutoOptionDetail::create($request->all());

        return redirect()->back();
    }
}
