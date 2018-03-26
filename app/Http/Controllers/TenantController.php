<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Tenant;
use App\TenantMeta;
use Carbon\Carbon;
use Session;
use File;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::orderBy('id','desc')->get();
        return view('tenants.tenants',['tenants'=>$tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //make validation
        $report = Validator::make($request->all(), [
            'id_number' => 'required|unique:tenants,id_number',
            'full_name' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
            'image' => 'required',
            'plot_name_number' => 'required',
            'house_name_number' => 'required',
            'room_type' => 'required',
            'rent_amount' => 'required',
            'balance' => 'required'
        ]);

        //check validation pass or not
        if($report->passes()){

            //if pass

            //take image an store in folder amd take the image path

            $image_info = $request->file('image');
            $image_url = $this->imageUplodeAndResize($image_info);


            //store Tenants information in DB

            $tenant = new Tenant;
            $tenant->id_number = $request->id_number;
            $tenant->full_name = $request->full_name;
            $tenant->phone_number = $request->phone_number;
            $tenant->email_address = $request->email_address;
            $tenant->image = $image_url;
            $tenant->plot_name_number = $request->plot_name_number;
            $tenant->house_name_number = $request->house_name_number;
            $tenant->room_type = $request->room_type;
            $tenant->rent_amount = $request->rent_amount;
            $tenant->balance = $request->balance;
            $tenant->gas_bill = $request->gas_bill;
            $tenant->water_bill = $request->water_bill;
            $tenant->net_bill = $request->net_bill;
            $tenant->other_bill = $request->other_bill;
            $tenant->status = $request->status;
            $tenant->address = $request->address;
            $tenant->save();

            //sotre meta Data if contain than store it in TenantMeta table

            //flash Success message
            Session::flash('success', 'Tenant Information Store Successfully !');
            //redirect to bake
            return redirect()->back();

        }

        // validation if not pass redirect back with Error message and data
        return redirect()->back()->withErrors($report)->withInputes($request);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tenant = Tenant::find  ($id);
        return view('tenants.show',['tenant'=>$tenant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenant = Tenant::find($id);
        return view('tenants.edit',['tenant'=>$tenant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //make validation
        $report = Validator::make($request->all(), [
            'id_number' => 'required',
            'full_name' => 'required',
            'phone_number' => 'required',
            'plot_name_number' => 'required',
            'house_name_number' => 'required',
            'room_type' => 'required',
            'rent_amount' => 'required',
            'balance' => 'required'
        ]);

        //check validation pass or not
        if($report->passes()){

            //if pass

            //store Tenants information in DB

            $tenant =  Tenant::find($id);
            $tenant->id_number = $request->id_number;
            $tenant->full_name = $request->full_name;
            $tenant->phone_number = $request->phone_number;
            $tenant->email_address = $request->email_address;
            $tenant->plot_name_number = $request->plot_name_number;
            $tenant->house_name_number = $request->house_name_number;
            $tenant->room_type = $request->room_type;
            $tenant->rent_amount = $request->rent_amount;
            $tenant->balance = $request->balance;
            $tenant->gas_bill = $request->gas_bill;
            $tenant->water_bill = $request->water_bill;
            $tenant->net_bill = $request->net_bill;
            $tenant->other_bill = $request->other_bill;
            $tenant->status = $request->status;
            $tenant->address = $request->address;
            $tenant->save();

            //take image an store in folder amd take the image path

            $image_info = $request->file('image');
            if(file_exists($image_info)){
                $image_url = $this->imageUplodeAndResize($image_info);

                if(file_exists($tenant->image)){
                    unlink($tenant->image);
                }

                $tenant_image = Tenant::find($id);
                $tenant_image->image = $image_url;
                $tenant_image->save();

            }
            //sotre meta Data if contain than store it in TenantMeta table

            //flash Success message
            Session::flash('success', 'Tenant Information Updated Successfully !');
            //redirect to bake
            return redirect()->route('tenants.index');

        }

        // validation if not pass redirect back with Error message and data
        return redirect()->back()->withErrors($report);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Tenant::find($id);

        if(file_exists($delete->image)){
            unlink($delete->image);
        }
        $delete->delete();
        $data = ['success'];
        return response()->json($data);
    }


    //Resize and Uplode Shop Banner Image
    private function imageUplodeAndResize($imageInfo)
    {
        $path = $this->distinationPath();
        $imageName = $this->createImageName($imageInfo);
        $imagePath = $path.$imageName;
        $image = Image::make($imageInfo->getRealPath())->resize(150, 150);
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
