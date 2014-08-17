@extends('layouts.main')
@section('content')
<style>
  .navbar-fixed-top, footer, .hr{
    display: none;
  }
  .container_mid{
    margin-top: 8px;
  }
</style>
<div class="container" style="width:210mm;height:297mm;">
   <div class="col-md-3 pull-right">
      <a href="javascript:window.print()" class="btn btn-lg btn-warning print_but">Print</a>
    </div>
  <!-- <a href="{{ URL::to('users-list') }}">Back</a> -->
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          @foreach($user as $key => $value)
          <?php $cash_certificate = DB::table('trnbeneficiarydocuments')->where('intbeneID', $value->BeneID)
                            ->where('intDocType', 1)->pluck('txtDocPath'); 
            ?>
             <td colspan="3" id="tab-padding">
              <span class="pull-left table-title">ಕೃಷಿ ಇಲಾಖೆಯ ವಿವಿಧ ಯೋಜನೆಗಳಡಿ ಸಹಾಯ ಧನ ಪಡೆಯಲು ರೈತರು ಸಲ್ಲಿಸಬೇಕಾದ ಅರ್ಜಿ</span>
              {{ HTML::image($cash_certificate, 'a photo', array('class'=>'img-responsive pull-right', 'id'=>'tab_photo')) }}</td>
        </tr>
        <tr class="bold">
          <td width="5%" align="center" style="padding-left:0px;padding-right:0px;">ಕ್ರ. ಸಂ</td>
          <td width="40%" align="center">ಅಂಶ</td>
          <td width="45%" align="center">ವಿವರ</td>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td>1.</td>
            <td class="bold">ರೈತರ ಪೂರ್ಣ ಹೆಸರು ಮತ್ತು ವಿಳಾಸ</td>
            <td>{{$value->txtbeneficiaryname}}, {{$value->txtbeneAddress}} - {{$value->intbenePinCode}} </td>
          </tr>
          <tr>
            <td>2.</td>
            <td class="bold">ಗ್ರಾಮ / ಹೋಬಳಿ</td>
            <td>{{$value->txtVillageName}} / {{$value->txtHobliRSK}}</td>
          </tr>
          <tr>
            <td>3.</td>
            <td style="padding: 0px;">
              <table class="table table-bordered" style="margin-bottom: 0px;">
              <tbody>
                <tr>
                  <td class="bold">ಹಿಡುವಳಿ ವಿವರ</td><td class="bold">ಗ್ರಾಮ</td>
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
                  <td class="bold">ಸರ್ವೇ ನಂ</td><td class="bold">ಕ್ಷೇತ್ರ ಎ - ಗುಂ</td>
                </tr>
                <tr>
                  <td>{{$value->survey_no}}</td><td></td>
                </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td>4.</td>
            <td class="bold">ಹಿಡುವಳಿ ಕುರಿತು ಕಂದಾಯ ಇಲಾಖೆಯ ಪತ್ರ</td>
            <td>ಲಗತಿಸಿದೆ/ ಇಲ್ಲ</td>
          </tr>
          <tr>
            <td>5.</td><td class="bold">ಜಾತಿ ಪ್ರಮಾಣ ಪತ್ರ</td>
            <?php $cash_certificate = DB::table('trnbeneficiarydocuments')->where('intbeneID', $value->BeneID)
                            ->where('intDocType', 4)->pluck('txtDocPath'); 
            ?>
            <td>@if($cash_certificate) ಲಗತಿಸಿದೆ
              @else ಇಲ್ಲ / ಅನ್ವಯವಾಗುವುದಿಲ್ಲ
              @endif</td>
          </tr>
          <tr>
            <td>6.</td>
            <td class="bold">ಇಲಾಖಾ ವಿವಿಧ ಯೋಜನೆಗಳಡಿ ಈಗಾಗಲೇ ಪಡೆದ ವಿವಿಧ ಸೌಲತ್ತುಗಳ ವಿವರ</td><td></td>
          </tr>
          <tr>
            <td>7.</td>
            <td class="bold">ಯಂತ್ರೋಪಕರಣ / ಕೃಷಿ ಉಪಕರಣಗಳನ್ನು ಹೊಂದಿರುವ ವಿವರಗಳು</td><td></td>
          </tr>
          <tr>
            <td>i.</td><td class="bold">ಎತ್ತುಗಳು</td><td></td>
          </tr>
          <tr>
            <td>ii.</td><td class="bold">ಎತ್ತಿನ ಗಾಡಿ</td><td></td>
          </tr>
          <tr>
            <td>iii.</td><td class="bold">ಟ್ರ್ಯಾಕ್ಟರ್</td><td></td>
          </tr>
          <tr>
            <td>vi.</td><td class="bold">ಪವರ್ ಟಿಲ್ಲರ್</td><td></td>
          </tr>
          <tr>
            <td>v.</td><td class="bold">ಹೈಟೆಕ್ ಕೃಷಿ ಯಂತ್ರೋಪಕರಣ</td><td></td>
          </tr>
          <tr>
            <td>vi.</td><td class="bold">ಡೀಸೆಲ್ ಪಂಪ್ ಸೆಟ್ಟುಗಳು</td><td></td>
          </tr>
          <tr>
            <td>vii.</td><td class="bold">ಸಸ್ಯ ಸಂರಕ್ಷಣ ಉಪಕರಣಗಳು</td><td></td>
          </tr>
          <tr>
            <td>viii.</td><td class="bold">ನೀರಾವರಿ ಘಟಕಗಳು</td><td></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div>ಈ ಮೇಲೆ ಒದಗಿಸಿದ ವಿವರಗಳು ಸಂಪೂರ್ಣ ನನಗೆ ತಿಳಿದಿದ್ದು ಸರಿ ಇರುತ್ತದೆ ಎಂದು ಡ್ರುಧೀಕರಿಸುತ್ತೆನೆ ಮತ್ತು ..scheme name....................................... ಯೋಜನೆಯಡಿ................sub scheme name............................... ಗಾಗಿ ಸಹಾಯ ಧನ ಒದಗಿಸಲು ಕೊರುತ್ತೆನೆ. ನಾನು ಕೊಟ್ಟಿರುವ ಮಾಹಿತಿಯು ತಪ್ಪು ಎಂದು ಕಂಡು ಬಂದಲ್ಲಿ ನನಗೆ ನೀಡಿರುವ ರಿಯಾಯಿತಿ ಸೌಲಭ್ಯವನ್ನು ಹಿಂಪಡೆದು ಮತ್ತು ನೀಡಿದ ನಂತರ ಮಾರ್ಗಸೂಚಿ ಉಲ್ಲಂಘಿಸಿದಲ್ಲಿ ಅಗತ್ಯ ಕಾನೂನು ಕ್ರಮಕ್ಕೆ ಒಳಗಾಗಲು ಬದ್ಧನಿರುವೇನು ಎಂದು ಧ್ರುದಪದಿಸುತ್ತೇನೆ</div>
</div>
@stop