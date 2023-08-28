<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hris_cloud_customer;
use App\Models\Hris_cloud_customer_addresses;
use App\Models\Hris_cloud_order;
use App\Models\Hris_cloud_country;
use App\Models\Hris_cloud_delivery_platform;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 

class newcustomer_controller extends Controller
{
    public function add_new_customer()
    {
       return view('newcustomer');
     }



    public function  new_customer_placeorder(Request $request)
    {
        
         $validator=Validator::make($request->all() ,
               [
           
                    'customer_name'=>'required|max:50',
                    'customer_address1'=>'required',
                    'customer_address2'=>'required',
                    'customer_email'=>'required|email',
                    'customer_phonee'=>'required',
                    'customer_country'=>'required|min:2'
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
             return response()->json([
                                      'status'=>200,
                                      'messages'=>"order place successfully",
                                     ]);
 
             }
    }

public function add_new_customer_order(Request $request)
    {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData, true);
        
        $selecteditems = $data['ids'];
        $orderdata = $data['dataa'];
        $country=Hris_cloud_country::where('name',$orderdata['customer_country'])->get();
      
        $platform_id=Hris_cloud_delivery_platform::where('name',$orderdata['Delivery_Platform'])->get();

        $customer=new Hris_cloud_customer;
        $customer->name=$orderdata ['customer_name'];
        $customer->email=$orderdata ['customer_email'];
        $customer->phone=$orderdata ['customer_phonee'];
        $customer->save();

        $address=new Hris_cloud_customer_addresses;
        $address->phone=$orderdata['customer_phonee'];
        $address->street_address1=$orderdata['customer_address1'];
        $address->street_address2=$orderdata['customer_address2']; 
        $address->longitude=$orderdata['customer_longitude'];
        $address->latitude=$orderdata['customer_latitude'];
        $address->city=$orderdata['customer_city'];
        $address->state=$orderdata['customer_state'];
        $address->country=$orderdata['customer_country'];
        $address->customer_id=$customer->id;
        $address->save();


        $orders = new Hris_cloud_order;
        $orders->grand_total=$orderdata['grand_total']; 
        $orders->platform_id=$orderdata['platform_id']; 
        $orders->address_id=$address->id;
        $orders->customer_id=$customer->id;
        $orders->brand_id=$orderdata['brandid']; 
        $orders->kitchen_id=$orderdata['kitchenid'];
        $orders->platform=$orderdata['platform'];
        $orders->quantity=$orderdata['totalitemquantity'];
        $orders->delivery_fee=$orderdata['delivery_fee'];
        $orders->discount=$orderdata['Discount'];
        $orders->total=$orderdata['totalprice'];
        $orders->subtotal=$orderdata['totalprice'];
        $orders->comments=$orderdata['Order_Comments'];
        $orders->increment_id=$orderdata['increment_id'];
        $orders->delivery_platform=$orderdata['Delivery_Platform'];
        $orders->payment_method=$orderdata['payment_method'];
        $orders->order_time= $orderdata['order_time'];
        $orders->delivery_time=$orderdata['delivery_time'];
        $orders->delivery_platform_id=$platform_id[0]['id'];
        $orders->country_id=$country[0]['id']; 
        $orders->country=$orderdata['customer_country'];
        $orders->food=json_encode($selecteditems);
        $orders->delivery_date=$orderdata['delivery_date'];
        $orders->delivery_date=$orderdata['order_date'];
        $orders->save();
    }
}
