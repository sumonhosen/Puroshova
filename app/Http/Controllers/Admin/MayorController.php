<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mayor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MayorController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:website-settings']);
    }

    public function index()
    {
        $mayors = DB::table('mayors')->get();
        return view('admin.mayor.mayor-panel-view', compact('mayors'));
    }

    public function create()
    {
        return view('admin.mayor.mayor-panel-add');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'place' => 'required|max:255',
            'serial' => 'required|numeric',
            'mobile' => 'required|min:11|max:11',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/mayor'), $imageName);
            Mayor::create([
                'name' => $request->name,
                'place' => $request->place,
                'mobile' => $request->mobile,
                'serial' => $request->serial,
                'image' => $imageName,
                'created_by' => auth()->id()
            ]);
            return redirect(route('admin.web.mayor'))->with('message', 'Mayor Added');
        }

    }


    public function delete($id)
    {
        $old = DB::table('mayors')->where('id', $id)->first();
        if (file_exists(public_path('uploads/mayor/' . $old->image))) {
            unlink(public_path('uploads/mayor/' . $old->image));
        }

        $delete = Mayor::find($id)->delete();
        return redirect(route('admin.web.mayor'))->with('error', 'Mayor Deleted');
    }

    public function edit($id)
    {
        $mayor = Mayor::find($id)->first();
        return view('admin.mayor.mayor-panel-edit', compact('mayor'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'place' => 'required|max:255',
            'serial' => 'required|numeric',
            'mobile' => 'required|min:11|max:11',
            'image' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = array();
        $data['name'] = $request->name;
        $data['place'] = $request->place;
        $data['mobile'] = $request->mobile;
        $data['serial'] = $request->serial;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/mayor'), $imageName);

            $data['image'] = $imageName;

            $old = DB::table('mayors')->where('id', $id)->first();
            if (file_exists(public_path('uploads/mayor/' . $old->image))) {
                unlink(public_path('uploads/mayor/' . $old->image));
            }

        }

        $update = DB::table('mayors')->where('id', $id)->update($data)->with('message', 'Mayor Updated');
        return redirect(route('admin.web.mayor'));
    }
}
