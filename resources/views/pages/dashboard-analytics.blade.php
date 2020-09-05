




@extends('layouts/contentLayoutMaster')


@section('vendor-style')
        <!-- vendor css files -->

<style>




</style>


        <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/tether-theme-arrows.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/tether.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/shepherd-theme-default.css')) }}">






        </style>
@endsection
@section('page-style')
        <!-- Page css files -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/dashboard-analytics.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/pages/card-analytics.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/plugins/tour/tour.css')) }}">
  @endsection

  @section('content')
    {{-- Dashboard Analytics Start --}}

<center>


<img class="round" src="{{asset('images/portrait/small/logomet.PNG') }}" alt="avatar" height="70" width="180" />


<!--*
<div class="card" style="height:200px; width:800px; border-width: 5px; border-color: #706f6f; border-style: solid; border-radius: 5%;">
          <div class="card-content  show" aria-expanded="true">
              <div class="card-body" style="padding:1rem">
              <h1 style="font-size:4rem; text-align: right;";><u>עזור לנו להתמקד </u></h1>




    <h2 style="font-size:3rem;text-align: center;";>תודה שקנית אצלנו <br> חשוב לנו לדעת איפה ראית אותנו ؟؟</h2>

        </div>
          </div>
      </div>

    </center>
-->
<br>
<div style="margin-top: 2px;">
 <img class="" src="{{asset('images/portrait/small/titleblack.PNG') }}" height="170" width="" />
</div>

<br>
<br>



<div class="container" style="width:700px;"; >






<div class="row" style="";>


  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3" style="margin-left:0px;";>
        <div class="card" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;";>
            <div class="card-content  show" aria-expanded="true">
                <div class="card-body" style="padding:0rem">
                  <center>
                <button id="fbBtn" onClick="switchColor('fbBtn','fbBtn2')" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img style="margin-top:30px;"; class="round" src="{{asset('images/portrait/small/fb.png') }}" alt="avatar" height="65" width="65" /><br><br><img style="margin-left:-10px;"; class="round" src="{{asset('images/portrait/small/fbtext2.png') }}" alt="avatar" height="40" width="100" /></span></span><br><br></button>
                </center>
          </div>
            </div>
        </div>
  </div>






  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3" style="margin-left:0px;";>
        <div class="card" style="border-width: 0px;border-color: #706f6f;border-style: solid;  border-radius: 10%; height:216px; width:130px;";>
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body" style="padding:0rem">
                  <center>
                <button id="TikBtn" onClick="switchColor('TikBtn','TikBtn2')" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img style="margin-top:30px;"; class="round" src="{{asset('images/portrait/small/tik.png') }}" alt="avatar" height="65" width="65" /><br><br><img style="margin-left:-15px;"; class="" src="{{asset('images/portrait/small/tiktext2.png') }}" alt="avatar" height="40" width="100" /></span></span><br><br></button>
                </center>
          </div>
            </div>
        </div>
  </div>



  <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3" style="margin-left:0px;";>
        <div class="card" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;";>
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body" style="padding:0rem">
                  <center>
                <button  id="IgBtn" onClick="switchColor('IgBtn','IgBtn2')" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img style="margin-top:15px;";class="round" src="{{asset('images/portrait/small/inst.png') }}" alt="avatar" height="65" width="65" /><br><br><img style="margin-left:-10px;"; class="round" src="{{asset('images/portrait/small/insttext.png') }}" alt="avatar" height="40" width="100" /></span></span></button>
                </center>
          </div>
            </div>
        </div>
  </div>




    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3" style="margin-left:0px;";>
        <div class="card" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;";>
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body" style="padding:0rem">
                  <center>
                <button  id="OthBtn" onClick="switchColor('OthBtn','OthBtn2')" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img style="margin-left:-15px;margin-top:25px;"; class="" src="{{asset('images/portrait/small/oth.png') }}" alt="avatar" height="100" width="100" /></span></span><br><br><b></b></button>
                </center>
          </div>
            </div>
        </div>
  </div>











    </div>










</div>





  <center>
<!-- Button trigger modal -->
<button  style="visibility: hidden; margin-top:-25px;"; id="subbtn" onClick="submitForm()" type="button" class="   btn "  data-toggle="modal" data-target="#exampleModal" >
<img class="" src="{{asset('images/portrait/small/sendbtn.png') }}" alt="avatar" height="60" width="123" />
</button>
</center>


<form id='myForm' name="resultForm" action="{{ route('saveData') }}" method="post">

<input Hidden name="fb" type="text" class="form-control" id="fbBtn2"  value='0' placeholder=""  >
<input Hidden name="ig" type="text" class="form-control" id="IgBtn2"  value='0' placeholder="" >
<input Hidden name="tik" type="text" class="form-control" id="TikBtn2"  value='0' placeholder="" >
<input Hidden name="oth" type="text" class="form-control" id="OthBtn2"  value='0'placeholder="" >
<input Hidden name="company_id" type="text" class="form-control" id=""  value="<?php echo $company_id; ?>" placeholder="" >
<input Hidden name="branch_id" type="text" class="form-control" id=""  value='<?php echo $branch_id; ?>' placeholder="" >






<!-- Modal -->
<div style=" margin-top:150px;"; class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <img class="round" src="{{asset('images/portrait/small/thanksblack.png') }}" alt="avatar" height="300" width="800" />

  </div>
</div>

</form>


  @endsection

  <script>

(function () {






}());







function switchColor(btnColor,btnRes){

      var btnC = document.getElementById(btnColor);
      var btnR = document.getElementById(btnRes);
      var value=btnR.value;

      var btnFace = document.getElementById('fbBtn');
      var btnInsta = document.getElementById('IgBtn');
      var btnTik = document.getElementById('TikBtn');



        if(value==0){
        btnC.style.background = '#ffd966';
        btnR.value='1';
        document.getElementById('subbtn').style.visibility = "visible";


        }else{
        btnC.style.background = 'white';
        btnR.value='0';

        var btnFaceVal = parseInt(document.getElementById('fbBtn2').value);
      var btnInstaVal = parseInt(document.getElementById('IgBtn2').value);
      var btnTikVal = parseInt(document.getElementById('TikBtn2').value);
      var btnOthVal = parseInt(document.getElementById('OthBtn2').value);



      if(btnFaceVal==1 || btnInstaVal==1 || btnTikVal==1 || btnOthVal==1){
        document.getElementById('subbtn').style.visibility = "visible";

          }else{
            document.getElementById('subbtn').style.visibility = "hidden";


          }




        }




}

function getResult(){
        console.log(btnColors);
}

function submitForm(){

  setTimeout(() => { document.getElementById("myForm").submit();
 }, 2000);


}



  </script>


@section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/tether.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/shepherd.min.js')) }}"></script>
@endsection
@section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
@endsection
