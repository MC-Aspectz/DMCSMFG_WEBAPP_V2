<?php 
require_once(dirname(__FILE__, 5) . '/common/SessionStart.php');
require_once(dirname(__FILE__, 5) . '/include/menubar.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DMCS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="flex flex-col h-screen">
    <!--  start::navbar Menu -->
    <header class="flex relative top-0 text-semibold">
        <!-------------------------------------------------------------------------------------->
        <?php navBar(); ?>
        <!-------------------------------------------------------------------------------------->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://unpkg.com/chartjs-chart-timeline@0.3.0/timeline.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

        <script src="https://github.highcharts.com/gantt/highcharts.src.js"></script>
        <script src="https://github.highcharts.com/gantt/modules/gantt.src.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script> -->
   <!--      <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-adapter-date-fns/3.0.0/chartjs-adapter-date-fns.min.js" integrity="sha512-rwTcVAtpAmT3KnwlKHOqeV7ETOTUdf0uYbR4YGf3149X+X+Rx3tgJOOhqFVsyNl0oMgJSPqAOoFuf57WNN0RYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    </header>
    <!--  end::navbar Menu -->

    <div class="flex flex-1 overflow-hidden">
        <!--   start::Sidebar Menu -->
        <!-------------------------------------------------------------------------------------->
        <?php sideBar(); ?>
        <!-------------------------------------------------------------------------------------->
        <!--   end::Sideba Menu -->

        <!--   start::Main Content  -->
        <main class="flex flex-1 overflow-y-auto overflow-x-hidden paragraph px-2">
            <!-- Content Page -->
            <form class="w-full" method="POST" action="" id="chartJS" name="chartJS" onkeydown="if(event.keyCode == 13) { event.preventDefault(); return false;}">


                <div id="apexchart2"></div>

                <div id="apexchart"></div>

                <div id="container"></div>


                <div id="chartTarget" class="w-full h-full">
                    <canvas id="deviceOnChart" width="600" height="160"></canvas>
                    <div class="chartTooltip center opacity-0"></div>
                </div>


     

            </form>
        </main>
        <!--   end::Main Content -->
    </div>

    <!-- start::footer -->
    <div class="flex bg-gray-200">
        <!-------------------------------------------------------------------------------------->
        <?php footerBar(); ?>
        <!-------------------------------------------------------------------------------------->
    </div>
    <!-- end::footer -->

    <!-- start::loading -->
    <div id="loading" class="on hidden">
        <div class="cv-spinner"><div class="spinner"></div></div>
    </div>
    <!-- end::loading -->
</div>
</body>
<script type="text/javascript">
 
        var options = {
          series: [
          {
            data: [
              {
                x: 'Operations',
                y: [2800, 4500]
              },
              {
                x: 'Customer Success',
                y: [3200, 4100]
              },
              {
                x: 'Engineering',
                y: [2950, 7800]
              },
              {
                x: 'Marketing',
                y: [3000, 4600]
              },
              {
                x: 'Product',
                y: [3500, 4100]
              },
               {
                x: 'Product',
                y: [4300, 5100]
              },
              {
                x: 'Data Science',
                y: [4500, 6500]
              },
              {
                x: 'Sales',
                y: [4100, 5600]
              }
            ]
          }
            ],
            chart: {
              height: 390,
              type: 'rangeBar',
              zoom: {
                enabled: false
              }
            },
            colors: ['#EC7D31', '#36BDCB'],
            plotOptions: {
              bar: {
                horizontal: true,
                isDumbbell: true,
                dumbbellColors: [['#EC7D31', '#36BDCB']]
              }
            },
            title: {
              text: 'Paygap Disparity'
            },
            legend: {
              show: true,
              showForSingleSeries: true,
              position: 'top',
              horizontalAlign: 'left',
              customLegendItems: ['Female', 'Male']
            },
            fill: {
              type: 'gradient',
              gradient: {
                gradientToColors: ['#36BDCB'],
                inverseColors: false,
                stops: [0, 100]
              }
            },
            grid: {
              xaxis: {
                lines: {
                  show: true
                }
              },
              yaxis: {
                lines: {
                  show: false
                }
              }
            }
            };

        var chart = new ApexCharts(document.querySelector("#apexchart2"), options);
        chart.render();
      


    ApexChartultiRange();

    hightchartz();


    var deviceOnTime = [
          '2019-12-13 06:32',
          '2019-12-12 09:26',
          '2019-12-11 11:45',
          '2019-12-10 18:06',
          '2019-12-09 03:56',
          '2019-12-08 15:34',
          '2019-12-07 12:53',   
          '2019-12-07 15:53',
          '2019-12-06 21:35',
        ]
        var deviceOffTime = [
          '2019-12-13 21:34',
          '2019-12-12 17:28',
          '2019-12-11 22:58',
          '2019-12-10 21:45',
          '2019-12-09 14:27',
          '2019-12-08 19:35',
          '2019-12-07 14:53',
          '2019-12-07 21:53',
          '2019-12-06 22:35'
        ]

        var labels = []
        var deviceOnTimeParsed = []
        var deviceOffTimeParsed = []

        for (var i = 0; i < deviceOnTime.length; i++) {
            labels.push(moment(deviceOnTime[i], 'YYYY-MM-DD hh:mm').format('ddd DD/MM') + 'PO12313123');
            deviceOnTimeParsed.push(moment(deviceOnTime[i], 'YYYY-MM-DD hh:mm') - moment(deviceOnTime[i], 'YYYY-MM-DD hh:mm').startOf('day'));
            deviceOffTimeParsed.push(moment(deviceOffTime[i], 'YYYY-MM-DD hh:mm') - moment(deviceOffTime[i], 'YYYY-MM-DD hh:mm').startOf('day'));
        }

        // var datasets = [];
        var datasets = [{
            label: 'On',
            borderColor: '#ff3366',
            backgroundColor: '', // 'green'
            data: [],
            order: '',
            borderWidth: 1,
              fill: false,
            set_data: [
              { month: 1, value: 1700 }, 
              { month: 2, value: 2800 }, 
              { month: 3, value: 3200 }
            ]

              // pointRadius: 0,
        }]

        for (var i = 0; i < deviceOnTimeParsed.length; i++) {
            datasets[0].data.push( [
                  deviceOnTimeParsed[i],
                  deviceOffTimeParsed[i]
                  // moment(deviceOnTime[i], 'YYYY-MM-DD hh:mm').format('ddd DD/MM') + 'PO12313123'
                ]
            );
            datasets[0].order = i+1;
            // let colors = getRandomColor();
           // datasets[0].backgroundColor = colors;
            // datasets[0].backgroundColor = '#'+Math.floor(Math.random()*16777215).toString(16);
        }

        //console.log(labels)
        //console.log(deviceOnTimeParsed)
        // console.log(datasets)

    var ctx = document.getElementById('deviceOnChart');

    var data = {
      type: 'horizontalBar',
      options: {
        legend: {
          display: false,
        },
        hover: {  // <-- to add
          mode: 'nearest'
        },
        interaction: {
          mode: 'index',
          intersect: true,
        },
        indexAxis: 'x',
        stacked: false,
        responsive: true,

        //   xAxes: [{
        //     type: 'time',
        //     time: {
        //       unit: 'hour',
        //       displayFormats: {
        //         hour: 'HH:mm'
        //       },
        //     },
        //     ticks: {
        //       min: moment(0),
        //       max: moment(86400000)
        //     },
        //     position: 'top' // label position
        //   }]
        // },

     // scales: {
     //      xAxes: [{
     //        type: 'time',
     //        time: {
     //          displayFormats: {
     //            'millisecond': 'MMM DD',
     //            'second': 'MMM DD',
     //            'minute': 'MMM DD',
     //            'hour': 'MMM DD',
     //            'day': 'MMM DD',
     //            'week': 'MMM DD',
     //            'month': 'MMM DD',
     //            'quarter': 'MMM DD',
     //            'year': 'MMM DD',
     //          }
     //        },
     //                ticks: {
     //          min: moment(0),
     //          max: moment(86400000)
     //        },
     //        position: 'top' // label position
     //      }],
     //    },

        scales: {
               y: {
            beginAtZero: true
          },
          //     y: {
          //   type: 'linear',
          //   display: true,
          //   position: 'left',
          // },
      xAxes: [{
         offset: true,
        type: 'time',
          // label: 'temperature',
        time: {
          unit: 'second',
          displayFormats: {
            second: 'YYYY-MM-DD HH:mm:ss'
          }
        },
                ticks: {
              min: moment(0),
              max: moment(86400000)
            },
            position: 'top' // label position
      }]
        },

        //     scales: {
        //    xAxes: [{
        //       type: 'time',
        //       time: {
        //         unit: 'hour',
        //         displayFormats: {
        //            'hour': 'HH:MM',
        //         },
        //          min: moment(0),
        //           max: moment(86400000)
        //       }
        //    }],
        // },  // end scales  
            // scales: {
            //   y: {
            //     type: 'linear',
            //     display: true,
            //     position: 'left',
            //   },
            //   xAxes: [{
            //     type: "time",
            //      // this is not doing much 
            //      // time: {
            //       // min: start,
            //       // max: end,
            //       // unit: "day"
            //     //}
            //   }]
            // },
            // scales: {
            //         xAxes: [{
            //           time: 
            //  {
            //    format: 'MM',
            //      unit: 'month',
            //      parser:'MM',
            //      displayFormats: { month: 'MM' },
            //      //       max: '2017-10-09 18:43:53',
            //      // min: '2017-00-02 18:43:53'
            //       min: moment(0),
            //       max: moment(86400000)
            //  },
            //             position: 'top'
            //         }]
            //      },
            // plugins: {
            //   legend: {
            //     display: false,
            //   },
            // },
            tooltips: {
                    mode: 'nearest',
              intersect: true,
              callbacks: {
            label: function(tooltipItem, data) {
              // console.log(tooltipItem, data)
              let values = data.datasets[0].data[tooltipItem.index]
              // console.log(values)
              // console.log(moment(values[0]).format('hh:mm'), moment(values[0]))
              return moment(values[0]).format('hh:mm') + ' - ' + moment(values[1]).format('hh:mm')
            }
          },
          yAlign: 'top'
        },
      },
      data: {
        labels: labels,
        datasets: datasets
      },
    };

    var chart = new Chart(document.getElementById('deviceOnChart').getContext('2d'), data);
    // --------------------------------------------------------------------------------------- //
    // document.getElementById('deviceOnChart').onclick = function(evt){
    //     var activePoints = chart.getElementsAtEvent(evt);
    //     var firstPoint = activePoints[0];
    //     console.log(firstPoint._datasetIndex);
    //     console.log(firstPoint._index);
    //     var label = chart.data.labels[firstPoint._index];
    //     // var label = chart.data.datasets[firstPoint._index].label;
    //     var value = chart.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
    //     // debugger;
    //     if (firstPoint !== undefined) {
    //         alert(label + ': ' + value.x);
    //     }
    // };

    document.getElementById('deviceOnChart').onclick = function(evt) {
        var activePoint = chart.getElementAtEvent(event);
        // make sure click was on an actual point
        if (activePoint.length > 0) {
            var clickedDatasetIndex = activePoint[0]._datasetIndex;
            var clickedElementindex = activePoint[0]._index;
            var label = chart.data.labels[clickedElementindex];
            var value = chart.data.datasets[clickedDatasetIndex].data[clickedElementindex];     
            alert('Clicked: ' + label + ' - ' + moment(value[0]).format('hh:mm') + ' - ' + moment(value[1]).format('hh:mm'));
        }
}
// --------------------------------------------------------------------------------------- //
var randomColorPlugin = {
    // We affect the `beforeUpdate` event
    beforeUpdate: function(chart) {
        var backgroundColor = [];
        var borderColor = [];
        // For every data we have ...
        for (var i = 0; i < chart.config.data.datasets[0].data.length; i++) {
            // We generate a random color
            var color = 'rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',';
            // We push this new color to both background and border color arrays
            backgroundColor.push(color + '0.6)');
            borderColor.push(color + '1)');
            // let color = getRandomColor();
            // backgroundColor.push(color);
            // borderColor.push(color);
        }
        
        // We update the chart bars color properties
        chart.config.data.datasets[0].backgroundColor = backgroundColor;
        chart.config.data.datasets[0].borderColor = borderColor;
    }
};

// We now register the plugin to the chart's plugin service to activate it
Chart.pluginService.register(randomColorPlugin);
// --------------------------------------------------------------------------------------- //
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function randomColor() {
 return 'rgba(' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) + ','; 
}

function ApexChartultiRange() {
        var options = {
          series: [
          {
            name: 'Bob',
                data: [
             {
                x: 'PO12313123',
                y: [
                  new Date('2019-03-12 07:08').getTime(),
                  new Date('2019-03-12 12:25').getTime()
                ]
              },
                {
                    x: 'PO12313123',
                    y: [
                      new Date('2019-03-12 14:08').getTime(),
                      new Date('2019-03-12 18:25').getTime()
                    ]
                },
              {
                x: 'Design',
                y: [
                  new Date('2019-03-05 12:08').getTime(),
                  new Date('2019-03-08 17:25').getTime()
                ]
              },
              {
                x: 'Code',
                y: [
                  new Date('2019-03-02').getTime(),
                  new Date('2019-03-05').getTime()
                ]
              },
              {
                x: 'Code',
                y: [
                  new Date('2019-03-05').getTime(),
                  new Date('2019-03-07').getTime()
                ]
              },
              {
                x: 'Test',
                y: [
                  new Date('2019-03-03').getTime(),
                  new Date('2019-03-09').getTime()
                ]
              },
              {
                x: 'Test',
                y: [
                  new Date('2019-03-08').getTime(),
                  new Date('2019-03-11').getTime()
                ]
              },
              {
                x: 'Validation',
                y: [
                  new Date('2019-03-11').getTime(),
                  new Date('2019-03-16').getTime()
                ]
              },
              {
                x: 'Design',
                y: [
                  new Date('2019-03-01').getTime(),
                  new Date('2019-03-03').getTime()
                ],
              }
            ]
          },
          {
            name: 'Joe',
            data: [
              {
                x: 'Design',
                y: [
                  new Date('2019-03-02').getTime(),
                  new Date('2019-03-05').getTime()
                ]
              },
              {
                x: 'Test',
                y: [
                  new Date('2019-03-06').getTime(),
                  new Date('2019-03-16').getTime()
                ],
                goals: [
                  {
                    name: 'Break',
                    value: new Date('2019-03-10').getTime(),
                    strokeColor: '#CD2F2A'
                  }
                ]
              },
              {
                x: 'Code',
                y: [
                  new Date('2019-03-03').getTime(),
                  new Date('2019-03-07').getTime()
                ]
              },
              {
                x: 'Deployment',
                y: [
                  new Date('2019-03-20').getTime(),
                  new Date('2019-03-22').getTime()
                ]
              },
              {
                x: 'Design',
                y: [
                  new Date('2019-03-10').getTime(),
                  new Date('2019-03-16').getTime()
                ]
              }
            ]
          },
          {
            name: 'Dan',
            data: [
              {
                x: 'Code',
                y: [
                  new Date('2019-03-10').getTime(),
                  new Date('2019-03-17').getTime()
                ]
              },
              {
                x: 'Validation',
                y: [
                  new Date('2019-03-05').getTime(),
                  new Date('2019-03-09').getTime()
                ],
                goals: [
                  {
                    name: 'Break',
                    value: new Date('2019-03-07').getTime(),
                    strokeColor: '#CD2F2A'
                  }
                ]
              },
            ]
          }
        ],
          chart: {
          height: 450,
          type: 'rangeBar'
        },
        plotOptions: {
          bar: {
            horizontal: true,
            barHeight: '80%',
          }
        },
        xaxis: {
          type: 'datetime'
        },
        stroke: {
          width: 1
        },
        fill: {
          type: 'solid',
          opacity: 0.6
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            position: 'top',
            horizontalAlign: 'left',
            // customLegendItems: ['Female', 'Male', 'GTT']
        }
        };

        var chart = new ApexCharts(document.querySelector("#apexchart"), options);
        chart.render();
}

function hightchartz() {
      // var days = 24 * 60 * 60 * 1000;
        var days = 1000 * 60 * 60 * 24;
        Highcharts.ganttChart('container', {
            yAxis: {
            type: 'category',
            categories: ['Apples', 'Pears']
          },
          series: [{
            data: [{
              name: 'Apple 1',
              y: 0,
              start: 1 * days,
              end: 2 * days
            }, {
              name: 'Apple 2',
              y: 0,
              start: 3 * days, 
              end: 4 * days
            }, {
                name: 'Pear',
              y: 1,
              start: 1 * days,
              end: 4 * days
            }]
          }]
        });
}
</script>
<!-- https://stackoverflow.com/questions/69657092/charts-js-display-two-combined-line-charts-for-last-7-days -->

<!-- https://www.highcharts.com/demo/gantt -->
<!-- https://www.highcharts.com/docs/chart-and-series-types/bullet-chart -->

<!-- https://apexcharts.com/javascript-chart-demos/timeline-charts/advanced/ -->
</html>