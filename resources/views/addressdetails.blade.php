<div id="addresses">
           @foreach ($addreses as $items)
                <input type="radio" id="age1" name="customer_name" value="{{ $items['id'] }}">
                <label for="age1"> 
                   <div class="container" style="border: 50px">
                       <p><b>customer_id:</b>  {{ $items['id'] }}</p>
                       <p><b>customer_name:</b>  {{$items['name']}}</p>
                   </div>
                 </label><br>
            @endforeach
              <button  class="btn btn-outline-success my-2 my-sm-0 oldcustomerorder  btn-primary" type="button">find the address</button>
</div>