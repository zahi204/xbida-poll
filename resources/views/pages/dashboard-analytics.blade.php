




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




<div class="card">
          <div class="card-content  show" aria-expanded="true">
              <div class="card-body" style="padding:2rem">
              <h1 style="font-size:5rem; text-align: right;";><b>איך הגעת אלינו ؟؟</b></h1>

    <br> 
    <br> 


    <h2 style="font-size:4rem;text-align: right;";>תודה שקנית איצלנו , חושב לנו לדעת איפה ראית אותנו ؟؟</h2>
    
        </div>
          </div>
      </div>
   
    </center>



  <div class="row">
   

  
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
      <div class="card">
          <div class="card-content  show" aria-expanded="true">
              <div class="card-body" style="padding:0rem">
                <center>
              <button id="fbBtn" onClick="switchColor('fbBtn','fbBtn2')" style="height:100%;width:100%;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img class="round" src="{{asset('images/portrait/small/fb.png') }}" alt="avatar" height="150" width="150" /></span></span><br><br> Facebook</button>
              </center>
        </div>
          </div>
      </div>
</div>






<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
      <div class="card">
          <div class="card-content collapse show" aria-expanded="true">
              <div class="card-body" style="padding:0rem">
                <center>
              <button id="TikBtn" onClick="switchColor('TikBtn','TikBtn2')" style="height:100%;width:100%;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img class="round" src="{{asset('images/portrait/small/tik.png') }}" alt="avatar" height="150" width="150" /></span></span><br><br>TikTok</button>
              </center>
        </div>
          </div>
      </div>
</div>





<div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
      <div class="card">
          <div class="card-content collapse show" aria-expanded="true">
              <div class="card-body" style="padding:0rem">
                <center>
              <button  id="IgBtn" onClick="switchColor('IgBtn','IgBtn2')" style="height:100%;width:100%;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img class="round" src="{{asset('images/portrait/small/inst.png') }}" alt="avatar" height="150" width="150" /></span></span><br><br>Instagram</button>
              </center>
        </div>
          </div>
      </div>
</div>








  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 col-xl-3">
      <div class="card" style="";>
          <div class="card-content collapse show" aria-expanded="true">
              <div class="card-body" style="padding:0rem">
                <center>
              <button  id="OthBtn" onClick="switchColor('OthBtn','OthBtn2')" style="height:100%;width:100%;  background-color:white; font-size:2.5rem;font-family: 'Cairo', sans-serif; "; class="btn  btn-inline"><span><img class="round" src="{{asset('images/portrait/small/oth2.png') }}" alt="avatar" height="150" width="150" /></span></span><br><br><b>אחר</b></button>
              </center>
        </div>
          </div>
      </div>
</div>










  </div>


    


<form id='myForm' name="resultForm" action="{{ route('saveData') }}" method="post">

<input Hidden name="fb" type="text" class="form-control" id="fbBtn2"  value='0' placeholder=""  >
<input Hidden name="ig" type="text" class="form-control" id="IgBtn2"  value='0' placeholder="" >
<input Hidden name="tik" type="text" class="form-control" id="TikBtn2"  value='0' placeholder="" >
<input Hidden name="oth" type="text" class="form-control" id="OthBtn2"  value='0'placeholder="" >
<input Hidden name="company_id" type="text" class="form-control" id=""  value="<?php echo $company_id; ?>" placeholder="" >
<input Hidden name="branch_id" type="text" class="form-control" id=""  value='<?php echo $branch_id; ?>' placeholder="" >

<center>
<!-- Button trigger modal -->
<button onClick="submitForm()" type="button" class="btn btn-primary" style="margin:20px;height:75px; width:180px; font-size:30px; font-family: 'Cairo', sans-serif;" data-toggle="modal" data-target="#exampleModal">
שלח
</button>
</center>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-body">
      <center>
      <img class="round" src="{{asset('images/portrait/small/logo.png') }}" alt="avatar" height="200" width="300" />

<img class="round" src="{{asset('images/portrait/small/thks.png') }}" alt="avatar" height="300" width="550" />

    </center>      
  </div>
    
    </div>
  </div>
</div>

</form>


  @endsection

  <script>


function switchColor(btnColor,btnRes){
        
        var btnC = document.getElementById(btnColor);
        var btnR = document.getElementById(btnRes);
        var value=btnR.value;

      var btnFace = document.getElementById('fbBtn');
      var btnInsta = document.getElementById('IgBtn');
      var btnTik = document.getElementById('TikBtn');

      var btnFaceVal = document.getElementById('fbBtn2');
      var btnInstaVal = document.getElementById('IgBtn2');
      var btnTikVal = document.getElementById('TikBtn2');
      


        if(value==0){

        btnC.style.background = '#bcc9fe';
        btnR.value='1';

          if(btnColor=='OthBtn'){
            btnFace.style.background = 'white';
            btnFaceVal.value='0';

            btnInsta.style.background = 'white';
            btnInstaVal.value='0';

            btnTik.style.background = 'white';
            btnTikVal.value='0';

          }


        }else{
        btnC.style.background = 'white';
        btnR.value='0'; 
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
