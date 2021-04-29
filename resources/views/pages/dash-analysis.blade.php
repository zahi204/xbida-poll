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

<link href="jquery.datetimepicker.full.min.css" rel='stylesheet'>
</link>

@endsection




@section('content')
{{-- Dashboard Analytics Start --}}

<br><br><br>


<div class="container align-items-center ">
  <div class="row">
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-info p-50 m-0 mb-1">
              <div class="avatar-content">
                <img class="" src="{{asset('images/portrait/small/fb.png') }}" alt="avatar" height="30" width="30" />
              </div>
            </div>
            <h2 class="text-bold-700">{{$FbTotal}}</h2>
            <p class="mb-0 line-ellipsis">Facebook</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
              <div class="avatar-content">
                <img class="" src="{{asset('images/portrait/small/inst.png') }}" alt="avatar" height="30" width="30" />
              </div>
            </div>
            <h2 class="text-bold-700">{{$InstTotal}}</h2>
            <p class="mb-0 line-ellipsis">Instagram</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
              <div class="avatar-content">
                <img class="" src="{{asset('images/portrait/small/tik.png') }}" alt="avatar" height="30" width="30" />
              </div>
            </div>
            <h2 class="text-bold-700">{{$TikTotal}}</h2>
            <p class="mb-0 line-ellipsis">Tiktok</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-2 col-md-4 col-sm-6">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
              <div class="avatar-content">
                <img class="" src="{{asset('images/portrait/small/oth2.png') }}" alt="avatar" height="30" width="30" />
              </div>
            </div>
            <h2 class="text-bold-700">{{$OthTotal}}</h2>
            <p class="mb-0 line-ellipsis">Other</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-8 col-sm-12">
      <div class="card text-center">
        <div class="card-content">
          <div class="card-body">
            <div class="avatar bg-rgba-success p-50 m-0 mb-1">
              <div class="avatar-content">
                <i class="feather icon-LayersIcon text-success font-medium-5"></i>
              </div>
            </div>
            <h2 class="text-bold-700">{{$OthTotal + $InstTotal + $TikTotal + $FbTotal}}</h2>
            <p class="mb-0 line-ellipsis">Total</p>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="row" style="height:auto;">
    <div class="col-xs-12 col-sm-12 col-lg-4 col-12">

      <div class="card" style="">
        <div class="card-content collapse show" aria-expanded="true">
          <div class="card-body">
            <form action="{{route('analytics.by.range')}}" method="post">
              {{ csrf_field() }}
              <span>Choose date range</span>
              <br>
              <br>


              <div class="form-label-group">
                <label for="inputName">From</label>From
                <input type='date' name="from" class='form-control' value="{{$from}}">
              </div>
              <div class="form-label-group">
                <label for="inputBranch">To</label>To
                <input type='date' name="to" class='form-control' value="{{$to}}">
              </div>
              <button type="submit" class="btn btn-primary float-center btn-inline mb-50">Refresh</a>
            </form>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-end ">
          <h4 class="card-title ">Export DataBase</h4>
        </div>
        <div class="card-content">

          <div class="card-body pb-0 mb-1">

            <a href="{{ route('getCSV') }}" class="btn btn-primary">Export as CSV</a>
          </div>
        </div>
      </div>
    </div><!-- end of col 3 -->
    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-4 col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h4 class="card-title">Number of votes per choice</h4>
        </div>
        <div class="card-content">

          <br>

          <div class="card-body pt-50">

            <div id="product-order-chart" class="mb-1"></div>


          </div>

        </div>
      </div>
    </div> <!-- end of col 1 -->

    <div class="col-xs-12 col-sm-12 col-lg-4 col-12">
      <div class="card">
        <div class="card-header flex-column align-items-start">
          <h4 class="card-title mb-75">Percent of votes per choice</h4>
        </div>
        <div class="card-body">
          <div id="donut-chart"></div>
        </div>
      </div>
    </div><!-- end of col 2 -->





  </div> <!-- end of row 2 -->


  <div class="row">
    <div class="col-xs-12 col-sm-12 col-12">
      <div id="text1">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-end ">
            <h4 class="card-title ">Number of votes per day</h4>
          </div>
          <div class="card-content">

            <div class="card-body pb-0">

              <div class="d-flex justify-content-start"></div>

              <div id="revenue-chart" style="overflow: auto;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end of row 3 -->


</div>








<form id='myForm' name="resultForm" action="{{ route('saveData') }}" method="post">

  <input Hidden name="fb" type="text" class="form-control" id="fbBtn2" value='<?php echo $FbTotal; ?>' placeholder="">
  <input Hidden name="ig" type="text" class="form-control" id="IgBtn2" value='<?php echo $InstTotal; ?>' placeholder="">
  <input Hidden name="tik" type="text" class="form-control" id="TikBtn2" value='<?php echo $TikTotal; ?>' placeholder="">
  <input Hidden name="oth" type="text" class="form-control" id="OthBtn2" value='<?php echo $OthTotal; ?>' placeholder="">

  <!-- <input Hidden name="oth" type="text" class="form-control" id="OthBtn2"  value='<?php echo $OthTotal; ?>'placeholder="" >
<input Hidden name="oth" type="text" class="form-control" id="OthBtn2"  value='<?php echo $OthTotal; ?>'placeholder="" > -->



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


  var total = btnFaceVal + btnInstaVal + btnTikVal + btnOthVal;

  var fbperc = (btnFaceVal / total) * 100;
  var instperc = (btnInstaVal / total) * 100;
  var tikperc = (btnTikVal / total) * 100;
  var othperc = (btnOthVal / total) * 100;



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


  var chartColors = {
    donut: {
      fb: $primary, //'#ffe700', // facebook
      inst: $danger, //'#00d4bd', //tiktok
      tik: $warning, //'#826bf8', // instagram
      oth: $yel, //'#2b9bf4', // other
    },
  };

  // Product Order Chart
  // -----------------------------

  var orderChartoptions = {
    chart: {
      height: 350,
      type: 'radialBar',
    },
    legend: {
      show: true,
      position: 'bottom'
    },
    colors: [chartColors.donut.fb, chartColors.donut.inst,
      chartColors.donut.tik, chartColors.donut.oth
    ],
    fill: {
      type: 'gradient',
      gradient: {
        // enabled: true,
        shade: 'dark',
        type: 'vertical',
        shadeIntensity: 0.5,
        gradientToColors: [$primary_light, $danger_light, $warning_light, $yel],
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

            formatter: function(w) {
              // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
              return total
            }
          }
        }
      }
    },
    series: [~~fbperc, ~~instperc, ~~tikperc, ~~othperc],
    labels: ['Facebook', 'Instagram', 'Tiktok', 'Other'],

  }

  var orderChart = new ApexCharts(
    document.querySelector("#product-order-chart"),
    orderChartoptions
  );

  orderChart.render();




  var dates = <?php echo $dates; ?>;
  var facebookDayByDay = <?php echo $facebookDayByDay; ?>;
  var instagramDayByDay = <?php echo $instagramDayByDay; ?>;
  var tiktokDayByDay = <?php echo $tiktokDayByDay; ?>;
  var otherDayByDay = <?php echo $otherDayByDay; ?>;

  const dynamicWidth = dates.length * 50;
  const chartWidth = dynamicWidth < window.innerWidth ? '100%' : dynamicWidth;

  dates.reverse();
  facebookDayByDay.reverse();
  instagramDayByDay.reverse();
  tiktokDayByDay.reverse();
  otherDayByDay.reverse();
  // Revenue  Chart
  // -----------------------------

  var revenueChartoptions = {
    chart: {
      height: 260,
      width: chartWidth,
      toolbar: {
        show: false
      },

      type: 'line',
      animations: {
        enabled: true,
        easing: 'linear',
        dynamicAnimation: {
          speed: 1000
        }
      },
    },

    stroke: {
      curve: 'smooth',
      dashArray: [0, 0, 0, 0],
      width: [4, 4, 4, 4],
    },
    grid: {
      borderColor: $label_color,
    },
    legend: {
      show: false,
    },
    colors: [chartColors.donut.fb, chartColors.donut.inst,
      chartColors.donut.tik, chartColors.donut.oth
    ],

    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        inverseColors: false,
        gradientToColors: [$primary_light, $danger_light, $warning_light, $yel],
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
      tickAmount: 10,
      axisTicks: {
        show: false,
      },
      categories: dates,
      axisBorder: {
        show: false,
      },
      tickPlacement: 'on',
    },
    yaxis: {
      // tickAmount: 10,
      // labels: {
      //     style: {
      //         color: [$primary_light, $warning_light, $danger_light, $yel],
      //     },
      //     formatter: function(val) {
      //         return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
      //     }
      // }
      labels: {
        formatter: function(val) {
          return val.toFixed(0);
        }
      },
      forceNiceScale: true,
      decimalsInFloat: 0,

    },
    tooltip: {
      x: {
        show: true
      }
    },
    series: [{
        name: "Facebook",
        data: facebookDayByDay
      },
      {
        name: "Instagram",
        data: instagramDayByDay
      },
      {
        name: "TikTok",
        data: tiktokDayByDay
      },


      {
        name: "Other",
        data: otherDayByDay
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
      height: 350,
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
    labels: ['Facebook', 'Instagram', 'Tiktok', 'Other'],
    series: [~~fbperc, ~~instperc, ~~tikperc, ~~othperc],
    dataLabels: {
      enabled: true
    },
    value: {
      fontSize: '16px',
    },

    legend: {
      show: false
    },
    stroke: {
      width: 4
    },
    colors: [$primary, $warning, $danger, $info],
    fill: {
      type: 'gradient',
      gradient: {
        gradientToColors: [$primary_light, $warning_light, $danger_light, $yel]
      }
    }
  }

  var customerChart = new ApexCharts(
    document.querySelector("#customer-chart"),
    customerChartoptions
  );

  customerChart.render();








  var donutChartEl = document.querySelector('#donut-chart'),
    donutChartConfig = {
      chart: {
        height: 400,
        type: 'donut'
      },
      legend: {
        show: true,
        position: 'bottom'
      },
      labels: ['Facebook', 'Instagram', 'Tiktok', 'Other'],
      series: [btnFaceVal, btnInstaVal, btnTikVal, btnOthVal],
      colors: [
        chartColors.donut.fb,
        chartColors.donut.inst,
        chartColors.donut.tik,
        chartColors.donut.oth
      ],
      dataLabels: {
        enabled: true,
        formatter: function(val, opt) {
          return parseInt(val) + '%';
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Montserrat'
              },
              value: {
                fontSize: '1rem',
                fontFamily: 'Montserrat',
                formatter: function(val) {
                  return parseInt(val) + '%';
                }
              },
              total: {
                show: false,
                fontSize: '1.5rem',
                label: 'Operational',
                formatter: function(w) {
                  return '31%';
                }
              }
            }
          }
        }
      },
      responsive: [{
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: false,
                    name: {
                      fontSize: '0.1rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            }
          }
        }
      ]
    };
  if (typeof donutChartEl !== undefined && donutChartEl !== null) {
    var donutChart = new ApexCharts(donutChartEl, donutChartConfig);
    donutChart.render();
  }
</script>


@endsection