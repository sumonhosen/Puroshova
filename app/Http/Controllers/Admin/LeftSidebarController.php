<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeftSideApplication;
use App\Models\LeftSideBanner;
use DB;
use Illuminate\Support\Facades\Validator;

class LeftSidebarController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:website-settings']);
    }

    public function appView()
    {
        $left_apps = LeftSideApplication::all()->sortByDesc('created_at');
        return view('admin.sidebar.left-app', compact('left_apps'));
    }

    public function app_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'link' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        LeftSideApplication::create([
            'title' => $request->title,
            'link' => $request->link,
            'created_by' => auth()->id()
        ]);
        return redirect()->back()->with('success', 'Application Information Added Successfull');;
    }

    public function app_delete($id)
    {
        $delete = DB::table('left_side_applications')->where('id', $id)->delete();
        return redirect(route('admin.web.left.app'));
    }


    public function left_app_edit($id)
    {
        $left_app = LeftSideApplication::find($id);
        return view('admin.sidebar.left-app-edit', compact('left_app'));
    }

    public function app_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'link' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = array();
        $data['title'] = $request->title;
        $data['link'] = $request->link;

        $update = DB::table('left_side_applications')->where('id', $id)->update($data);
        return redirect(route('admin.web.left.app'));
    }


    public function bannerView()
    {
        $left_banners = LeftSideBanner::all()->sortByDesc('created_at');
        return view('admin.sidebar.left-banner', compact('left_banners'));
    }

    public function banner_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'information_type' => 'required|string',
            'description' => 'required|string',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/leftside/'), $imageName);

            $data = LeftSideBanner::create([
                'title' => $request->title,
                'information_type' => $request->information_type,
                'description' => $request->description,
                'photo' => $imageName,
                'created_by' => auth()->id()
            ]);
            return redirect()->back()->with('success', 'Banner Information Added Successfull');
        }
    }

    public function banner_delete($id)
    {

        $old = DB::table('left_side_banners')->where('id', $id)->first();
        if (file_exists(public_path('uploads/leftside/' . $old->photo))) {
            unlink(public_path('uploads/leftside/' . $old->photo));
        }

        $delete = DB::table('left_side_banners')->where('id', $id)->delete();
        return redirect(route('admin.web.left.banner'));
    }


    public function banner_edit($id)
    {
        $left_banner = LeftSideBanner::find($id);
        return view('admin.sidebar.left-banner-edit', compact('left_banner'));
    }

    public function banner_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'information_type' => 'required|string',
            'description' => 'required|string',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = array();
        $data['title'] = $request->title;
        $data['information_type'] = $request->information_type;
        $data['description'] = $request->description;

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/leftside'), $imageName);

            $data['photo'] = $imageName;

            $old = DB::table('left_side_banners')->where('id', $id)->first();
            if (file_exists(public_path('uploads/leftside/' . $old->image))) {
                unlink(public_path('uploads/leftside/' . $old->image));
            }

        }

        $update = DB::table('left_side_banners')->where('id', $id)->update($data);
        return redirect(route('admin.web.left.banner'));
    }


}
