<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Productcont;
use App\Models\Homepagepopup;
use App\Models\Aboutus;
use App\Models\Ourstory;
use App\User;
use App\Rules\MatchOldPassword;
use Hash;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;
class AdminController extends Controller
{
    public function index(){
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('users', json_encode($array));
    }

    public function profile(){
        $profile=Auth()->user();
        // return $profile;
        return view('backend.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){
        // return $request->all();
        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
    }

    public function settings(){
        $data=Settings::first();
        return view('backend.setting')->with('data',$data);
    }

    public function settingsUpdate(Request $request){
        $this->validate($request,[
            'short_des'=>'required|string',
            'long_des'=>'required|string',
            'logo'=>'required',
            'photo'=>'required',
            'address'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|string',
        ]);
        $data=$request->all();
        $settings=Settings::first();
        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Setting successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('settings');
    }
    
    
    public function productcont(){
        $data=Productcont::first();
        return view('backend.productcont')->with('data',$data);
    }

    public function productcontUpdate(Request $request){
        // return $request->all();
        $this->validate($request,[
            'title1'=>'required|string',
            'content1'=>'required|string',
            'title2'=>'required|string',
            'content2'=>'required|string',
            'title3'=>'required|string',
            'content3'=>'required|string',
        ]);
        $data=$request->all();
        $settings=Productcont::first();
        // return $settings;
        $status=$settings->fill($data)->save();
        if($status){
            request()->session()->flash('success','Text successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('productcont');
    }
    
    
    
    
    public function homepage_popup(){
        $data=Homepagepopup::first();
        return view('backend.homepage_popup')->with('data',$data);
    }

    public function homepage_popupUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Homepagepopup::first();
        
        if ($request->has('popup_enable')) {
            $data['popup_enable'] = '1';
            $data['main_heading1'] = $request->input('main_heading1');
            $data['sub_heading1'] = $request->input('sub_heading1');
            $data['sub_title1'] = $request->input('sub_title1');
            $data['main_heading2'] = $request->input('main_heading2');
            $data['sub_heading2'] = $request->input('sub_heading2');
            $data['main_heading3'] = $request->input('main_heading3');
            
            if($request->hasFile('photo')) {
                $file = $request->file('photo');
                $fileName = $file->getClientOriginalName();
                $file_extension = $file->extension();
                $file_size = $file->getSize();
                $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
                if($file->move('public/frontend/images/banner/',$file_Newname)){
                    $data['photo1']= $file_Newname;
                } else {
                    throw new \Exception("Failed to upload document. Please try again after some time.");
                }
            }
            
            $status=$Homepagepopup->fill($data)->save();
            if($status){
                request()->session()->flash('success','Home Page pop up updated');
            }
            else{
                request()->session()->flash('error','Please try again');
            }
        } else {
            $data['popup_enable']   = '0';
    
            $status=$Homepagepopup->fill($data)->save();
            if($status){
                request()->session()->flash('success','Home Page pop up updated');
            }
            else{
                request()->session()->flash('error','Please try again');
            }
        }
        return redirect()->route('homepage_popup');
    }
    
    public function aboutus(){
        $data=Aboutus::first();
        return view('backend.aboutus.index')->with('data',$data);
    }

    public function aboutusUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Aboutus::first();
        
        $data['head_line1'] = $request->input('head_line1');;
        $data['head_line2'] = $request->input('head_line2');
        $data['head_line_content1'] = $request->input('head_line_content1');
        $data['head_line_content2'] = $request->input('head_line_content2');
        $data['sub_head_line_content'] = $request->input('sub_head_line_content');
        $data['content'] = $request->input('content');
        
        if($request->hasFile('image1')) {
            $file = $request->file('image1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('image2')) {
            $file = $request->file('image2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        
        $status=$Homepagepopup->fill($data)->save();
        if($status){
            request()->session()->flash('success','Home Page about us updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('aboutus');
    }

    public function ourstory(){
        $data=Ourstory::first();
        return view('backend.ourstory.index')->with('data',$data);
    }

    public function ourstoryUpdate(Request $request){
        $data=$request->all();
        $Homepagepopup=Ourstory::first();
        
        $data['head_line1'] = $request->input('head_line1');;
        $data['head_line2'] = $request->input('head_line2');
        $data['head_line_content1'] = $request->input('head_line_content1');
        $data['head_line_content2'] = $request->input('head_line_content2');
        $data['sub_head_line_content'] = $request->input('sub_head_line_content');
        $data['content'] = $request->input('content');
        
        if($request->hasFile('image1')) {
            $file = $request->file('image1');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image1']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }

        if($request->hasFile('image2')) {
            $file = $request->file('image2');
            $fileName = $file->getClientOriginalName();
            $file_extension = $file->extension();
            $file_size = $file->getSize();
            $file_Newname = "homepagepopup-".rand(11111, 99999).".".$file_extension;
            if($file->move('public/frontend/images/banner/',$file_Newname)){
                $data['image2']= $file_Newname;
            } else {
                throw new \Exception("Failed to upload document. Please try again after some time.");
            }
        }
        
        $status=$Homepagepopup->fill($data)->save();
        if($status){
            request()->session()->flash('success','Home Page about us updated');
        }
        else{
            request()->session()->flash('error','Please try again');
        }
        return redirect()->route('ourstory');
    }
    

    public function changePassword(){
        return view('backend.layouts.changePassword');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect()->route('admin')->with('success','Password successfully changed');
    }

    // Pie chart
    public function userPieChart(Request $request){
        // dd($request->all());
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get();
     $array[] = ['Name', 'Number'];
     foreach($data as $key => $value)
     {
       $array[++$key] = [$value->day_name, $value->count];
     }
    //  return $data;
     return view('backend.index')->with('course', json_encode($array));
    }

    // public function activity(){
    //     return Activity::all();
    //     $activity= Activity::all();
    //     return view('backend.layouts.activity')->with('activities',$activity);
    // }
}
