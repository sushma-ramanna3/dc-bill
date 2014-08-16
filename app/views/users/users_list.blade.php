@extends('layouts.main')
@section('content')
  <h3>Dashboard</h3>

  <ul id="tabs" class="nav nav-tabs bold" data-tabs="tabs">
      <li class="active"><a href="#" data-toggle="tab">Users List</a></li>
      <li class="users"><a href="users">Back</a></li>
  </ul>
  
  <h4>Users Details</h4><hr>
  
  <?php 
        $page = Input::get('page', 1);
        $i = (10 * ($page -1))+1;
  ?> 
  {{ Form::open(array('url' => '/users-list', 'class' => 'filter')) }} 
    <div class="form-group col-md-12" style="padding: 0px;margin-bottom:10px;">
        <div class="pull-left">
         <!--  @if(Auth::user()->usertype == 'admin') 
           <div class="col-md-2 dp">
            </div>
          @endif  -->
          
          <div class="form-group col-md-3 dp">
            <label>From Date</label>
            <div class="input-append date pull-right" id="dp2" data-date="" data-date-format="dd-mm-yyyy">
              <input name="from_date" class="span2" size="16" type="text" value="<?php echo Input::get('from_date'); ?>" readonly />
              <label class="add-on"><i class="icon-calendar"></i></label>
            </div>
          </div>

          <div class="form-group col-md-3 dp">
            <label class=" pull-left">To Date</label>
            <div class="input-append date" id="dp1" data-date="" data-date-format="dd-mm-yyyy">
              <input name="to_date" class="span2" size="16" type="text" value="<?php echo Input::get('to_date'); ?>" readonly />
              <label class="add-on"><i class="icon-calendar"></i></label>
            </div>
          </div>

          <div class="col-md-2" style="width:347px;margin-bottom:10px;"><label class=" pull-left">Beneficiary Name</label>
            {{ Form::text('beneficiary_name', Input::get('beneficiary_name'), array('style' => 'width: 60%;margin-left:5px;')) }}
          </div>
          <div class="pull-right">
            <a class="btn btn-danger white" type="reset" href="/users-list">Reset</a>
            {{ Form::submit('Filter', array('class' => 'btn btn-primary')) }}
            <button class="btn btn-primary" name="submit" value="download">Download</button>
          </div> 
        </div>
    </div>
  {{ Form::close() }}

  {{$users['pagination']}}
  
  <div id="my-tab-content" class="tab-content col-md-12">
    <div id="hdfc" class="tab-pane active">   
      
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <td>Sl.No.</td>
            <td>Beneficiary Name</td>
            <td>Phone</td>
            <td>Category</td>
            <td>Product Name</td>
            <td>Amount Recieved</td>
            <td>Registered Date</td>
            <td>Photo Link</td>
            <td>Application</td>
           <!--  @if(Auth::user()->usertype == 'admin')
              <td>Registered By</td> 
            @endif-->
          </tr>
        </thead>
        
        <tbody>
          @foreach($users['users'] as $key => $user)
            <tr>
              <td><a href='{{ URL::to('users/' . $user->BeneID . '/edit') }}'>{{ $i++ }}</a></td>
              <td>{{ $user->txtbeneficiaryname }}</td>
              <td>{{ $user->txtbeneContactNo }}</td>
              <td>@if($user->intbeneCategory == 1) General
                @elseif($user->intbeneCategory == 2) SC
                @else ST
                @endif</td>
              <td>{{ $user->txtProdName }}</td>
              <td>{{ $user->intbeneAmtReceived }}</td>
              <td>{{ date('d-M-Y h.i.s', strtotime($user->created_at)) }}</td>
              <td>@if($user->txtDocPath)
                {{ "<a href='/photodownload/".$user->BeneID."'>Photo download</a>" }}
                @else
                NA
                @endif
              </td>
              <td>{{ "<a href=\"/beneficiary?id=". $user->BeneID ."\" target=\"_blank\"><span class=\"glyphicon glyphicon-print\"></span></a>" }}</td>
              <!-- @if(Auth::user()->usertype == 'admin')
                <td>{{ $user->usertype }}</td>
              @endif -->
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
 </div>

@stop