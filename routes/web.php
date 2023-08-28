<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User_controller;
use App\Http\Controllers\search_controller;
use App\Http\Controllers\newcustomer_controller;
use App\Http\Controllers\selfdelivery_controller;
use App\Http\Controllers\oldcustomer_controller;
use App\Http\Controllers\orderdetails_controller;


Route::view('order_punching',"order_punching");
Route::get('/autocomplete-search',[search_controller::class,'autocompleteSearch']);
Route::get("/search",[search_controller::class,'search']);
Route::post("/Delivery",[search_controller::class,'searching']);
Route::post("/countries",[search_controller::class,'searching_country']);
Route::get("order_punching/{name}",[orderdetails_controller::class,'showbrandmanu']);
Route::post("order_details",[orderdetails_controller::class,'orderdetails']);
Route::post("ordernewdata",[orderdetails_controller::class,'ordernewdata']);
Route::post('newcustomer',[newcustomer_controller::class,'add_new_customer']);
Route::post('oldcustomer',[oldcustomer_controller::class,'old_new_customer']);
Route::post('selfdelivery',[selfdelivery_controller::class,'self_delivery']);
Route::post('placeorder',[selfdelivery_controller::class,'place_self_delivery_order']);
Route::post('new_customer_placeorder',[newcustomer_controller::class,'new_customer_placeorder']);
Route::post('modal_new_customer_order_place',[newcustomer_controller::class,'add_new_customer_order']);
Route::post('oldcustomerorder',[oldcustomer_controller::class,'old_customer_placeorder']);
Route::post('oldcustomeraddress',[oldcustomer_controller::class,'old_customer_address_placeorder']);
Route::post('oldcustomername/{name}',[oldcustomer_controller::class,'old_customer_name']);
Route::post('new_address_for_old_customer_order',[oldcustomer_controller::class,'new_address_for_old_customer_order']);
Route::post('new_address_for_old_customer_order_place',[oldcustomer_controller::class,'new_address_for_old_customer_order_place']);
