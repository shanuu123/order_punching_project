<div id="details"  >
 
  <div class="containers" style="background-color: lightgray">
    
    <div class="d-flex justify-content-between" >
        <div style="margin-left: 3%">
            <div><b>platform</b>:{{ $ids['platform'] }}</div>
            <div><b>brand</b>:{{ $ids['brand'] }}</div>
            <div><b>totalItemQuantity</b>:{{ $ids['totalItemQuantity'] }}</div>
            <div><b>totalPrice</b>:${{ $ids['totalPrice'] }}</div>
            <div><b>brandId</b>:{{ $ids['brandId'] }}</div>
            <div><b>kitchen_id</b>:{{ $ids['kitchen_id'] }}</div>
            <div><b>platform_id</b>:{{ $platform_id['0']['id'] }}</div>
        </div>
        <div style="margin-right: 3%">
             @for($i=0;$i<count($selecteditems);$i++)
                 <div id="selected_item-{{$i}}">{{ $selecteditems[$i]}}</div>
             @endfor
         </div>
          
    </div>
  </div>
  <form>
    <div class="order_detail" id="show" >
      <div class="card text-center">
          <div class="card-header" style="background-color: darkgrey" >
          <h4 ><b>Add MORE DETAILS</b></h4>
          </div>
        <div class="card-body text-left" style="background-color: lightgrey">
          <input type="hidden" id="platform_id" name="platform_id" value="{{ $platform_id['0']['id'] }}" />
          <input type="hidden" id="platform" name="platform" value="{{ $ids['platform'] }}" />
          <input type="hidden" id="brand" name="brand" placeholder="Delivery "  value="{{ $ids['brand'] }}"/>
          <input type="hidden" id="totalitemquantity" name="totalitemquantity" value="{{ $ids['totalItemQuantity'] }}"/>
          <input type="hidden" id="totalprice" name="totalprice"   value="{{ $ids['totalPrice'] }}"/>
          <input type="hidden" id="brandid" name="brandid" value="{{ $ids['brandId'] }}" />
          <input type="hidden" id="kitchenid" name="kitchenid" value="{{ $ids['kitchen_id'] }}"/>      
          
          <p><b>Increment id</b></p>
          <input type="text" id="increment_id" name="increment_id" placeholder="increment_id" class="form-control searchbar" />
          <br >
          <p><b>Delivery Fee</b></p>
          <input type="number" id="delivery_fee" name="delivery_fee" placeholder="Delivery Fee" class="form-control searchbar" min="0" />
          <br>
          {{-- <p><b>Service Charges</b></p>
          <input type="number" id="Service_Charges" name="Service Charges" placeholder="Service Charges" class="form-control searchbar" min="0" />
          <br> --}}
          <p><b>Discount</b></p>
          <input type="number" id="Discount" name="Discount"class="form-control searchbar" value='0'/>
          <br>
          <p><b>Order Comments</b></p>
           <input type="text" id="Order_Comments" name="Order Comments" placeholder="Order Comments" class="form-control searchbar" />
          <br>
          <p><b>Service Comments</b></p>
            <input type="text" id="Service_Comments" name="Service Comments" placeholder="Service Comments" class="form-control searchbar" />
          <br>
          <p><b>Order date</b></p>
          <input type="date" class="form-control" id="order_date" 
           value="<?php
                         $datetimestamp=$time['ordertime'];
                         $timeoutput=date('Y-m-d',strtotime($datetimestamp));  
                         echo $timeoutput;
                     
                   ?>"
          >

          <p><b>Order Time</b></p>
          <input type="time" class="form-control" id="order_time" 
           value="<?php
                         $datetimestamp=$time['ordertime'];
                         $timeoutput=date('H:i',strtotime($datetimestamp));  
                         echo $timeoutput;
                   ?>"
          >

          <p><b>Delivery Date</b></p>
          <input type="date" class="form-control" id="delivery_date" 
           value="<?php
                         $datetime=$time['deliverytime'];
                         $timedate=date('Y-m-d',strtotime($datetime));  
                         echo $timedate;
                   ?>"
          >
        <br>
        <p><b>Delivery Time</b></p>
        <input type="time" class="form-control" id="delivery_time" 
              value="<?php
                         $datetimestamp=$time['deliverytime'];
                         $timeoutput=date('H:i',strtotime($datetimestamp));
                         echo $timeoutput;
                      ?>" 
        >
      <br>
          <p><b>Delivery Platform</b></p>
          <input type="text" id="Delivery_Platform" name="Delivery_Platform" placeholder="Delivery Platform" class="form-control searchbar" />
          <div id="search_delivery_platform">
          </div><br>
          <div>
            <p><b>payment method</b><p>
            <input type="radio" value="card" name="payment"><span>card </span><br>
            <input type="radio" value="online" name="payment"><span>online</span><br>
            <input type="radio" value="cash on delivery" name="payment"><span>cash on delivery</span><br>
          </div> <br>
          <div id="saveform_errlist"></div>
          <div>
              <button type="submit" id="submit" name="submit" class="submit btn-primary" value="submit">submit</button>
          </div>              
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  // search the delivery platform from the table through ajax call
 $(document).ready(function()
    {
        $('#Delivery_Platform').on('keyup',function()
        {
          var query= $(this).val(); 
          $.ajax(
              {
                url:"Delivery",
                type:"post",
                data:{'Delivery_Platform':query},
                success:function(data)
                                      { 
                                          $('#search_delivery_platform').html(data);
                                       }
              });
        });
   
    });


</script>
<script>
// ajax call to submit the first form  
$(document).ready(function()
{
  $(document).on( 'click','.submit', function(e) 
  {
   e.preventDefault();
     var data={
                'platform_id':$('#platform_id').val(),
                'platform':$('#platform').val(),
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
                'order_date':$('#order_date').val(),
                'delivery_date':$('#delivery_date').val(),
                'Order_Comments':$('#Order_Comments').val(),
                'Service_Comments':$('#Service_Comments').val(),
                'Delivery_Platform':$('#Delivery_Platform').val(),
                'payment_method':$("input[name='payment']:checked").val(),
                'increment_id':$('#increment_id').val(),
              };
     var selecteditems=[];
     $('div[id^="selected_item-"]').each(function ()
              {
                 selecteditems.push(this.innerHTML)
              });
 
              const dataa={
                           data,
                           selecteditems,
                           }

             const jsondata=JSON.stringify(dataa);

                  $.ajaxSetup({
                                 headers: {
                                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                           }
                              });

      $.ajax({
              type:"post",
              url:"/ordernewdata",
              datatype:"json",
              data:jsondata,
              success:function(response)
              {
                    if(response.status==400)
                    {
                          $('#saveform_errlist').html("");
                          $('#saveform_errlist').addClass("alert alert-warning");
                          $.each(response.errors,function (key, err_values) 
                          {
                              $('#saveform_errlist').append('<li>'+err_values+'</li>');
                          });
                    }
                    else
                    { 
                          $('#saveform_errlist').html("");
                          $('#show').html("");
                          $('#details').html("");
                          $('#newdata').html(response);
                    }
              }
            }); 

  });
});

</script>
{{-- function to input the value to the  delivery platform input field with ajax call  --}}
<script>
  function  delivery_platform(id) 
  {
      var btnclaues=document.getElementById(id).innerHTML;
      document.getElementById("Delivery_Platform").value =btnclaues;
      $('#search_delivery_platform').html("");
  }

</script>

