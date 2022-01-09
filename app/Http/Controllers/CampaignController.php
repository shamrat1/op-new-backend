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
        # code...
    }

    public function store(Request $request)
    {
        # code...
    }

    public function edit($id)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        # code...
    }
}
