
@extends('layouts/contentLayoutMaster')



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

        <link href="jquery.datetimepicker.full.min.css" rel='stylesheet'></link>

  @endsection




  @section('content')
    {{-- Dashboard Analytics Start --}}
    
    <br><br><br>
<center>





<div class="container align-items-center ">
<div class="row" style="height:auto; width:900px;margin-left:-110px;margin-top:-50px;";>
<div class="col-xs-8 col-sm-8 col-8">


<div id="text1">
        <div class="card">
              <div class="card-header d-flex justify-content-between align-items-end ">
                  <h4 class="card-title ">כמות האנשים ערוץ ברמה יומית לתקופה שנבחרה</h4>
              </div>
              <div class="card-content">

                  <div class="card-body pb-0">

                      <div class="d-flex justify-content-start"></div>

                      <div id="revenue-chart"></div>
                  </div>
              </div>
         </div>
</div>

<div>
        <div class="card">
              <div class="card-header d-flex justify-content-between align-items-end ">
                  <h4 class="card-title ">כמות האנשים ערוץ ברמה יומית לתקופה שנבחרה</h4>
              </div>
              <div class="card-content">

                  <div class="card-body pb-0">

                  <a href="#" class="btn btn-primary">Export as CSV</a>
                  </div>
              </div>
         </div>
</div>



        <div id="text2">
        <div class="card">
              <div class="card-header d-flex justify-content-between align-items-end ">
                  <h4 class="card-title ">כמות האנשים ערוץ ברמה יומית לתקופה שנבחרה</h4>
              </div>
              <div class="card-content">

                  <div class="card-body pb-0">

                      <div class="d-flex justify-content-start"></div>

                      <div id="sales-line-chart"></div>
                  </div>
              </div>
          </div>


    </div>









    </div>



<div class="col-4">
        <div id="navigation">


        
      <div class="col-12">
            <div class="card" style="">
                <div class="card-content collapse show" aria-expanded="true">
                    <div class="card-body" >
                            <form action="" method="post">
                                <span>בחר תאיך התחלה וסיום</span>
                                <br>
                                <br>
                              

                                <div class="form-label-group">
                                <label for="inputName">מיום</label>מיום:
                                    <input type='date'  value="2020-08-22" class='form-control'>
                                </div>
                                <div class="form-label-group">
                                <label for="inputBranch">עד יום</label>עד יום:
                                    <input type='date'  class='form-control'>
                                </div>
                                <button type="submit" class="btn btn-primary float-center btn-inline mb-50">Refresh</a>
                            </form>
                           
                    </div>
                </div>
            </div>
        </div>
















        <div class="col-12">
       

        <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">מספר משיבים</h4>
                </div>
                <div class="card-content">

                <br>

                    <div class="card-body pt-50">

                        <div id="product-order-chart" class="mb-1"></div>
                        <div class="chart-info d-flex justify-content-between mb-1">
                        </div>



                        <div class='row' style='margin-top:-50px; margin-bottom:10px;';>


                        <div class='col-3'>
                        <img class="" src="{{asset('images/portrait/small/fb.png') }}" alt="avatar" height="30" width="30" /><br>

                        <span>{{$FbTotal}}</span>

                        </div>
                        

                        <div class='col-3'>
                        <img class="" src="{{asset('images/portrait/small/tik.png') }}" alt="avatar" height="30" width="30" /><br>
                        <span>{{$TikTotal}}</span>

                        </div>

                        <div class='col-3'>
                        
                        <img class="" src="{{asset('images/portrait/small/inst.png') }}" alt="avatar" height="30" width="30" /><br>
                        <span>{{$InstTotal}}</span>

                        </div>

                        <div class='col-3'>
                        <img class="" src="{{asset('images/portrait/small/oth2.png') }}" alt="avatar" height="30" width="30" /> <br>
                        <span>{{$OthTotal}}</span>

                        </div>


                        </div>


                    </div>
                   
                </div>
            </div>




      </div>













    </div>           
    </div>
         
</div>
</div>





<form id='myForm' name="resultForm" action="{{ route('saveData') }}" method="post">

<input Hidden name="fb" type="text" class="form-control" id="fbBtn2"  value='<?php echo $FbTotal; ?>' placeholder=""  >
<input Hidden name="ig" type="text" class="form-control" id="IgBtn2"  value='<?php echo $TikTotal; ?>' placeholder="" >
<input Hidden name="tik" type="text" class="form-control" id="TikBtn2"  value='<?php echo $InstTotal; ?>' placeholder="" >
<input Hidden name="oth" type="text" class="form-control" id="OthBtn2"  value='<?php echo $OthTotal; ?>'placeholder="" >



</form>
  @endsection




@section('vendor-script')
        <!-- vendor files -->

        <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/tether.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/shepherd.min.js')) }}"></script>
        <script src="jquery.datetimepicker.full.min.js"></script>

@endsection
@section('page-script')
        <!-- Page js files -->
        <script src="{{ asset(mix('js/scripts/cards/card-analytics.js')) }}"></script>


        <script>




var btnFaceVal = parseInt(document.getElementById('fbBtn2').value);
var btnInstaVal = parseInt(document.getElementById('IgBtn2').value);
var btnTikVal = parseInt(document.getElementById('TikBtn2').value);
var btnOthVal = parseInt(document.getElementById('OthBtn2').value);


var total =btnFaceVal+btnInstaVal+btnTikVal+btnOthVal;

var fbperc=(btnFaceVal/total)*100;
var tikperc=(btnInstaVal/total)*100;
var instperc=(btnTikVal/total)*100;
var othperc=(btnOthVal/total)*100;



var $primary = '#7367F0';
var $danger = '#EA5455';
var $warning = '#FF9F43';
var $info = '#00cfe8';
var $success = '#00db89';
var $primary_light = '#9c8cfc';
var $warning_light = '#FFC085';
var $danger_light = '#f29292';
var $info_light = '#1edec5';
var $strok_color = '#b9c3cd';
var $label_color = '#e7eef7';
var $purple = '#df87f2';
var $white = '#fff';
var $yel = '#FFFF00';




    // Product Order Chart
    // -----------------------------

    var orderChartoptions = {
        chart: {
            height: 325,
            type: 'radialBar',
        },
        colors: [$primary, $warning, $danger,$yel],
        fill: {
            type: 'gradient',
            gradient: {
                // enabled: true,
                shade: 'dark',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: [$primary_light, $warning_light, $danger_light, $yel],
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            },
        },
        stroke: {
            lineCap: 'round'
        },
        plotOptions: {
            radialBar: {
              size: 150,
                hollow: {
                    size: '20%'
                },
                track: {
                    strokeWidth: '100%',
                    margin: 15,
                },
                dataLabels: {
                    name: {
                        fontSize: '18px',
                    },
                    value: {
                        
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',

                        formatter: function (w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return total
                        }
                    }
                }
            }
        },
        series: [~~fbperc,~~tikperc,~~instperc,~~othperc],
        labels: ['Facebook' , 'Tiktok', 'Instagram','Other'],

    }

   var orderChart = new ApexCharts(
        document.querySelector("#product-order-chart"),
        orderChartoptions
    );

    orderChart.render();






    // Revenue  Chart
    // -----------------------------

    var revenueChartoptions = {
      chart: {
        height: 260,
        toolbar: { show: false },
        type: 'line',
      },
      stroke: {
          curve: 'smooth',
          dashArray: [0, 0,0,0],
          width: [4, 4,4,4],
      },
      grid: {
          borderColor: $label_color,
      },
      legend: {
          show: false,
      },
      colors: [$danger_light, $strok_color],

      fill: {
          type: 'gradient',
          gradient: {
              shade: 'dark',
              inverseColors: false,
              gradientToColors: [$primary_light, $warning_light, $danger_light, $yel],
              shadeIntensity: 1,
              type: 'horizontal',
              opacityFrom: 1,
              opacityTo: 1,
              stops: [0, 100, 100, 100]
          },
      },
      markers: {
          size: 0,
          hover: {
              size: 5
          }
      },
      xaxis: {
          labels: {
              style: {
                  colors: $strok_color,
              }
          },
          axisTicks: {
              show: false,
          },
          categories: ['01', '05', '09', '13', '17', '21', '26', '31'],
          axisBorder: {
              show: false,
          },
          tickPlacement: 'on',
      },
      yaxis: {
          tickAmount: 10,
          labels: {
              style: {
                  color: [$primary_light, $warning_light, $danger_light, $yel],
              },
              formatter: function(val) {
                  return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
              }
          }
      },
      tooltip: {
          x: { show: true }
      },
      series: [{
              name: "Facebook",
              data: [14, 53, 78, 45, 24, 35, 24, 25]
          },
          {
              name: "TikTok",
              data: [90, 47, 74, 11, 13, 10, 50, 48]
          },
          {
            name: "Instagram",
            data: [87, 88, 55, 4, 11, 55, 50, 78]
        },

        {
              name: "Other",
              data: [66, 41, 78, 67, 70, 40, 25, 34]
          }
      ],

    }

   var revenueChart = new ApexCharts(
        document.querySelector("#revenue-chart"),
        revenueChartoptions
    );

    revenueChart.render();



        // Customer Chart
    // -----------------------------

    var customerChartoptions = {
        chart: {
            type: 'pie',
            height: 325,
            dropShadow: {
                enabled: false,
                blur: 1,
                left: 1,
                top: 1,
                opacity: 0.2
            },
            toolbar: {
                show: false
            }
        },
        labels: ['Facebook', 'Tiktok', 'Instagram','Other'],
        series: [~~fbperc, ~~tikperc, ~~instperc,~~othperc],
        dataLabels: {
            enabled: true
        },
        value: {
               fontSize: '16px',
                    },

        legend: { show: false },
        stroke: {
            width: 4
        },
        colors: [$primary, $warning, $danger,$info],
        fill: {
            type: 'gradient',
            gradient: {
                gradientToColors: [$primary_light, $warning_light, $danger_light,$yel]
            }
        }
    }

    var customerChart = new ApexCharts(
        document.querySelector("#customer-chart"),
        customerChartoptions
    );

    customerChart.render();




  </script>


@endsection
