<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hris_cloud_platform;
use App\Models\Hris_cloud_brand;
use App\Models\Hris_cloud_delivery_platform;
use App\Models\Hris_cloud_country;
use Validator;
use Illuminate\Support\Facades\DB; 


class search_controller extends Controller
{
    public function autocompleteSearch(Request $request)
    {
      $query = $request->get('query');
      $filterResult =Hris_cloud_platform::where('name', 'LIKE', '%'. $query. '%')->get();
      return response()->json($filterResult);
    } 


    public function searching(Request $req)
    {
     if($req->ajax()){
                          $data=Hris_cloud_delivery_platform::where('name','like','%'.$req->Delivery_Platform.'%')->where('integrated','like','1')->get();
                          $output='';
                          if(count($data)>0){
                               foreach($data as $row){
                                          $output .=' <tr>  <th scope="row"><li id='.$row->id.' name='.$row->id.' 
                                          value="'.$row->name.'" onClick=delivery_platform('.$row->id.'); >'.$row->name.'</li></th></tr>';
                                                      }
                                             }
                          else{
                                $output .='No results';
                              }
                        return $output;
                      }
      }
            
 

 
      public function search(Request $request){
 
        if($request->ajax()){

          $data=Hris_cloud_brand::where('id','like','%'.$request->search.'%')
          ->orwhere('name','like','%'.$request->search.'%')
          ->orwhere('branch','like','%'.$request->search.'%')->get();

          $output='';
          if(count($data)>0){
                              $output ='
              
                               <input type="hidden" id="checkhiddenvalue">
                               <table class="table">
                         <thead>
                              <tr>
                                   <th scope="col">button id</th>
                                   <th scope="col">Name</th>
                                   <th scope="col">branch</th>
                              </tr>
                         </thead>
                          <tbody>';
                                      foreach($data as $row){
                                       $output .='  
                                       <tr>
                                              <th scope="row"><button id="btnbrandcheck'.$row->id.'" name="btnbrandcheck'.$row->id.'"  
                                              type="radio" value="'.$row->id.'" onclick="addtobox('.$row->id.');">'.$row->id.' 
                                              </button>
                                              </th>
                                              <td  id="txtname'.$row->id.'">'.$row->name.'</td>
                                              <td  id="txtnames'.$row->id.'">'.$row->branch.'</td>
                                       </tr>
                                            ';
                                     }
                                        $output .= '
                          </tbody>
                        </table>';
                          }
               else
                  {
                    $output .='No results';
                  }
          return $output;
            }
      }



     public function searching_country(Request $req)
     {
        if($req->ajax()){
               $data=Hris_cloud_country::where('name','like','%'.$req->country.'%')->get();
               $output='';
                  if(count($data)>0){
                      foreach($data as $row){
                         $output .=' <tr>  <th scope="row"><li id='.$row->id.' name='.$row->id.' 
                          value="'.$row->name.'" onClick=country_data('.$row->id.'); >'.$row->name.'</li></th></tr>';
                                            }
                                       }
                    else{
                            $output .='No results';
                           }
          return $output;
                 }
      }
}

