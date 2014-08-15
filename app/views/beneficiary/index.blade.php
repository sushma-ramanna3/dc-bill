@extends('layouts.main')
@section('content')
<style>
  .navbar-fixed-top{
    display: none;
  }
  .container_mid{
    margin-top: 8px;
  }
</style>
<div class="container">
  <!-- <a href="{{ URL::to('users-list') }}">Back</a> -->
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <td colspan="3">11111</td>
        </tr>
        <tr>
          <td width="5%" align="center">SL No</td>
          <td width="40%" align="center">Amsha</td>
          <td width="45%" align="center">Details</td>
        </tr>
      </thead>
      <tbody>
        @foreach($user as $key => $value)
          <tr>
            <td>1.</td>
            <td>Name</td>
            <td>{{$value->txtbeneficiaryname}}</td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Village/Hobli</td>
            <td></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>
              <table class="table table-striped table-bordered"><tbody>
                <tr>
                  <td>Category</td><td>Village</td>
                </tr>
                <tr>
                  <td></td><td></td>
                </tr>
              </tbody></table>
            </td>
            <td>
               <table class="table table-striped table-bordered"><tbody>
                <tr>
                  <td>Survey No</td><td>A</td>
                </tr>
                <tr>
                  <td></td><td></td>
                </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Tax certificate</td>
            <td></td>
          </tr>
          <tr>
            <td>5.</td><td>Cash certificate</td><td></td>
          </tr>
          <tr>
            <td>6.</td>
            <td>Ilage</td><td></td>
          </tr>
          <tr>
            <td>7.</td>
            <td>Crops equipments</td><td></td>
          </tr>
          <tr>
            <td>8.</td><td>Bafullo</td><td></td>
          </tr>
          <tr>
            <td>9.</td><td>Gaddi</td><td></td>
          </tr>
          <tr>
            <td>10.</td><td>Tractor</td><td></td>
          </tr>
          <tr>
            <td>11.</td><td>Power tiller</td><td></td>
          </tr>
          <tr>
            <td>12.</td><td>Hitech</td><td></td>
          </tr>
          <tr>
            <td>13.</td><td>Diesel</td><td></td>
          </tr>
          <tr>
            <td>14.</td><td>Greens</td><td></td>
          </tr>
          <tr>
            <td>15.</td><td>Irrigation</td><td></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div>ppppppppppp</div>
</div>
@stop