<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Cart;
class Usercontroller extends Controller
{

    public function register(Request $request)
    {
 
        $data = $request->input();
        $phone = $data['phone'];
        $email = $data['email'];
        $OTP = rand(10000,99999);
        
            $usercount = User::select()
                ->where('phone', $phone)
                ->count();

            $usercount1 = User::select()
                ->where('email', $email)
                ->count();
                
            if($usercount == 1)
            {
                $data = array(
                    'status'=>false,
                    'msg'=>'Mobile already registered'
                );
                return $data;
            }
            elseif($usercount1 == 1)
            {
                $data = array(
                    'status'=>false,
                    'msg'=>'Email already registered'
                );
                return $data;
            }
            else
            {
                $sendotp = DB::table('users')->insert(
                    [
                     'fname' => $data['fname'],
                     'lname' => $data['lname'],
                     'email' => $data['email'],
                     'phone' => $data['phone'],
                     'password' => md5($data['password']),
                     'otp' => $OTP,
                     'created_at'=>date('y-m-d'),
                     'updated_at'=>date('y-m-d')
                    ]
                );
            }
            if($sendotp)
            {
                $sendotp = $this->sendOtp($data['phone']);
                $data = array(
                    'status'=>true,
                    'OTP'=>$OTP
                );

                return $data;
            }
            else
            {
                $data = array(
                    'status'=>false,
                    'msg'=>'Something went wrong'
                );
                return $data;
            }
    }
    public function sendOtp()
    {
        return;
    }
    public function login(Request $request)
    {
       
        $data = $request->input();
        $phone = $data['auth_id'];
        $users = User::select()
                ->where('phone', $phone)
                ->orWhere('email', $phone)
                ->get();
        if(count($users) == 1)
        {
            foreach($users as $u)
            {
                 $udata['fname'] = $u['fname'];
                 $udata['lname'] = $u['lname'];
                 $udata['email'] = $u['email'];
                 $udata['phone'] = $u['phone'];
                 $udata['user_id'] = $u['id'];
            }
            $data = array(
                'status'=>true,
                'data'=>$udata
            );
            return $data;

        }
        else
        {
            $data = array(
                'status'=>false,
                'msg'=>'Invalid user'
            );
            return $data;
        }
    }
    public function getUserProfile(Request $request)
    {
        $data = $request->input();
        $user_id = $data['user_id'];
        $users = User::select()
                ->where('id', $user_id)
                ->get();
        if(count($users) == 1)
        {
            foreach($users as $u)
            {
                 $udata['fname'] = $u['fname'];
                 $udata['lname'] = $u['lname'];
                 $udata['email'] = $u['email'];
                 $udata['phone'] = $u['phone'];
                 $udata['user_id'] = $u['id'];
            }
            $data = array(
                'status'=>true,
                'data'=>$udata
            );
            return $data;

        }
        else
        {
            $data = array(
                'status'=>false,
                'msg'=>'Invalid user'
            );
            return $data;
        }
    }
    public function verifyOtp(Request $request)
    {
        $data = $request->input();
        $phone = $data['phone'];
        $otp = $data['otp'];
        $users = User::select()
        ->where('phone', $phone)
        ->where('otp', $otp)
        ->get();
        if(count($users) == 1)
        {
            DB::table('users')
                ->where('phone', $phone)
                ->update(
                    [
                        'is_verified' => 1,
                        'updated_at'=>date('y-m-d')
                    ]
                );
            $data = array(
                'status'=>true,
                'msg'=>'OTP verified'
            );
            return $data;
        }
        else
        {
            $data = array(
                'status'=>false,
                'msg'=>'OTP verification failed'
            );
            return $data;
        }
    }
    public function addToCart(Request $request)
    {
        $data = $request->input();
        $user_id = $data['user_id'];
        $product_id = $data['product_id'];
        $qty = $data['qty'];
        $cartcount = DB::table('cart')
        ->where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->get();
        if(count($cartcount) > 0)
        {
            $updatecart = DB::table('cart')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->update(
                [
                    'qty' => $qty
                ]
            );
            if($updatecart)
            {
                $data = array(
                    'status'=>true,
                    'msg'=>'Cart updated'
                );
                return $data;
            }
            else
            {
                $data = array(
                    'status'=>false,
                    'msg'=>'Something went wrong'
                );
                return $data;
            }
        }
        else
        {
            $addtocart = DB::table('cart')->insert(
                [
                'qty' => $data['qty'],
                'user_id' => $data['user_id'],
                'product_id' => $data['product_id']
                ]
            );
            if($addtocart)
            {
                $data = array(
                    'status'=>true,
                    'msg'=>'Item added to cart'
                );
                return $data;
            }
            else
            {
                $data = array(
                    'status'=>false,
                    'msg'=>'Something went wrong'
                );
                return $data;
            }
        }
    }
    public function removeFromCart(Request $request)
    {
        $data = $request->input();
        $user_id = $data['cart_id'];
        $removecart = DB::table('cart')->where('id', $user_id)->delete();
        if($removecart)
        {
            $data = array(
                'status'=>true,
                'msg'=>'Item removed from cart'
            );
            return $data;
        }
        else
        {
            $data = array(
                'status'=>false,
                'msg'=>'Something went wrong'
            );
            return $data;
        }
    }
    public function getAddressType()
    {
        $addresstype= User::select()
                ->where('status', 0)
                ->get();
        if(count($addresstype) == 1)
        {
            foreach($addresstype as $u)
            {
                 $udata['address_type'] = $u['address_type'];
                 $udata['id'] = $u['id'];
            }
            $data = array(
                'status'=>true,
                'data'=>$udata
            );
            return $data;

        }
        else
        {
            $data = array(
                'status'=>false,
                'msg'=>'Invalid data'
            );
            return $data;
        }
    }
}
