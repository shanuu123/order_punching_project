@extends('master')
@section("content")
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="card text-center   order_detail" id="show" >
  <div class="card-header" style="background-color: lightgray">
      <h4><b> ORDER DETAILS</b></h4>
  </div>
  <div class="card-body" style="background-color: lightgray" >
      <div class="card-body" style="text-align: left" id="success_message" style="background-color: lightsalmon">
      </div> 
      <div class="card text-center" style="background-color: lightgray">
          <div class="card-header" style="text-align: left" style="background-color: lightsalmon">
             <h5><b>currently add the new order</b></h5>
          </div>
      </div>
      <br>
      <div class="card text-center" style="background-color: lightgray">
            <div class="card-body" style="text-align: left" >
                <p><b>Enter The Platform Name</b></p>
                <div classs="form-group">
                   <input type="text" id="platform" name="platform" placeholder="enter platform" class="form-control searchbar" />
            
                   <div id="error_platform">
                   </div>
               </div>
           </div>
      </div> 
    <br><br>
    <div class="card text-center" style="background-color: lightgray">
      <div class="card-body" style="text-align: left" >
           <p><b>Enter The Brand Name</b></p>
              <div classs="form-group" >
                  <input type="text" id="search" name="search" placeholder="enter brand" class="form-control searchbar">
              </div>
               <div class="card-footer" style="text-align-last: right">
                 <button class="btn btn-primary my-2 my-sm-0 searching-brand" style="text-align: left" type="submit">confirm</button>
               </div>
           <div id="search_list">
           </div>
           <div id="products">
           </div>
      </div>
     </div>
      <br>
  </div>
</div>
<div id="newdata"></div>
<div id="details"></div>

<div class="modal fade" id="selfdeliverymodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        you want to place self delivery order
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary  place_self_delivery_order">confirm order</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="oldcustomerdelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        you want to place old customer order
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary old_customer_order">confirm order</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="newcustomerdelivery" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        you want to place new customer order
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary new_customer_order_place">confirm order</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="newaddressoldcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        you want to place new addresss with old customer
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary old_customer_new_address_order">confirm order</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="oldcustomernewaddressmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">add new addresses for old customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="error_messagess"></div>
        <p><b>address1</b></p>
        <input type="text" id="address1" name="address1" placeholder="enter address1" class="form-control searchbar" /><br>
        <p><b>address2</b></p>
        <input type="text" id="address2" name="address2" placeholder="enter address2" class="form-control searchbar" /><br> 
        <p><b>longitude</b></p>
        <input type=text placeholder="enter longitude" class="form-control" id="longitudes">
        <p><b>latitude</b></p>
        <input type="text" placeholder="enter latitude" class="form-control" id="latitudes">
        <p><b>city</b></p>
        <input type="text" placeholder="enter city" class="form-control" id="citys">
        <p><b>state</b></p>
        <input type="text" placeholder="enter city" class="form-control" id="states">
        <p><b>country</b></p>
        <select id="country" name="countries">
          <option value="">..</option> 
          <option value="Belgium">Belgium</option>
          <option value="UAE">UAE</option>
          <option value="Netherlands">Netherlands</option>
          <option value="USA">USA</option>
          <option value="KSA">KSA</option>
          <option value="Lithuania">Lithuania</option>
          <option value="South Africa">South Africa</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary old_customer_new_address">confirm order</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
$(document).on('click','.searching-brand',function(e){
  e.preventDefault();
const platform=$('#platform').val();
const data = $('#checkhiddenvalue').val();
 if(data >'0')
       {  
         if(platform >'0')
                       {
                         $.ajaxSetup({
                                     headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                               }
                                    });
                          $.ajax({
                          type:"get",
                          url:"/order_punching/"+data,
                          datatype:"json",
                          success:function(response){
                                                 $('#error_platform').html("");
                                                  $('#search_list').html("");
                                                  $('#products').html(response);
                                                 
                                                  }

                                   });
                          }
           else{
                $('#search_list').html("");
                $('#search').val("");
                $('#error_platform').addClass("alert alert-warning");
                $('#error_platform').html("enter the platform");
                }
         }
else{
  $('#search_list').html("");
  $('#search').val("");
  $('#products').html("");
   $('#search_list').html("enter the valid data");
}
});
});
</script>
<script>
    $(document).ready(function(){
        $('#search').on('keyup',function(){
            var query= $(this).val(); 
            $.ajax({
                url:"search",
                type:"GET",
                data:{'search':query},
                success:function(data){ 
                    $('#search_list').html(data);
    
                    
                }
            });
          
        });
 });


function addtobox(id)
{
  var btnclaue =  document.getElementById("txtname"+id).innerHTML;
  
  var btnclaues =  document.getElementById("txtnames"+id).innerHTML;
 
  document.getElementById("search").value =   btnclaue+"   "+btnclaues;
  document.getElementById("checkhiddenvalue").value = id;
}


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
   var route="{{ url('autocomplete-search') }}";
   $('#platform').typeahead({
           source:function(query,process){
                 return $.get(route,{
                     query:query
                          },
                       function(data){
                                return process(data);
                                     });
                                           }
                            });
</script> 
<script>
  $(document).ready(function()
  {
         $(document).on('click','.exampleModaldelivery',function(e)
           {
              e.preventDefault();
              $('#selfdeliverymodel').modal('show');
           });





           $(document).on('click','.oldcustomernewaddress',function(e)
           {
              e.preventDefault();

              $('#oldcustomernewaddressmodal').modal('show');
           });




           
         $(document).on('click','.oldcustomerplaceorder',function(e)
         {
              e.preventDefault();
              $('#oldcustomerdelivery').modal('show');
         });

        $(document).on('click','.old_customer_new_address_order',function(e){
              e.preventDefault();
              var dataa={
                  'increment_id':$('#increment_id').val(),
                  'phone':$('#phonenumber').val(),
                  'platform':$('#platform').val(),
                  'platform_id':$('#platform_id').val(),
                  'brand':$('#brand').val(),
                  'totalitemquantity':$('#totalitemquantity').val(),
                  'totalprice':$('#totalprice').val(),
                  'brandid':$('#brandid').val(),
                  'kitchenid':$('#kitchenid').val(),
                  'delivery_fee':$('#delivery_fee').val(),
                  'order_time':$('#order_time').val(),
                  'delivery_time':$('#delivery_time').val(),
                  // 'Service_Charges':$('#Service_Charges').val(),
                  'Discount':$('#Discount').val(),
                  'Order_Comments':$('#Order_Comments').val(),
                  'Service_Comments':$('#Service_Comments').val(),
                  'Delivery_Platform':$('#Delivery_Platform').val(),
                  'payment_method':$('#payment_method').val(),
                  'street_address1':$("#address1").val(),
                  'street_address2':$("#address2").val(),
                  'delivery_date':$('#delivery_date').val(),
                  'order_date':$('#order_date').val(),
                  'grand_total':$('#grand_total').val(),
                  'customer_id':$('#customer_id').val(),
                  'customer_longitude':$('#longitudes').val(),
                  'customer_latitude':$('#latitudes').val(),
                  'customer_city':$('#citys').val(),
                  'customer_state':$('#states').val(),
                  'customer_country':$('#country').val(),    
                 };

       var ids=[];
       $('div[id^="selected_items-"]').each(function ()
               {
                    ids.push(this.innerHTML)
               });

       const dataaa={
                     dataa,
                     ids,
                    }
       const jsondata=JSON.stringify(dataaa);
                  
                    $.ajaxSetup({
                                  headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                           }
                                });
        $.ajax({
                type:"post",
                url:"/new_address_for_old_customer_order_place",
                datatype:"json",
                data:jsondata,
                success:function(response)
                {
                  window.location.reload()
                  }
              });
        })





         $(document).on('click','.add_customer',function(e) 
         {
              e.preventDefault();
              var data={
                          'customer_name':$('#name').val(),
                          'customer_email':$('#email').val(),
                          'customer_phonee':$('#phonee').val(),
                          'customer_address1':$('#address1').val(),
                          'customer_address2':$('#address2').val(),
                          'customer_country':$('#country').val(),
                       }
                      $.ajaxSetup({
                                     headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                               }
                                  });


               $.ajax({
                       type:"post",
                       url:"/new_customer_placeorder",
                       datatype:"json",
                       data:data,
                       success:function(response)
                       {
                          if(response.status==400)
                          {
                              $('#form_errlist').html("");
                              $('#form_errlist').addClass("alert alert-warning");
                              $.each(response.errors,function (key, err_values)
                              {
                                   $('#form_errlist').append('<li>'+err_values+'</li>');
                               });
                          }
                           else
                            { 
                               $('#newcustomerdelivery').modal('show');
                             }
    
                        }
                     });

  

          });


  });

  
  </script>
@endsection