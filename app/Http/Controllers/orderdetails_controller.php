<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hris_cloud_platform;
use App\Models\Hris_cloud_brand;
use App\Models\Hris_cloud_brand_menu;
use App\Models\Hris_cloud_brand_menu_addon;
use Carbon\Carbon;
use Validator;


class orderdetails_controller extends Controller
{
    
   public function orderdetails(Request $request)
   {

    $jsonData = $request->getContent();
    $data = json_decode($jsonData, true);

    $selecteditems = $data['array'];
    $ids = $data['dataa'];

    $currentDateTime = Carbon::now();
    $ordertime =  $currentDateTime->timezone('Asia/Dubai');
  
    $currentdate = Carbon::now();
    $deliveryTimeInUserTimezone = $currentdate->timezone('Asia/Dubai');
    $deliverytime=$deliveryTimeInUserTimezone->addMinutes(25);

    $time=[
           "ordertime"=>"$ordertime",
           "deliverytime"=>"$deliverytime",
          ];

    $platform_id=Hris_cloud_platform::where('name',$ids['platform'])->get();
       
    return view('details',compact('selecteditems','ids','platform_id','time'));
   }


   public function ordernewdata(Request $req)
   {
     $jsonData = $req->getContent();
    $data = json_decode($jsonData, true);
 
    $selecteditems = $data['data'];
    $ids = $data['selecteditems'];

    $validator=Validator::make($selecteditems,[
         
       
        'delivery_fee'=>'required',
        'Discount'=>'required',
        'Order_Comments'=>'required',
        'Service_Comments'=>'required|max:191',
        'Delivery_Platform'=>'required',
        'increment_id'=>'required',
    ]);

  
    if($validator->fails()) 
      {
          return response()->json([
                                     'status'=>400,
                                     'errors'=>$validator->messages(),
                                  ]);
      }
      else
      {  
          return view('newdata',compact('selecteditems','ids'));
      }


    
    }

    public function showbrandmanu($Id)
    { 
           
           $brand=Hris_cloud_brand::where('id',$Id)->get();
           $brand_menu=Hris_cloud_brand_menu::where('brand_id',$Id)->get();
           $addon=Hris_cloud_brand_menu_addon::where('brand_id',$Id)->get();
           $unique_category = $brand_menu->unique('categories');
           return view('products',compact('brand','brand_menu','addon','unique_category'));
       
    }
   

}
