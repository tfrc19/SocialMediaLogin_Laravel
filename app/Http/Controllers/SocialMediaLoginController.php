<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class SocialMediaLoginController extends Controller
{
    //
    public function SocialRedirect($driver){
        return Socialite::driver($driver)->redirect();
    }
    public function LoginSocialMedia($driver){
        $user=Socialite::with($driver)->stateless()->user();
       
        if($driver=='facebook'){
            $isUser=User::where('fb_id',$user->id)->first();
            $campo='fb_id';
        }
        else{
            if($driver=='google'){
                $isUser=User::where('google_id',$user->id)->first();
                $campo='google_id';
            }
        }
        if($isUser){
            Auth::login($isUser);
            return view('/dashboard');
        }
        else{
           $user= User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>encrypt('password'),
                $campo=>$user->id,
                'profile_photo_path'=>$user->avatar,
            ]);
            Auth::login($user);
            return view('/dashboard');
        }
        
       
        //return $isUser;
        //$isUser=User::where('google_id',$user->id)->first();
    }
}
