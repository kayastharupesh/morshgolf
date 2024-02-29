<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\Faq;
use App\Models\Testimonial;
use App\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AbandonedCart extends Controller
{
    public function index(Request $request)
    {
        return "Hiiii";
    }
   
    
    public function sendMailAbandonedCart(Request $request)
    {
        $avondedcarts = Cart::where(["order_id" => NULL, "user_type" => "reg"])->orderBy('id','DESC')->get();
        foreach ($avondedcarts as $key => $value) {
            $user = User::find($value->user_id);
            $datais = [
                'to' => $user->email,
                'subject' => "You miss your ordet process - MorshGolf",
                'name' => $user->name,
                'data' => $value
            ];
            Mail::send('mail.abandonedcart',$datais, function($messages) use ($datais){
                $messages->to($datais['to']);
                $messages->subject($datais['subject']);
            });
        }
        return redirect()->route('home');
    }


    
}
