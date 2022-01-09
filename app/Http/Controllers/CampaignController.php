<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(20);
        return view('admin.campaign.index',compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaign.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|unique:campaigns,name",
            "effective_on" => "required|string",
            "min_amount" => "required|string",
            "max_amount" => "required|string",
            "status" => "required|string",
            "reward_amount" => "required|string",
            "amount_type" => "required|string",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ]);
        Campaign::create($request->all());

        return redirect()->route("campaign.index");
    }

    public function edit($id)
    {
        $campaign = Campaign::find($id);
        return view("admin.campaign.edit",compact('campaign'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string|unique:campaigns,name,$id",
            "effective_on" => "required|string",
            "min_amount" => "required|string",
            "max_amount" => "required|string",
            "status" => "required|string",
            "reward_amount" => "required|string",
            "amount_type" => "required|string",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ]);
        $campaign = Campaign::find($id);
        $campaign->update($request->all());
        return redirect()->route("campaign.index");
    }
}
