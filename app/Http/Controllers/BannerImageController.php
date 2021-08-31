<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\BannerImage;
use File;


class BannerImageController extends Controller
{
    public function addBanner(Request $request){
    	$banner = BannerImage::get();
    	return view('admin.banners.addbanner',compact('banner'));
    }

    public function delete($id)
    {
        $banner = BannerImage::find($id);
        dd(File::exists('uploads/banner/' . $banner->image));
        if (File::exists('uploads/banner/'.$banner->image)) {
            File::delete('uploads/banner/' . $banner->image);
        }
        $banner->delete();
        return redirect()->back();
    }

    public function changeStatus($id)
    {
        $banner = BannerImage::find($id);
        $banner->isEnabled = !$banner->isEnabled;
        $banner->update();

        return redirect()->back();
    }

    public function store(Request $request)
    {
         $this->validate($request,[
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/banner/',$filename);

            $banner = new BannerImage();
            $banner->image = $filename;

            $banner->isEnabled = 0;
            $banner->save();

            Session::flash('success', 'Banner created successfully');
            return redirect(route('banners.addbanner'));
        }else{
            //return $request;
            return redirect()->back()->withErrors("No Image found");
        }

        
    }
}
