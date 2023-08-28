<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hris_cloud_order;
use Carbon\Carbon;
use App\Models\Hris_cloud_delivery_platform;

class selfdelivery_controller extends Controller
{
 public function self_delivery()
    {
            return view('selfdelivery');
     }
     
 public function  place_self_delivery_order(Request $request)
   {
  
    $jsonData = $request->getContent();
    $data = json_decode($jsonData, true);
    
    $selecteditems = $data['ids'];
    $orderdata = $data['data'];
   //  $platform_id=Hris_cloud_delivery_platform::where('name',$orderdata['Delivery_Platform'])->get();
 

    $orders = new Hris_cloud_order;
    $orders->grand_total=$orderdata['grand_total'];
    $orders->platform_id=$orderdata['platform_id']; 
    $orders->brand_id=$orderdata['brandid']; 
    $orders->kitchen_id=$orderdata['kitchenid'];
    $orders->platform=$orderdata['platform'];
    $orders->quantity=$orderdata['totalitemquantity'];
    $orders->delivery_fee=$orderdata['delivery_fee'];
    $orders->discount=$orderdata['Discount'];
    $orders->total=$orderdata['totalprice'];
    $orders->comments=$orderdata['Order_Comments'];
    $orders->increment_id=$orderdata['increment_id'];
    $orders->payment_method=$orderdata['payment_method'];
    $orders->subtotal=$orderdata['totalprice'];
    $orders->order_time= $orderdata['order_time'];
    $orders->delivery_time=$orderdata['delivery_time'];
    $orders->delivery_date=$orderdata['delivery_date'];
    $orders->delivery_date=$orderdata['order_date'];
    $orders->food=json_encode($selecteditems);
    $orders->delivery_platform_id="31";
    $orders->delivery_platform="Rider Not Needed";
    $orders->save();

   }
}
