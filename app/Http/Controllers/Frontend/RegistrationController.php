<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BosotBariHolding;
use App\Models\Business;
use App\Models\BusinessHolding;
use App\Models\BusinessStall;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    // Bosost Bari Store
    public function bosot_bari_store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'         => 'required|max:150|min:2',
                'father_name'  => 'required|max:150|min:2',
                'nid'          => 'required|max:20|min:2|numeric',
                'dob'          => 'required|date',
                'mobilenumber' => 'required|max:11|min:1|numeric',
                'ward_id'      => 'required|max:20|min:1',
                'village_id'   => 'required|max:20|min:1',
                'holding_no'   => 'required|max:20|min:1',
                'type_house'   => 'required|max:20|min:1',
                'number_room'  => 'required|max:50|min:1|numeric',
            ]);

            $holding_exist = BosotBariHolding::where('ward_id', $request->ward_id)
                ->where('village_id', $request->village_id)
                ->where('holding_no', $request->holding_no)
                ->get();

            if (count($holding_exist) > 0) {
                $request->flashOnly(['holding_no']);
                return redirect(route('reg.bosot-bari'))->withErrors()->withInput()->with('error', 'উক্ত ওয়ার্ড ও গ্রামে প্রদত্ত হোল্ডিং ইতিমধ্যে নিবন্ধিত করা আছে । ');
            } else {
                $user                = new User();
                $user->name          = $request->name;
                $user->contact       = $request->mobilenumber;
                $user->password      = bcrypt('123456');
                $user->show_password = '123456';
                $user->username      = Str::slug($request->name, '-') . '-' . uniqid();
                $user->save();

                $bosotbari          = new BosotBariHolding();
                $bosotbari->user_id = $user->id;
                if ($request->gurdian_status == "father") {
                    $bosotbari->father = $request->father_name;

                } else if ($request->gurdian_status == "husband") {
                    $bosotbari->spouse = $request->father_name;

                }

                if ($request->birth_nid == "nid") {
                    $bosotbari->nid = $request->nid;

                } else if ($request->birth_nid == "birth_id_no") {
                    $bosotbari->birth_certificate = $request->nid;

                }

                $bosotbari->dob           = $request->dob;
                $bosotbari->mobile        = $request->mobilenumber;
                $bosotbari->ward_id       = $request->ward_id;
                $bosotbari->village_id    = $request->village_id;
                $bosotbari->holding_no    = $request->holding_no;
                $bosotbari->house_type_id = $request->type_house;
                $bosotbari->total_room    = $request->number_room;

                $bosotbari->save();

                return redirect(route('reg.bosot-bari'))->with('success', 'বসতবাড়ি হোল্ডিং সফলভাবে নিবন্ধিত হয়েছে ।');

            }

        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return redirect(route('reg.bosot-bari'))->withErrors()->withInput()->with('error', 'দুঃখিত... বসতবাড়ি হোল্ডিং নিবন্ধিত হয়নি ।');

        }

    }

    // Business Holding Store

    public function business_store(Request $request)
    {

        try {
            $validated = $request->validate([
                'name'         => 'required|max:150|min:2',
                'father_name'  => 'required|max:150|min:2',
                'nid'          => 'required|max:20|min:2|numeric',
                'dob'          => 'required|date',
                'mobilenumber' => 'required|max:11|min:1|numeric',
                'ward_id'      => 'required|max:50|min:1',
                'holding_no'   => 'required|max:50|min:1',
                'total_room'   => 'required|max:50|min:1|numeric',
            ]);

            $user                = new User();
            $user->name          = $request->name;
            $user->contact       = $request->mobilenumber;
            $user->password      = bcrypt('123456');
            $user->show_password = '123456';
            $user->username      = Str::slug($request->name, '-') . '-' . uniqid();
            $user->save();

            $businessholding          = new BusinessHolding();
            $businessholding->user_id = $user->id;
            if ($request->gurdian_status == "father") {
                $businessholding->father = $request->father_name;

            } else if ($request->gurdian_status == "husband") {
                $businessholding->spouse = $request->father_name;

            }

            if ($request->birth_nid == "nid") {
                $businessholding->nid = $request->nid;

            } else if ($request->birth_nid == "birth_id_no") {
                $businessholding->birth_certificate = $request->nid;

            }

            $businessholding->dob        = $request->dob;
            $bosotbari->mobile           = $request->mobilenumber;
            $businessholding->ward_id    = $request->ward_id;
            $businessholding->holding_no = $request->holding_no;
            $businessholding->total_room = $request->total_room;

            $businessholding->save();

            for ($i = 0; $i <= count($request->stall_no) - 1; $i++) {
                BusinessStall::create([
                    'business_holding_id' => $businessholding->id,
                    'stall_no'            => $request->stall_no[$i],
                    'ownership'           => $request->ownership[$i],
                    'stall_nid'           => $request->stall_nid[$i],
                    'stall_date'          => $request->stall_date[$i],
                    'stall_phone'         => $request->stall_phone[$i],
                    'stall_rent'          => $request->stall_rent[$i],
                    'stall_tax'           => $request->stall_tax[$i],
                ]);

            }

            return redirect(route('reg.business-hold'))->with('success', 'বানিজ্যিক হোল্ডিং সফলভাবে নিবন্ধিত হয়েছে ।');

        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return redirect(route('reg.business-hold'))->withErrors()->withInput()->with('error', 'দুঃখিত... বানিজ্যিক হোল্ডিং নিবন্ধিত হয়নি ।');
        }
    }

    // Business store

    public function business_ind_store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'          => 'required|max:150|min:2',
                'father_name'   => 'required|max:150|min:2',
                'nid'           => 'required|max:20|min:2|numeric',
                'mobilenumber'  => 'required|max:11|numeric',
                'ward_id'       => 'required|max:50|min:1',
                'shopno'        => 'required|max:50|min:1',
                'holding_no'    => 'required|max:50|min:1',
                'business_name' => 'required|max:250|min:2',
            ]);

            $stall_exist = DB::table('business_holdings')
                ->join('business_stalls', 'business_holdings.id', '=', 'business_stalls.business_holding_id')
                ->where('business_holdings.ward_id', $request->ward_id)
                ->where('business_stalls.ownership', '=', 'rent')
                ->select('business_stalls.stall_no')
                ->get();

            $stall    = $request->holding_no . '/' . $request->shopno;
            $stall_no = array();
            for ($i = 0; $i <= count($stall_exist) - 1; $i++) {
                array_push($stall_no, $stall_exist[$i]->stall_no);
            }

            if (!in_array($stall, $stall_no)) {
                return redirect(route('reg.business'))->withErrors()->withInput()->with('error', 'উক্ত প্রতিষ্ঠানটি বানিজ্যিক হোল্ডিং এ নিবন্ধিত নেই । ');
            } else {
                $user                = new User();
                $user->name          = $request->name;
                $user->contact       = $request->mobilenumber;
                $user->password      = bcrypt('123456');
                $user->show_password = '123456';
                $user->username      = Str::slug($request->name, '-') . '-' . uniqid();
                $user->save();

                $business          = new Business();
                $business->user_id = $user->id;
                if ($request->gurdian_status == "father") {
                    $business->father = $request->father_name;

                } else if ($request->gurdian_status == "husband") {
                    $business->spouse = $request->father_name;

                }

                if ($request->birth_nid == "nid") {
                    $business->nid = $request->nid;

                } else if ($request->birth_nid == "birth_id_no") {
                    $business->birth_certificate = $request->nid;

                }

                $business->ward_id          = $request->ward_id;
                $bosotbari->mobile          = $request->mobilenumber;
                $business->holding_no       = $request->holding_no;
                $business->shopno           = $request->shopno;
                $business->business_name    = $request->business_name;
                $business->business_type_id = $request->business_types;

                if ($request->hasFile('photo')) {
                    $image     = $request->file('photo');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/business'), $imageName);
                    $business->photo = 'uploads/business/' . $imageName;
                }

                $business->save();

                return redirect(route('reg.business'))->with('success', 'ব্যাবসা প্রতিষ্ঠানটি সফলভাবে নিবন্ধিত হয়েছে । ');

            }

        } catch (\Exception $e) {
            $err_message = \Lang::get($e->getMessage());
            return redirect(route('reg.business'))->withErrors()->withInput()->with('error', 'দুঃখিত... ব্যাবসা প্রতিষ্ঠানটি নিবন্ধিত হয়নি । ');

        }

    }

}
