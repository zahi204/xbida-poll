
@extends('layouts/contentLayoutMaster')


@section('title', 'Main Page')

<meta http-equiv="refresh" content="3;url=http://exbidia.net/dashboard-analytics" />

@section('vendor-style')
        <!-- vendor css files -->

<style>


.control-me::after {
    content: "XXX";
    font-size: 100px;
}

#toggle:checked~.control-me::after {
    content: "FFF";
    color: red;
}

label {
    background: #A5D6A7;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
}

.visually-hidden {
    position: absolute;
    left: -100vw;
    /* Note, you may want to position the checkbox over top the label and set the opacity to zero instead. It can be better for accessibilty on some touch devices for discoverability. */
}


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

<img class="round" src="{{asset('images/portrait/small/th.jpg') }}" alt="avatar" height="500" width="800" />

   
    </center>



  @endsection

  <script>


function switchColor(btnColor,btnRes){
        
        var btnC = document.getElementById(btnColor);
        var btnR = document.getElementById(btnRes);
        var value=btnR.value;

        if(value==0){
        btnC.style.background = '#bcc9fe';
        btnR.value='1';
        }else{
        btnC.style.background = 'white';
        btnR.value='0'; 
        }

}

function getResult(){
        console.log(btnColors);
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
