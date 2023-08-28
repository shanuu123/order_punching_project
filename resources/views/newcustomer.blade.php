<div id="newcostomerdetail">
  <div class="card" style="background-color: lightgray">
    <div class="card-header" style="background-color: darkgrey" >
      <h3><b> enter new customer details</b></h3>
    </div>
    <div class="card-body" style="text-align: left" style="background-color: lightgray">
         <ul id="saveform_errlist"></ul>
         <p><b>name</b></p>
         <input type="text" placeholder="enter name" class="form-control" id="name">
         <p><b>emial</b></p>
         <input type="email" placeholder="enter email " class="form-control"  id="email">
         <p><b>phone</b></p>
         <input type="text" placeholder="enterphone " class="form-control "  id="phonee">
         {{-- <p><b>country</b></p>
         <input type="text" placeholder="enter country" class="form-control " id="country">
         <div id="search_country"></div> --}}
         <p><b>address1</b></p>
         <input type="text" placeholder="enter address1" class="form-control" id="address1">
         <p><b>address2</b></p>
         <input type="text" placeholder="enter address2" class="form-control" id="address2">
         <p><b>longitude</b></p>
         <input type=text placeholder="enter longitude" class="form-control" id="longitude">
         <p><b>latitude</b></p>
         <input type="text" placeholder="enter latitude" class="form-control" id="latitude">
         <p><b>city</b></p>
         <input type="text" placeholder="enter city" class="form-control" id="city">
         <p><b>state</b></p>
         <input type="text" placeholder="enter city" class="form-control" id="state">
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
          <div id="form_errlist">
          </div> 
          <div class="modal-footer" style="background-color: darkgrey">
            <button type="button" class="btn btn-primary add_customer"  >place order</button>
          </div>
  </div>
</div>
<script>
  function  country_data(id)
  {
      var btnclaues=document.getElementById(id).innerHTML;
      document.getElementById("country").value =btnclaues;
      $('#search_country').html("");
  }

$(document).ready(function()
  {
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
</script>