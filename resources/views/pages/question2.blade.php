




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


<img class="round" src="{{asset('images/portrait/small/logomet2.PNG') }}" alt="avatar" height="80"  />
<h2 style="font-size:3rem;text-align: center;";>אנא סמן את הבחירה הנכונה</h2>


   
    </center>

<br>
<!-- <img class="" src="{{asset('images/portrait/small/arabicheader.PNG') }}" height="220" width="" /> -->
<br>
<br>



<div class="container " style="width:900px; vertical-align: middle" >  






<div class="row" style="padding: 0;margin: 0;";>
  
  
  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-4 col-xl-4">
        <div class="card" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;";>
            <div class="card-content  show" aria-expanded="true">
                <div class="card-body" style="padding:0rem">
                  <center>
                <button id="yesBtn" onClick="switchColor('yesBtn','yesBtn2')" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline">
                <span><img style="margin-top:30px;"; class="round" src="{{asset('images/portrait/small/yes.png') }}" alt="avatar" height="65" width="65" /></span>
                <span>לקוח חדש</span></button>
                </center>
          </div>
            </div>
        </div>
  </div>
  
  
  
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" >
  <img style="margin-top:-30px;"; class="" src="{{asset('images/portrait/small/askman.png') }}" alt="avatar" height="250" />
  </div>
  
  
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" >
        <div class="card" style="border-width: 0px;border-color: #706f6f;border-style: solid;  border-radius: 10%; height:216px; width:130px;";>
            <div class="card-content collapse show" aria-expanded="true">
                <div class="card-body" style="padding:0rem">
                  <center>
                <button id="noBtn" onClick="switchColor('noBtn','noBtn2')" style="border-width: 0px; border-color: #706f6f; border-style: solid;  border-radius: 10%; height:216px; width:130px;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline">
                <span><img style="margin-top:30px;"; class="round" src="{{asset('images/portrait/small/no.png') }}" alt="avatar" height="65" width="65" /></span>
                <span>לקוח ותיק</span>
                </button>
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
<img class="" src="{{asset('images/portrait/small/send.PNG') }}" alt="avatar" height="60" width="123" />
</button>
</center>

<center>

<form id='myForm' name="resultForm" action="{{ route('saveData2') }}" method="post">

<input Hidden name="yes" type="text" class="form-control" id="yesBtn2"  value='0' placeholder=""  >
<input Hidden name="no" type="text" class="form-control" id="noBtn2"  value='0' placeholder="" >

<input Hidden name="company_id" type="text" class="form-control" id=""  value="<?php echo $company_id; ?>" placeholder="" >
<input Hidden name="branch_id" type="text" class="form-control" id=""  value='<?php echo $branch_id; ?>' placeholder="" >






<!-- Modal -->
<div style=" margin-top:150px; "; class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <img class="round" src="{{asset('images/portrait/small/arabicthanks.PNG') }}" alt="avatar" height="250" width="550" />
    
  </div>
</div>

</form>

</center>
  @endsection

  <script>

(function () {
 


 


}());







function switchColor(btnColor,btnRes){
        
      var btnC = document.getElementById(btnColor);
      var btnR = document.getElementById(btnRes);
      var value=btnR.value;

      var btnYes = document.getElementById('yesBtn');
      var btnNo = document.getElementById('noBtn');


      
        if(value==0){
        btnC.style.background = '#f3df81';
        btnR.value='1';
        document.getElementById('subbtn').style.visibility = "visible";


        }else{
        btnC.style.background = 'white';
        btnR.value='0'; 

      var btnYesVal = parseInt(document.getElementById('yesBtn2').value);
      var btnNoVal = parseInt(document.getElementById('noBtn2').value);



      if(btnYesVal==1 || btnNoVal==1 ){
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
