<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMayor;
use App\Models\ProfessionalMayor;
use App\Models\Uno;
use App\Models\Admin;
use App\Models\AdminOther;
use App\Models\Info;
use App\Models\Engineer;
use App\Models\OtherEmployee;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:website-settings']);
    }

    public function mayor()
    {
        $professional_mayors = ProfessionalMayor::all();
        return view('admin.contact.mayor', compact('professional_mayors'));
    }

    public function mayor_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mayor_name' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
            'email' => 'required|max:255',
            'father' => 'required|max:255',
            'mother' => 'required|max:255',
            'date_birth' => 'required|max:50',
            'present_address' => 'required|max:255',
            'permanent_address' => 'required|max:255',
            'nationality' => 'required|max:50',
            'religion' => 'required|max:50',
            'gender' => 'required|max:10',
            'marital_status' => 'required|max:10',
            'latest_degree' => 'required|max:255',
            'blood_group' => 'required|max:20'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        ContactMayor::create([
            'mayor_name' => $request->mayor_name,
            'contact' => $request->contact,
            'email' => $request->email,
            'father' => $request->father,
            'mother' => $request->mother,
            'date_birth' => $request->date_birth,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'nationality' => $request->nationality,
            'religion' => $request->religion,
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'latest_degree' => $request->latest_degree,
            'blood_group' => $request->blood_group,
            'created_by' => 1,
        ]);
        return redirect()->back()->with('message', 'মেয়রের তথ্য অ্যাড করা হয়েছে');
    }

    public function professional_mayor_store(Request $request)
    {
        $request->validate([
            'designation' => 'required|max:255',
            'institute_name' => 'required|max:255',
        ]);
        ProfessionalMayor::create([
            'designation' => $request->designation,
            'institute_name' => $request->institute_name,
            'created_by' => 1
        ]);
        return redirect()->back();
    }

    public function professional_mayor_delete($id)
    {
        ProfessionalMayor::where('id', $id)->delete();
        return redirect()->back()->with('error', 'মেয়রের তথ্য ডিলেট করা হয়েছে');

    }

    public function uno()
    {
        $uno = Uno::first();
        return view('admin.contact.uno', compact('uno'));
    }

    public function uno_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'email' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
            'telephone' => 'required|min:11|max:11',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/uno'), $imageName);

            Uno::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'email' => $request->email,
                'contact' => $request->contact,
                'telephone' => $request->telephone,
                'photo' => $imageName,
                'created_by' => auth()->id()
            ]);
            return redirect()->back()->with(['message' => 'উপজেলা নির্বাহী কর্মকর্তা অ্যাড করা হয়েছে']);
        }

    }

    public function admin()
    {
        $admin = Admin::first();
        $employees = AdminOther::get();
        return view('admin.contact.admin', compact('admin', 'employees'));
    }

    public function admin_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'email' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
            'telephone' => 'required|min:11|max:11',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/admin'), $imageName);

            Admin::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'email' => $request->email,
                'contact' => $request->contact,
                'telephone' => $request->telephone,
                'photo' => $imageName,
                'created_by' => auth()->id()
            ]);
            return redirect()->back();
        }

    }

    public function admin_other_employee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        AdminOther::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'contact' => $request->contact,
            'created_by' => auth()->id()
        ]);
        return redirect()->back();
    }

    public function admin_other_employee_delete($id)
    {
        AdminOther::where('id', $id)->delete();
        return redirect()->back()->with(['error' => 'অন্যান্য কর্মকর্তা ডিলেট করা হয়েছে']);
    }

    public function admin_other_employee_edit($id)
    {
        $other_edit = AdminOther::find($id);
        return view('admin.contact.admin_other_edit', compact('other_edit'));
    }

    public function admin_other_employee_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $other = AdminOther::find($id);
        $other->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'contact' => $request->contact
        ]);
        return redirect()->back()->with(['message' => 'অন্যান্য কর্মকর্তা আপডেট করা হয়েছে']);
    }

    public function engineer()
    {
        $engineer = Engineer::first();
        $engineer_other_employees = OtherEmployee::get();
        return view('admin.contact.engineer', compact('engineer', 'engineer_other_employees'));
    }

    public function engineer_store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'email' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
            'telephone' => 'required|min:11|max:11',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/engineer'), $imageName);

            Engineer::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'email' => $request->email,
                'contact' => $request->contact,
                'telephone' => $request->telephone,
                'photo' => $imageName,
                'created_by' => auth()->id()
            ]);

            return redirect()->back()->with('message', 'প্রকৌশল বিভাগ অ্যাড করা হয়েছে');
        }
    }

    public function others_employee_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        OtherEmployee::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'contact' => $request->contact,
            'created_by' => auth()->id()
        ]);
        return redirect()->back()->with('message', 'প্রকৌশল অন্যান্য কর্মকর্তা অ্যাড করা হয়েছে');
    }

    public function others_employee_edit($id)
    {
        $other_employee_edit = OtherEmployee::find($id);
        return view('admin.contact.engineer_other_edit', compact('other_employee_edit'));
    }

    public function others_employee_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'designation' => 'required|max:255',
            'contact' => 'required|min:11|max:11',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $other_employee_edit = OtherEmployee::find($id);
        $other_employee_edit->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'contact' => $request->contact,
        ]);
        return redirect()->back()->with(['message' => 'প্রকৌশল বিভাগ অন্যান্য কর্মকর্তা আপডেট করা হয়েছে']);
    }

    public function others_employee_delete($id)
    {
        OtherEmployee::where('id', $id)->delete();
        return redirect()->back()->with(['error' => 'প্রকৌশল অন্যান্য কর্মকর্তা ডিলেট করা হয়েছে']);
    }

    public function info()
    {
        $infos = Info::all();
        return view('admin.contact.info', compact('infos'));
    }

    public function info_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'info_type' => 'required|max:255',
            'description' => 'required',
            'photo' => 'mimes:jpeg,jpg,png|required|max:10000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/info'), $imageName);

            Info::create([
                'title' => $request->title,
                'info_type' => $request->info_type,
                'description' => $request->description,
                'photo' => $imageName,
                'created_by' => auth()->id()
            ]);
            return redirect()->back()->with(['message' => 'তথ্য ও পরিষেবা অ্যাড করা হয়েছে']);
        }
    }

    public function info_edit($id)
    {
        $data['info_edit'] = Info::find($id);
        return view('admin.contact.info_edit', $data);
    }

    public function info_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'info_type' => 'required|max:255',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $info = Info::find($id);
        if (!$request->hasFile('photo')) {
            $info->update([
                'title' => $request->title,
                'info_type' => $request->info_type,
                'description' => $request->description,
            ]);
        } else {
            $image = $request->file('photo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/info'), $imageName);
            $info->update([
                'title' => $request->title,
                'info_type' => $request->info_type,
                'description' => $request->description,
                'photo' => $imageName
            ]);
            return redirect()->back()->with(['message' => 'তথ্য ও পরিষেবা আপডেট করা হয়েছে']);
        }
    }

    public function info_delete($id)
    {
        $old = Info::where('id', $id)->first();
        if (file_exists(public_path('uploads/info' . $old->photo))) {
            unlink(public_path('uploads/info' . $old->photo));
        }

        $delete = Info::where('id', $id)->delete();
        return redirect()->back()->with(['error' => 'তথ্য ও পরিষেবা ডিলেট করা হয়েছে']);
    }
}
