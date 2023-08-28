<div id="newdata">
    <div class="containers" style="background-color: lightgray" >
    
        <div class="d-flex justify-content-between" >
            <div style="margin-left: 3%">
              <div><b>grand total</b><=>{{ $selecteditems['totalprice']- $selecteditems['Discount'] + $selecteditems['delivery_fee']}}</div>
                <div><b>Delivery Fee</b><=>{{ $selecteditems['delivery_fee'] }}</div>
                {{-- <div><b>Service Charges</b><=>{{$selecteditems['Service_Charges'] }}</div> --}}
                <div><b>Discount</b><=>{{ $selecteditems['Discount'] }}</div>
                <div><b>delivery_date</b><=>{{ $selecteditems['delivery_date'] }}</div>
                <div><b>order_date</b><=>{{ $selecteditems['order_date'] }}</div>
                <div><b>order_time</b><=>{{ $selecteditems['order_time'] }}</div>
                <div><b>delivery_time</b><=>{{ $selecteditems['delivery_time'] }}</div>
                <div><b>Order Comments</b><=>{{ $selecteditems['Order_Comments'] }}</div>
                <div><b>Service Comments</b><=>{{ $selecteditems['Service_Comments'] }}</div>
                <div><b>Delivery Platform</b><=>{{ $selecteditems['Delivery_Platform'] }}</div>
                <div><b>platform_id</b><=>{{ $selecteditems['platform_id'] }}</div>
                <div><b>platform</b><=>{{ $selecteditems['platform'] }}</div>
                <div><b>brand</b><=>{{ $selecteditems['brand'] }}</div>
                <div><b>totalItemQuantity</b><=>{{ $selecteditems['totalitemquantity'] }}</div>
                <div><b>totalPrice</b><=>{{ $selecteditems['totalprice'] }}</div>
                <div><b>brandId</b><=>{{ $selecteditems['brandid'] }}</div>
                <div><b>kitchen id</b><=>{{ $selecteditems['kitchenid'] }}</div>
                <div><b>payment_method</b><=>{{ $selecteditems['payment_method'] }}</div>
                <div><b>increment_id</b><=>{{ $selecteditems['increment_id'] }}</div>
            </div>
            <div style="margin-right: 3%">
                 @for($i=0;$i<count($ids);$i++)
                      <div id="selected_items-{{$i}}">{{$ids[$i]}}</div>
                 @endfor
            </div>
        </div>
    </div>

        <div style="margin-left: 3%">
          <input type="hidden" id="order_date" value="{{ $selecteditems['order_date'] }}">
          <input type="hidden" id="delivery_date" value="{{ $selecteditems['delivery_date'] }}">
          <input type="hidden" id="grand_total" value="{{ $selecteditems['totalprice']- $selecteditems['Discount'] + $selecteditems['delivery_fee']}}">
          <input type="hidden" id="increment_id" value="{{ $selecteditems['increment_id'] }}">
          <input type="hidden" id="delivery_time" value="{{ $selecteditems['delivery_time'] }}">
          <input type="hidden" id="order_time" value="{{ $selecteditems['order_time'] }}">
          <input type="hidden" id="delivery_fee" value="{{ $selecteditems['delivery_fee'] }}">
          {{-- <input type="hidden"  id="Service_Charges" value="{{ $selecteditems['Service_Charges'] }}"> --}}
          <input type="hidden"  id="Discount" value="{{ $selecteditems['Discount']}}">
          <input type="hidden"  id="Order_Comments" value="{{ $selecteditems['Order_Comments'] }}">
          <input type="hidden"  id="Service_Comments" value="{{ $selecteditems['Service_Comments'] }}">
          <input type="hidden"  id="Delivery_Platform" value="{{ $selecteditems['Delivery_Platform'] }}">
          <input type="hidden"  id="platform_id" value="{{ $selecteditems['platform_id'] }}">
          <input type="hidden"  id="platform" value="{{ $selecteditems['platform'] }}">
          <input type="hidden"  id="brand" value="{{ $selecteditems['brand'] }}">
          <input type="hidden"  id="totalitemquantity" value="{{ $selecteditems['totalitemquantity'] }}">
          <input type="hidden"  id="totalprice" value="{{ $selecteditems['totalprice'] }}">
          <input type="hidden"  id="brandid" value="{{ $selecteditems['brandid'] }}">
          <input type="hidden" id="kitchenid" value="{{$selecteditems['kitchenid']}}" >
          <input type="hidden" id="payment_method" value="{{$selecteditems['payment_method']}}" >
        </div>


        <button class="btn btn-outline-success my-2 my-sm-0 new_customer" type="button">New Customer </button>
        <button class="btn btn-outline-success my-2 my-sm-0 old_customer" type="button">old Customer</button>
        <button class="btn btn-outline-success my-2 my-sm-0 self_delivery" type="button">Self Delivery</button>
        <div id="newcostomerdetail">
        </div>
        <div id="oldcostomerdetail">
        </div> 
        <div id="selfdelivery">
        </div> 
        
</div>

<script>
$(document).ready(function()
 {  
  $(document).on('click','.old_customer',function(e)
      {
        e.preventDefault();
        $.ajax({
                  type:"post",
                  url:"/oldcustomer",
                  success:function(response)
                     {
                        $('#newcostomerdetail').html("");
                        $('#selfdelivery').html("");
                        $('#oldcostomerdetail').html(response);
                      }
              });                    
      });


      $(document).on('click','.find_old_customer',function(e)
         {
              e.preventDefault();
           const data={
            'number':$('#phonenumber').val(),
           };
              

              $.ajaxSetup({
                                  headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                           }
                                });
        $.ajax({
                type:"post",
                url:"/oldcustomerorder",
                datatype:"json",
                data:data,
                success:function(response)
                {
                  $('#addresses').html("");
                  $('#addresses').html(response);
                
                }
              });

             
         });
     
    $(document).on('click','.oldcustomerorder',function(e)
         {
              e.preventDefault();
              var customer_name=$("input[name='customer_name']:checked").val();
           
              

              $.ajaxSetup({
                                  headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                           }
                                });
        $.ajax({
                type:"post",
                url:"/oldcustomername/"+customer_name,
                success:function(response)
                {
                  $('#addresses').html("");
                  $('#customer_addresses').html(response);
                
                }
              });

             
         });



         $(document).on('click','.old_customer_order',function(e) 
       {
       e.preventDefault();
       var dataa={
                  'increment_id':$('#increment_id').val(),
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
                  'address_old':$("input[name='customer_address']:checked").val(),
                  'delivery_date':$('#delivery_date').val(),
                  'order_date':$('#order_date').val(),
                  'grand_total':$('#grand_total').val(),
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
                url:"/oldcustomeraddress",
                datatype:"json",
                data:jsondata,
                success:function(response)
                {
                   window.location.reload()
                }
              });
       });




  $(document).on('click','.old_customer_new_address',function(e) 
       {
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
                url:"/new_address_for_old_customer_order",
                datatype:"json",
                data:jsondata,
                success:function(response)
                {
                  if(response.status==400){
                    $('#error_messagess').html("");
                    $('#error_messagess').addClass('alert alert-success')
                    $.each(response.errors,function (key, err_values)
                              {
                                   $('#error_messagess').append('<li>'+err_values+'</li>');
                               });
                  }
                  else{
                  //  window.location.reload()
                  $('#oldcustomernewaddressmodal').modal('hide');
                  $('#newaddressoldcustomer').modal('show');
                  }
                  }
              });
       });

    $(document).on('click','.new_customer',function(e) 
    {
      e.preventDefault();
       $.ajax({
               type:"post",
               url:"/newcustomer",
               success:function(response) 
               {
                  $('#oldcostomerdetail').html("");
                  $('#selfdelivery').html("");
                  $('#newcostomerdetail').html(response);
               }
              });                    
    });
    

    $(document).on('click','.new_customer_order_place',function(e) 
    {
       e.preventDefault();
       var dataa={
                 'increment_id':$('#increment_id').val(),
                 'platform_id':$('#platform_id').val(),
                 'platform':$('#platform').val(),
                 'brand':$('#brand').val(),
                 'totalitemquantity':$('#totalitemquantity').val(),
                 'totalprice':$('#totalprice').val(),
                 'brandid':$('#brandid').val(),
                 'order_time':$('#order_time').val(),
                 'delivery_time':$('#delivery_time').val(),
                 'kitchenid':$('#kitchenid').val(),
                 'delivery_fee':$('#delivery_fee').val(),
               //   'Service_Charges':$('#Service_Charges').val(),
                 'Discount':$('#Discount').val(),
                 'Order_Comments':$('#Order_Comments').val(),
                 'Service_Comments':$('#Service_Comments').val(),
                 'Delivery_Platform':$('#Delivery_Platform').val(),
                 'customer_name':$('#name').val(),
                 'customer_email':$('#email').val(),
                 'customer_phonee':$('#phonee').val(),
                 'customer_address1':$('#address1').val(),
                 'customer_address2':$('#address2').val(),
                 'customer_longitude':$('#longitude').val(),
                 'customer_latitude':$('#latitude').val(),
                 'customer_city':$('#city').val(),
                 'customer_state':$('#state').val(),
                 'customer_country':$('#country').val(),
                 'payment_method':$('#payment_method').val(),
                 'delivery_date':$('#delivery_date').val(),
                 'order_date':$('#order_date').val(),
                 'grand_total':$('#grand_total').val(),
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
                  url:"/modal_new_customer_order_place",
                  datatype:"json",
                  data:jsondata,
                  success:function(response)
                  {
                      window.location.reload();
                  } 

               });                     
    });

    $(document).on('click','.self_delivery',function(e)
    {
       e.preventDefault();
       $.ajax({
                 type:"post",
                 url:"/selfdelivery",
                 success:function(response)
                {
                     $('#newcostomerdetail').html("");
                     $('#oldcostomerdetail').html("");
                     $('#selfdelivery').html(response);
                }
             });                    
    });

     $(document).on('click','.place_self_delivery_order',function(e)
     {
      e.preventDefault();
      var data={
                  'increment_id':$('#increment_id').val(),
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
                  'delivery_date':$('#delivery_date').val(),
                  'order_date':$('#order_date').val(),
                  'grand_total':$('#grand_total').val(),
                 };
      var ids=[];
      $('div[id^="selected_items-"]').each(function ()
      {
        ids.push(this.innerHTML)
      });

      const dataaa={
                     data,
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
               url:"/placeorder",
               datatype:"json",
               data:jsondata,
               success:function(response)
               {
                  window.location.reload()
               }
            });
     });


        $('#country').on('keyup',function()
        {
              var query= $(this).val(); 
              $.ajax({
                      url:"countries",
                      type:"post",
                      data:{'country':query},
                      success:function(data)
                           { 
                            $('#search_country').html(data);
                          }
                    });
        });

});

function  country_data(id)
      {
            var btnclaues=document.getElementById(id).innerHTML;
            document.getElementById("country").value =btnclaues;
            $('#search_country').html("");
      }

</script>
