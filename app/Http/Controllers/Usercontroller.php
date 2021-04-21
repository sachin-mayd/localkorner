<?php

namespace App\Http\Controllers;
use App\Admin;
use App\Vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Usercontroller extends Controller
{
    public function dashboard()
    {
    	return view('dashboard');
    }
    public function login(Request $req)
    {
        $email = $req->input('email');
        $password = $req->input('password');
        $users = Admin::select()
                     ->where('email', $email)
                     ->where('password', md5($password))
                     ->get();
         
        if(count($users) == 1)
        {
            return redirect('dashboard');
        }
        else
        {
            return redirect('/');
        }
    }
    public function vendorList()
    {
        $vendor = Vendor::select()
        ->get();
        return view('vendor_list')->with('vendor', $vendor);
    }
    public function addNewVendor(Request $request)
    {
        if($request->id)
        {
            $id = $request->id;
            $vendor = Vendor::select()
                ->where('id', $id)
                ->get();
            return view('new_vendor')->with('vendor', $vendor)->with('id',$id);
        }
        else
        {
            return view('new_vendor')->with('id','');;
        }
    }
    public function saveVendor(Request $request)
    {
        $request->validate([
            'vendor_name'=>'required',
            'company_name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
            'service_description'=>'required',
            'password'=>'required',
            'status'=>'required'
        ]);

        $data = $request->input();
        if($data['password'] == md5($data['password']))
        {
            $password = $data['password'];
        }
        else
        {
            $password = md5($data['password']);
        }
        $savevendor = DB::table('vendor')->insert(
            [
             'vendor_name' => $data['vendor_name'],
             'company_name' => $data['company_name'],
             'email' => $data['email'],
             'mobile' => $data['mobile'],
             'alternate_mobile' => $data['alternate_mobile'],
             'address' => $data['address'],
             'city' => $data['city'],
             'state' => $data['state'],
             'zip' => $data['zip'],
             'otp' => '',
             'service_description' => $data['service_description'],
             'password' => $password,
             'status' => $data['status'],
             'created_at'=>date('y-m-d'),
             'updated_at'=>date('y-m-d')
             ]
        );
        if($savevendor)
        {
            return  redirect('/add-new-vendor')->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/add-new-vendor')->with('error', 'Data not saved !');
        }
    }
    public function updateVendor(Request $request)
    {
        $request->validate([
            'vendor_name'=>'required',
            'company_name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
            'service_description'=>'required',
            'password'=>'required',
            'status'=>'required'
        ]);
        $data = $request->input();

        $updatevendor = DB::table('vendor')
                ->where('id', $data['hidden_id'])
                ->update(
                    [
                        'vendor_name' => $data['vendor_name'],
                        'company_name' => $data['company_name'],
                        'email' => $data['email'],
                        'mobile' => $data['mobile'],
                        'alternate_mobile' => $data['alternate_mobile'],
                        'address' => $data['address'],
                        'city' => $data['city'],
                        'state' => $data['state'],
                        'zip' => $data['zip'],
                        'otp' => '',
                        'service_description' => $data['service_description'],
                        'password' => md5($data['password']),
                        'status' => $data['status'],
                        'updated_at'=>date('y-m-d')
                    ]
                );
        if($updatevendor)
        {
            return  redirect('/edit-vendor/'.$data['hidden_id'])->with('success', 'Data saved !');
        }
        else
        {
             return redirect('/edit-vendor/'.$data['hidden_id'])->with('error', 'Data not saved !');
        }
    }
    public function userList()
    {
        $user = User::select()
        ->get();
        return view('user_list')->with('userList', $user);
    }
    public function changeStatus(Request $request)
    {
        $data = $request->input();
        $user_id = $data['userid'];
        $status = $data['status'];
        $updatestatus = DB::table('users')
                ->where('id', $user_id)
                ->update(
                    [
                        'status' => $status
                    ]
                );
        if($updatestatus)
        {
            return "Changed";
        }
        else
        {
             return "Failed";
        }

    }

}
