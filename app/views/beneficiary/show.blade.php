@extends('layouts.main')

@section('content')
<h3>Admin Dashboard</h3>
<ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
    <li class="active"><a href="{{ URL::to('franchise') }}">Franchise products</a></li>
    <li><a href="/franchise">Products List</a> </li>
    <li><a href="{{ URL::to('users') }}">Back</a></li>
</ul>

<div class="panel panel-default">
  <div class="panel-heading bold">Product Listings</div>
  <table class="table product_view">
  <thead>
  	<td class="blue"> Product ID: </td>
  	<td> {{ $franchise->id }} </td>
  </thead>
  <tbody>
    <tr>
  		<td class="blue"> Product Name: </td>
      <td><p> {{ $franchise->product_name }} </p> </td>
    </tr>
    <tr>
      <td class="blue"> Product SKU: </td>
      <td><p> {{ $franchise->product_sku }} </p> </td>
    </tr>
     <tr>
      <td class="blue"> Product Validity Period: </td>
      <td><p> {{ $franchise->product_validity_period }} </p> </td>
    </tr>
    <tr>
      <td class="blue"> Product Price: </td>
      <td><p> {{ $franchise->product_price }} </p> </td>
    </tr>
    <tr>
      <td class="blue"> Allocated to: </td>
      <td><p>@if($franchise_names == '')
              All 
            @else
            {{ '<pre>'.implode(',', $franchise_names).'</pre>' }}
            @endif
          </p> 
      </td>
    </tr>
    </tbody>
  </table>
</div>
@stop