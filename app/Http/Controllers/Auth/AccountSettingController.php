<?php

namespace App\Http\Controllers\Auth;

use File;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class AccountSettingController extends Controller
{
    public function index(){
        return view('auth.accountSetting');
    }

    public function imageChnage(Request $request){
        $report = Validator::make($request->all(), [
            'image' => 'required'
        ]);
        if($report->passes()){
            $image_info = $request->file('image');
            $image_url = $this->imageUplodeAndResize($image_info);

            $user = User::find(Auth::User()->id);
            if(file_exists($user->image)){
                unlink($user->image);
            }
            $user->image = $image_url;
            $user->save();
            Session::flash('success','Profile Image change Successfully !');
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors($report);
    }

    public function passwordChange(Request $request){
        $report = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($report->passes()){
            $credentials = [
                'email'=>Auth::User()->email,
                'password'=>$request->current_password,
            ];

            if(Auth::guard('web')->once($credentials)){

                $user = User::find(Auth::User()->id);
                $user->password =  bcrypt($request->password);
                $user->save();

                Session::flash('success','Account Password change Successfully !');
                return redirect()->route('home');
            }
            //if not valid admin redirect back with message
            Session::flush('warning','current Password is Not Match');
            return redirect()->back();

        }
        return redirect()->back()->withErrors($report);

    }

    //Resize and Uplode Shop Banner Image
    private function imageUplodeAndResize($imageInfo)
    {
        $path = $this->distinationPath();
        $imageName = $this->createImageName($imageInfo);
        $imagePath = $path.$imageName;
        $image = Image::make($imageInfo->getRealPath())->resize(80, 80);
        $image->save($imagePath);
        return $imagePath;
    }


    //make a Custom Banner Image Name
    private function createImageName($imageInfo)
    {

        //get Current Date time String
        $date = $this->currentTime();
        //concrite a new logo Name
        $newName = $date.'_'.$imageInfo->getClientOriginalName();

        //return logo name
        return $newName;
    }


    //Image Distination url
    private function distinationPath()
    {
        //Create image Store Path
        $path = 'public/images/';

        //cheak Folder all ready Exits or not
        if(!File::exists($path)){
            //if no Folder Exits then Create new One
            File::makeDirectory($path);
        }

        //Return the folder path
        return $path;
    }


    // get Current Time Function

    private function currentTime()
    {
        return Carbon::now()->format('Ymdhis');
    }
}
