@extends('layouts.main')
@section('content')
<div class="container">
  
  <h3>Admin Dashboard</h3>

  <ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
    <li class="active"><a href="{{ URL::to('franchise') }}">Franchise products</a></li>
    <li><a href="{{ URL::to('users') }}">Back</a></li>
  </ul>

  <h4>Franchise Products</h4>

  <!-- will be used to show any messages -->
  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <td>ID</td>
          <td>Product Name</td>
          <td>Product Validity</td>
          <td>Product Price</td>
         <!--  <td>Franchise</td> -->
          <td>Publish</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
      @foreach($franchise as $key => $value)
        <tr>
          <td>{{ $value->id}}</td>
          <td>{{ $value->product_name }}</td>
          <td>{{ $value->product_validity_period }}</td>
          <td>{{ $value->product_price }}</td>
         <!--  <td>{{ $value->franchise_ids }}</td> -->
          <td>@if($value->publish == 1)
                Yes
              @else
                No
              @endif
          </td>
          <td>
            <!-- delete the job (uses the destroy method DESTROY /jobs/{id} -->

            @if(Auth::check() && Auth::user()->usertype == 'admin')
            {{ Form::open(array('url' => 'franchise/' . $value->id, 'class' => 'pull-right')) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', array('class' => 'btn btn-warning', 'onclick' => "if(!confirm('Are you sure to delete this item?')){return false;};")) }}
            {{ Form::close() }}
            @endif

            <!-- show the job (uses the show method found at GET /jobs/{id} -->
            <a class="btn btn-small btn-success" href="{{ URL::to('franchise/' . $value->id) }}">View</a>

            <!-- edit this job (uses the edit method found at GET /jobs/{id}/edit -->
            @if(Auth::check() && Auth::user()->usertype == 'admin')
              <a class="btn btn-small btn-info" href="{{ URL::to('franchise/' . $value->id . '/edit') }}">Edit</a>
            @endif

          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
</div>
@stop