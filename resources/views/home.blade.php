@extends('layouts.admin')
@section('content')
<div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h4>Dashboard </h4>
                </div>

           
            <div class="col-xl-3 col-md-6 mb-4  ">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body ">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 ">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Claims</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalReclamations) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Open Claim</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($openReclamations) }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Closed Claim</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ number_format($closedReclamations) }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-envelope   fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

         
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($user) }}   </div>
                    </div>
                    <div class="col-auto">
                     
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
    <div>
   <div class="row">
      <div class="col-lg-6"> <div id="piechart" style="width: 490px; height: 300px;"></div></div>
       <div class="col-lg-6" ><canvas id="myChart" width="490" height="300"></canvas></div>
    </div>
    <div style="width: 100%;height:20px" ></div>
    <div class="row">
     
     <div class="col-lg-12" > <div id="chartdiv" style="width: 100%px;height: 300px; background-color:white"></div></div>
     


    </div>
    <div style="width: 100%;height:30px" ></div>
   

   
    
</div>
@endsection
@section('scripts')
@parent
<script>
google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Total ', 'l'],
      ['Total Claim', <?php echo $totalReclamations ?>],
      ['Opened Claim', <?php echo  $openReclamations ?>],
      ['Closed Claim', <?php echo $closedReclamations ?>]
    ]);

    var options = {
      title:  'Daily Activities'
     
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
  var ctx = document.getElementById('myChart');
  ctx.style.backgroundColor = 'rgba(255,255,255,255)';
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        
        labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October','November','December'],
        datasets: [{
            label: 'Number Of Users',
            data: [<?php echo $jan ?>, <?php echo  $fev ?>, <?php echo $mar ?>, <?php echo $apr ?>, <?php echo $mai ?>, <?php echo $jui ?>,<?php echo $juie ?>,<?php echo $aou ?>,<?php echo $sep ?>,<?php echo $oct ?>,<?php echo $nou ?>,<?php echo $dec ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

</script>
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_dataviz);
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data = [ {
  "user": "Customer",
  "count": <?php echo $customer ?>
}, {
  "user": "Responsible",
  "count":  <?php echo $responsible ?>
}, {
  "user": "Admin",
  "count":  <?php echo $admin ?>
}
   ];
   
                   
// Set inner radius
chart.innerRadius = am4core.percent(50);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "count";
pieSeries.dataFields.category = "user";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>


@endsection
