<div id="customer_addresses">
    <input type="hidden" id="customer_id" value="{{$id}}">
    @foreach ($customer_address as $items)
         <input type="radio" id="age1" name="customer_address" value="{{ $items['id'] }}">
         <label for="age1"> 
            <div class="container" style="border: 50px">
                <p><b>street1:</b>  {{ $items['street_address1'] }}</p>
                <p><b>street2:</b>  {{$items['street_address2']}}</p>
            </div>
          </label><br>
     @endforeach
       <button  class="btn btn-outline-success my-2 my-sm-0 oldcustomerplaceorder btn-primary" type="button">place order</button>
       <button  class="btn btn-outline-success my-2 my-sm-0 oldcustomernewaddress btn-primary" type="button">add new address</button>
    </div>