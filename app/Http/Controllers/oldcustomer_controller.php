<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hris_cloud_customer_addresses;
use App\Models\Hris_cloud_order;
use App\Models\Hris_cloud_customer;
use App\Models\Hris_cloud_country;
use App\Models\Hris_cloud_delivery_platform;
use Validator;
use Carbon\Carbon;

class oldcustomer_controller extends Controller
{
    public function new_address_for_old_customer_order(Request $request)
    {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData, true);
        
        $selecteditems = $data['ids'];
        $orderdata = $data['dataa'];
            
             $validator=Validator::make($orderdata,
                   [
                        'customer_longitude'=>'required|max:50',
                        'street_address2'=>'required',
                        'street_address1'=>'required',
                        'customer_latitude'=>'required',
                        'customer_state'=>'required',
                        'customer_city'=>'required',
                        'customer_country'=>'required|min:2',
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
               'messages'=>"you want to place the order",
             ]);
       }
    }




    public function new_address_for_old_customer_order_place(Request $request)
    {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData, true);
        
        $selecteditems = $data['ids'];
        $orderdata = $data['dataa'];
        
        
        $country=Hris_cloud_country::where('name',$orderdata['customer_country'])->get();
        $platform_id=Hris_cloud_delivery_platform::where('name',$orderdata['Delivery_Platform'])->get();

        $address=new Hris_cloud_customer_addresses;
        $address->phone=$orderdata['phone'];
        $address->customer_id=$orderdata['customer_id'];
        $address->street_address1=$orderdata['street_address1'];
        $address->street_address2=$orderdata['street_address2']; 
        $address->longitude=$orderdata['customer_longitude'];
        $address->latitude=$orderdata['customer_latitude'];
        $address->city=$orderdata['customer_city'];
        $address->state=$orderdata['customer_state'];
        $address->country=$orderdata['customer_country'];
        $address->save();


        $orders = new Hris_cloud_order;
        $orders->grand_total=$orderdata['grand_total']; 
        $orders->platform_id=$orderdata['platform_id']; 
        $orders->address_id=$address->id;
        $orders->customer_id=$orderdata['customer_id'];
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
        $orders->delivery_platform_id=$platform_id['0']['id'];
        $orders->order_time= $orderdata['order_time'];
        $orders->delivery_time=$orderdata['delivery_time'];
        $orders->country_id=$country['0']['id']; 
        $orders->country=$orderdata['customer_country'];
        $orders->food=json_encode($selecteditems);
        $orders->delivery_date=$orderdata['delivery_date'];
        $orders->delivery_date=$orderdata['order_date'];
        $orders->save();

    }





    public function old_customer_name($id)
    {
        $customer_address=Hris_cloud_customer_addresses::select('id','customer_id','street_address1','street_address2')->where('customer_id',$id)->get();
        return view('address',compact('customer_address','id')); 
    }




 
    public function old_new_customer()
    {
       return view('oldcustomer');
    }
  

    public function old_customer_placeorder(Request $req)
    {
     $number=$req->number;
     $address=Hris_cloud_customer::where('phone',$number)->get();
     return view('addressdetails',['addreses'=>$address]); 
    }
 

    public function old_customer_address_placeorder(Request $request)
    {
     $jsonData = $request->getContent();
     $data = json_decode($jsonData, true);
     
     $selecteditems = $data['ids'];
     $orderdata = $data['dataa'];

     $address_id=$orderdata['address_old'];
   
     $customer_id=Hris_cloud_customer_addresses::where('id',$address_id)->get();
     $platform_id=Hris_cloud_delivery_platform::where('name',$orderdata['Delivery_Platform'])->get();
     $country=Hris_cloud_country::where('name',$customer_id[0]['country'])->get();



     $orders = new Hris_cloud_order;
     $orders->grand_total=$orderdata['grand_total']; 
     $orders->platform_id=$orderdata['platform_id']; 
     $orders->address_id=$orderdata['address_old'];
     $orders->customer_id=$customer_id[0]['customer_id'];
     $orders->country=$customer_id[0]['country'];
     $orders->country_id=$country[0]['id'];
     $orders->brand_id=$orderdata['brandid']; 
     $orders->kitchen_id=$orderdata['kitchenid'];
     $orders->platform=$orderdata['platform'];
     $orders->quantity=$orderdata['totalitemquantity'];
     $orders->delivery_fee=$orderdata['delivery_fee'];
     $orders->discount=$orderdata['Discount'];
     $orders->total=$orderdata['totalprice'];
     $orders->comments=$orderdata['Order_Comments'];
     $orders->increment_id=$orderdata['increment_id'];
     $orders->delivery_platform=$orderdata['Delivery_Platform'];
     $orders->payment_method=$orderdata['payment_method']; 
     $orders->subtotal=$orderdata['totalprice'];
     $orders->order_time= $orderdata['order_time'];
     $orders->delivery_time=$orderdata['delivery_time'];
     $orders->delivery_date=$orderdata['delivery_date'];
     $orders->delivery_date=$orderdata['order_date'];
     $orders->delivery_platform_id=$platform_id['0']['id'];
     $orders->food=json_encode($selecteditems);
 
     $orders->save();
    } 
 
}



