<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Session;
use File;

class HomeController extends Controller
{
    public function home(){
        return view('home');
    }
    public function friends(){
        return view('friends');
    }
    public function chat($other_id){
        $user = User::where('username', $other_id)->first();
        $my_id = Session::get('username');
        $messages =  Chat::where(function($query) use ($other_id,$my_id){
            $query->where('my_id',$other_id)->where('other_id',$my_id);
        })->orWhere(function($q) use ($other_id,$my_id){
            $q->where('my_id',$my_id)->where('other_id',$other_id);
        })->get();
        return view('chat',compact('user','messages'));
    }
    public function login(){
        if(Session::has('authenticated')){
            return redirect('/');
        }
        else{
            return view('login');
        }
    }
    public function register(){
        if(Session::has('authenticated')){
            return redirect('/');
        }
        else{
            return view('register');
        }
    }
    public function forgetPassword(){
        if(Session::has('authenticated')){
            return redirect('/');
        }
        else{
            return view('forget-password');
        }
    }
    public function editProfile(){
        $user = User::where('id', Session::get('id'))->first();
        return view('edit-profile',compact('user'));
    }
    public function profile($username){
        $user = User::where('username', $username)->first();
        return view('profile',compact('user'));
    }
    public function logout(){
        Session()->forget('id');
        Session()->forget('name');
        Session()->forget('username');
        Session()->forget('email');
        Session()->forget('authenticated');
        return redirect('login');
    }
    



    public function registerUser(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'same:password',
        ]);
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->pwd = md5($req->password);
        

        // Check Username
        $username = $req->name.''.rand(1111,99999999);
        $username = strtolower(str_replace(" ", "_", $username));
        $user->username = $username;
        $user->save();
        session()->flash("success","Registration done successfully");
        return redirect()->back();
    }
    public function auth(Request $req){
        $user = User::where('email',$req->email)->first();
        if($user){
            if($user->pwd == md5($req->password)){
                Session()->put('id',$user->id);
                Session()->put('name',$user->name);
                Session()->put('username',$user->username);
                Session()->put('email',$user->email);
                Session()->put('authenticated',"Yes");
                return redirect('/');
            }
            else{
                session()->flash("invalid","Invalid password");
                return redirect()->back();
            }
        }
        else{
            session()->flash("invalid","Invalid email address");
            return redirect()->back();
        }
    }
    public function updateProfile(Request $req){
        $user = User::find(Session::get('id'));
        $user->name = $req->name;
        $user->mobile = $req->mobile;
        $user->bio = $req->bio;
        if($req->hasFile('profile_pic')){
            $profile_pic = $req->profile_pic;
            $filename = time().'_'.$profile_pic->getClientOriginalName();
            $location = 'assets/images';
            $profile_pic->move($location,$filename);
            $user->profile_pic = $filename;
        }
        $user->dob = $req->dob;
        $user->gender = $req->gender;
        $user->city = $req->city;
        $user->pincode = $req->pincode;
        $user->state = $req->state;
        $user->country = $req->country;
        $user->save();
        session()->flash("success","Profile Updated Successfully");
        return redirect()->back();
    }
}
