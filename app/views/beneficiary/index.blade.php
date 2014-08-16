@extends('layouts.main')
@section('content')
<style>
  .navbar-fixed-top, footer{
    display: none;
  }
  .container_mid{
    margin-top: 8px;
  }
</style>
<div class="container" style="width:1100px;height:600px">
   <div class="col-md-3 pull-right">
      <a href="javascript:window.print()" class="btn btn-lg btn-warning print_but">Print</a>
    </div>
  <!-- <a href="{{ URL::to('users-list') }}">Back</a> -->
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <td colspan="3">11111</td>
        </tr>
        <tr class="bold">
          <td width="5%" align="center">SL No</td>
          <td width="40%" align="center">Amsha</td>
          <td width="45%" align="center">Details</td>
        </tr>
      </thead>
      <tbody>
        @foreach($user as $key => $value)
          <tr>
            <td>1.</td>
            <td class="bold">Name</td>
            <td>{{$value->txtbeneficiaryname}}</td>
          </tr>
          <tr>
            <td>2.</td>
            <td class="bold">Village / Hobli</td>
            <td>{{$value->txtVillageName}} {{$value->txtHobliRSK}}</td>
          </tr>
          <tr>
            <td>3.</td>
            <td style="padding: 0px;">
              <table class="table table-bordered" style="margin-bottom: 0px;">
              <tbody>
                <tr>
                  <td class="bold">Category</td><td class="bold">Village</td>
                </tr>
                <tr>
                  <td>
                    @if($value->intbeneCategory == 1) General
                    @elseif($value->intbeneCategory == 2) SC
                    @elseif($value->intbeneCategory == 3) ST
                    @endif
                  </td>
                  <td>{{$value->txtVillageName}}</td>
                </tr>
              </tbody></table>
            </td>
            <td  style="padding: 0px;">
               <table class="table table-bordered" style="margin-bottom: 0px;">
                <tbody>
                <tr>
                  <td class="bold">Survey No</td><td class="bold">A</td>
                </tr>
                <tr>
                  <td>{{$value->survey_no}}</td><td></td>
                </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td>4.</td>
            <td class="bold">Tax certificate</td>
            <td></td>
          </tr>
          <tr>
            <td>5.</td><td class="bold">Cash certificate</td><td></td>
          </tr>
          <tr>
            <td>6.</td>
            <td class="bold">Ilage</td><td></td>
          </tr>
          <tr>
            <td>7.</td>
            <td class="bold">Crops equipments</td><td></td>
          </tr>
          <tr>
            <td>8.</td><td class="bold">Bafullo</td><td></td>
          </tr>
          <tr>
            <td>9.</td><td class="bold">Gaddi</td><td></td>
          </tr>
          <tr>
            <td>10.</td><td class="bold">Tractor</td><td></td>
          </tr>
          <tr>
            <td>11.</td><td class="bold">Power tiller</td><td></td>
          </tr>
          <tr>
            <td>12.</td><td class="bold">Hitech</td><td></td>
          </tr>
          <tr>
            <td>13.</td><td class="bold">Diesel</td><td></td>
          </tr>
          <tr>
            <td>14.</td><td class="bold">Greens</td><td></td>
          </tr>
          <tr>
            <td>15.</td><td class="bold">Irrigation</td><td></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div>ppppppppppp ---------textttttttttttttttttttttttttttttttt</div>
</div>
@stop