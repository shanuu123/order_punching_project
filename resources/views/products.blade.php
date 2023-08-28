<div id="products">

    <div style="height:600px; overflow-y:scroll" width="100%" >
    @foreach($brand as $brand)
       <h2>{{ $brand->name }}</h2> 
       <input type="hidden" id="kitchen_id" value="{{ $brand->kitchen_id }}">
       <input type="hidden" id="brand_id" value="{{ $brand->id }}">
    @endforeach
    
    <?php $pos=0 ?>

    @foreach($unique_category as $hrisCloudBrandMenucategories)
       <div class="card-header" style="background-color:darkgrey"><h4><b>{{$hrisCloudBrandMenucategories->categories}}</b></h4></div>
       <div class="card-body">
            @foreach ($brand_menu as $hrisCloudBrandMenu)
                @if($hrisCloudBrandMenu->categories === $hrisCloudBrandMenucategories->categories)
    
                <div class="card-header">     
                  <h3><input type="checkbox" name="selectedItems[]" data-price="{{ $hrisCloudBrandMenu->sell_price }}" 
                        value="menu:{{ $hrisCloudBrandMenu->custom_name}}, price:  ${{ $hrisCloudBrandMenu->sell_price}},  Qty:" 
                              onchange="calculateTotals()">
                                   {{ $hrisCloudBrandMenu->custom_name }}  ${{ $hrisCloudBrandMenu->sell_price }} 
                  </h3>
        
                      <input type="number" name="quantities[]" value="1" min="1"  onchange="calculateTotals()">
                </div>

                   <div class="addons" id="addons-{{ $hrisCloudBrandMenu->id }}"> 
                    <div class="card-body">

                         <?php $pos=$pos-$pos; ?>
       
                            @foreach ($addon as $hrisCloudBrandMenuAddon)
                               @if($hrisCloudBrandMenu->id == $hrisCloudBrandMenuAddon->menu_id)
                                <?php  $pos++ ?>
                               <div class="col-md-4" >
                                   <div>
        
                                    <input type="checkbox" name="selectedItems[]"  data-price="{{ $hrisCloudBrandMenuAddon->sell_price }}" 
                                        value="addon:{{ $hrisCloudBrandMenuAddon->custom_name}}, price: ${{ $hrisCloudBrandMenuAddon->sell_price}}, Qty:" 
                                           onchange="calculateTotals()">
                                              <span>{{ $hrisCloudBrandMenuAddon->custom_name }}    ${{ $hrisCloudBrandMenuAddon->sell_price}}</span>
        
                                    <input   type="number" name="quantities[]" value="1"  onchange="calculateTotals()">
                                    </div>
                                </div> 
                                @endif
                            @endforeach
                    </div>
                   </div>
 
                        <div style="text-align-last: right" >
                           <span class="toggle-addon-btn" onclick="toggleAddon('{{ $hrisCloudBrandMenu->id }}')" 
                                style="margin-inline-end: 10px">&#x25B6;</span> addons <?php print $pos ?>
                        </div>
                @endif
            @endforeach
         </div>
    @endforeach
        </div>
     <button type="button" class="btn btn-primary" onclick="saveSelection()">Save Selection</button>
</div>

<script>
function toggleAddon(brandId)  
    {
        const addonsElement = document.getElementById('addons-' + brandId);
          if (addonsElement.classList.contains('expanded'))
                {
                   addonsElement.classList.remove('expanded');
                } 
         else 
                {
                   addonsElement.classList.add('expanded');
                }
    }

function calculateTotals()
{
  totalItemQuantity = 0;
  totalPrice = 0;
  const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selectedItems[]"]');
  const quantities = document.querySelectorAll('input[type="number"][name="quantities[]"]');
  
    for (let i = 0; i < checkboxes.length; i++) 
    {
        if (checkboxes[i].checked) 
        {
            const price = parseFloat(checkboxes[i].getAttribute('data-price'));
            const quantity = parseInt(quantities[i].value);
            totalItemQuantity += quantity;
            totalPrice += price * quantity;
        }
    }
}
  
    
function saveSelection() 
{

    const selectedItems = [];
    const quantities = [];
    const checkboxes = document.querySelectorAll('input[type="checkbox"][name="selectedItems[]"]');
    const quantityInputs = document.querySelectorAll('input[type="number"][name="quantities[]"]');
  
    for (let i = 0; i < checkboxes.length; i++)
     {
        if (checkboxes[i].checked)
        {
            selectedItems.push(checkboxes[i].value);
            quantities.push(quantityInputs[i].value);
        }
    }
    var   platform = $('#platform').val(); 
    var   brand =$('#search').val();
    var   brandId = $('#brand_id').val();
    var   kitchen_id = $('#kitchen_id').val();    
    
    let array=selectedItems.map((value,index)=>value+quantities[index]);
   
var dataa={
            platform,
            brand,
            totalItemQuantity,
            totalPrice,
            brandId,
            kitchen_id,
          };
const data={
            array ,
            dataa,
           };
  
    const jsondata=JSON.stringify(data);
      
        $.ajaxSetup({
                  headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });
 $.ajax({
            type:"post",
            url:"/order_details",
            datatype:"json",
            data:jsondata,
            success:function(response){
                                        $('#show').html("");
                                        $('#details').html(response);
                                      }
        });

}
</script>