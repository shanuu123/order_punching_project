<!DOCTYPE html>
<html lang="{{ 
str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORDER PUNCHING </title>
  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name','laravel') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>  
   
       {{ View::make('header') }}
     @yield('content')
      {{ View::make('footer') }} 


      
</body>
<style>
.order_detail{
              margin-top: -20px;
             }
body{
        margin: 0;
        padding: 0;
    }
.toggle-addon-btn 
    {
        cursor: pointer;
    }
.addons 
    {
        display: none;
    }
.expanded
    {
        display: block;
    }
</style>
<script>
 $(document).ready(function()
 {
    $('#Delivery_Platform').on('keyup',function()
    {
        var query= $(this).val(); 
        $.ajax({
                   url:"Delivery_Platform",
                   type:"GET",
                   data:{'Delivery_Platform':query},
                   success:function(data) 
                   { 
                    $('#search_list').html(data);
                    }
                });
     });
 });
</script>