@extends('layouts.main')

@section('content')
<div class="col-md-12 blue bold"><a href="/users" class="pull-right">Back</a></div><br>
<div class="panel panel-default order_info">
  
  <div class="panel-heading cust_padding">
    <div class="col-md-7" style="padding-top:5px;">
      @foreach($user as $key => $usr)
      <span class="blue bold">Order Details</span> - This order has been generated by <b>{{$usr->vm_hearaboutus}}</b>
    </div>
    <div class="col-md-3 pull-right">
      <a href="javascript:window.print()" class="btn btn-lg btn-warning print_but">Print</a>
    </div>
  </div>
  <div class="col-md-12" style="margin: 7px;">
    <div class="pull-left">FLIP <br>
      #597, First Floor, 4th Main, <br>
      11th Cross, Gokulam 3rd Stage, <br>
      Mysore, 570002 <br>
      Service Tax Regn. No: AABCF3241JSD001 <br>
    </div>
    <img src="/assets/images/fliplogo.png" class="pull-right">
  </div>
  <hr>
  <table style="margin: 13px;width: 100%;">
      <tbody>
        <tr><td colspan="2"><hr></td></tr>
      <tr class="bold">
        <td>Order Number</td>
        <td>{{$order_id}}</td>
      </tr>
    
        <tr class="bold">
          <td>Order Status</td>
          <td>@if($usr->order_status == 'C')
                  {{ 'Confirmed' }}
              @elseif($usr->order_status == 'P')
                    {{ 'Pending' }}
                  @else
                    {{ '' }}
              @endif
          </td>
        </tr>
        
       <!--  <tr class="bold">
         <td>IP Address</td>
         <td></td>
       </tr> -->

        <tr class="bold">
          <td>Order Date</td>
          <td>{{date('d-M-Y h.i.s', $usr->cdate)}}</td>
        </tr>
          <tr class="bold">
          <td>FLIP Discount</td>
          <td>{{$usr->coupon_discount}}</td>
        </tr>
          <tr class="bold">
          <td>Franchise Discount</td>
          <td>{{$usr->franchise_coupon_discount}}</td>
        </tr>
         <tr><td colspan="2"><hr></td></tr>
         <tr>
          <td class="blue bold">User Information</td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>
      	<tr>
        	<td class="bold">First Name</td>
        	<td>{{$usr->first_name}}</td>
      	</tr>
      	<tr>
      		<td class="bold">Last Name</td>
      		<td>{{$usr->last_name}}</td>
      	</tr>
      	<tr>
	        <td class="bold">Email ID</td>
	        <td>{{$usr->user_email}}</td>
      	</tr>
      	<tr>
	        <td class="bold">Phone Number</td>
	        <td>{{$usr->phone_2}}</td>
      	</tr> 
      	<!-- <tr>
                  <td>Educational Institution</td>
                  <td></td>
        </tr>
        <tr>
                  <td>Highest Qualification</td>
                  <td></td>
        </tr>
        <tr>
                  <td>Work Experience</td>
                  <td></td>
        </tr>
        <tr> -->
	        <td class="bold">Address</td>
	        <td>{{$usr->address_1}}, {{$usr->city}}, {{$usr->state}} - {{$usr->zip}}</td>
      	</tr>
      	<!-- <tr>
          <td>City</td>
                 <td></td>
        </tr>
                <tr>
           <td>Zip/Postal Code:</td>
                   <td></td>
                </tr>
                <tr>
                  <td>State</td>
                  <td></td>
        </tr> -->
     	<!--   <tr>
                <td>SMS Alerts / Phone Calls:</td>
                <td></td>
              </tr> -->
       @endforeach
    </tbody>
  </table>
<hr>
  <table style="margin: 13px;width: 90%;">
    <thead>
      <tr>
        <th class="blue">Order Information</th>
      </tr>
       <tr><th colspan="5"><hr></th></tr>
    </thead>
    <tbody>
     	<tr>
	        <td class="bold">Product Name</td>
	       
	      	<td class="bold">Order Status</td>
			
	      	<td class="bold">Product Price (Net)</td>
			
	      <!--   <td class="bold">Product Price (Gross)</td> -->
			
	      	<td class="bold">Total</td>
      	</tr>
        <tr><td colspan="5"><hr></td></tr>
		  @foreach($order_item as $key => $order)
		 	  <tr>
		        <td>@if($order->class_room == 'YES') {{$order->order_item_name}} with Classroom
                @else {{$order->order_item_name}}
                @endif
            </td>
		       
		      	<td>@if($order->order_status == 'C')
	             		{{ 'Confirmed' }}
          			@elseif($order->order_status == 'P')
	              		{{ 'Pending' }}
              		@else
	              		{{ '' }}
              		@endif
          	</td>
				
		      	<td>{{number_format($order->product_item_price)}}.00</td>
				
		      <!--   <td>{{$order->product_final_price}}</td> -->
				
		      	<td>INR {{number_format($order->product_final_price)}}.00</td>
	      	</tr>
		  @endforeach
      
      @foreach($user as $key => $usr)
        <tr><td colspan="4"><hr></td></tr>
      	<tr>
      	 	<td colspan="2"></td>
	        <td class="bold">SubTotal:</td>
	        <td>INR {{number_format($usr->order_subtotal)}}.00</td>
      	</tr>
      	<tr>
			    <td colspan="2"></td>
	      	<td class="bold">Total:</td>
			    <td>INR {{number_format($usr->order_total)}}.00</td>
      	</tr>
      @endforeach
    </tbody>
  </table>
  <div class="col-md-12 text-center">
      <a href="javascript:window.print()" class="btn btn-lg btn-warning">Print</a>
  </div>
</div>

@stop