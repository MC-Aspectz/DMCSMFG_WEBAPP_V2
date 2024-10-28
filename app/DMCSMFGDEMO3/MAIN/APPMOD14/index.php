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
<!-- 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.8.1/frappe-gantt.min.css" integrity="sha512-G2M9CxZAUjWpHI/VOEqLLNoyL+n999upx9lFyO43Z+Chxc/GxJ+3MIFOiL8YGrHoPS7hPDgMLO3hLaenofvMkA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.8.1/frappe-gantt.es.min.js" integrity="sha512-PLnWC1Kvjph8cz9a0xfNi/ygWUXIvDwjMJ3w4gfEOQivLx7ju8h4HXiZIpd8dTiyx/tGV0l+pwAC7mzEYNFHIA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/frappe-gantt/0.8.1/frappe-gantt.umd.min.js" integrity="sha512-YUxzTtqJSWVm6NNPOwWvGt1Onw4MS7GW4fa+V+oxrKkE3CIRK+MIiXqWm9i+n2Yi7FY1fPirGTq6/wXSYyNQgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
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
                <!-- <canvas id="gantt-chart"></canvas> -->

                <!-- <div id="ganttChart" style="height: 400px"></div> -->

                <!-- <div id="apex-chart"></div> -->

                <div id="apexchart"></div>

                <div id="apexchart2"></div>

                <div id="apexchart3"></div>

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
<style>
/*.apexcharts-menu-item.exportCSV { display: none; }*/
</style>
<script type="text/javascript">

    ApexChartMultiRange();

    apexCandelStick();

    apexDumbbellHorizontalLine();

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

function ApexChartMultiRange() {
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
                ],
            },
                // {
                //     name: 'Some data',
                //     data: generateDayWiseTimeSeries(0, 5),
                // },
            ],

            chart: {
                height: 450,
                type: 'rangeBar',
                toolbar: {
                   // show: true,   // false

                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        // reset: true | '<img src="/static/icons/reset.png" width="20">',
                        customIcons: [

                        ],
                         // customIcons: [{
                         //   icon: 'icon',
                         //   index: 0,
                         //   title: 'tooltip of the icon',
                         //   class: 'custom-icon',
                         //   click: function (chart, options, e) {
                         //      console.log('clicked')
                         //   }
                         // }]
                    },
                    // export: {
                    // csv: {
                      // headerCategory: 'Date;Time',
                      // columnDelimiter: ';',
                      // dateFormatter: function(timestamp) {
                      //   var date = dayjs(new Date(timestamp));
                      //   var format = 'ddd D. MMM;HH:mm'  // sic: Delimiter in here on purpose
                      //   var nextHour = Number(date.hour()) + 1;
                      //   var text = date.format(format) + ' - ' + nextHour + ':00';
                      //   return text;
                      // },
                    // },
                    export: {
                        csv: {
                            filename: `timeline ${new Date().toLocaleString()}`,
                            headerCategory: 'category',
                            columnDelimiter: ', ',
                            dateFormatter: function(timestamp) {
                                var date = dayjs(new Date(timestamp));
                                var format = 'ddd D. MMM;HH:mm'  // sic: Delimiter in here on purpose
                                var nextHour = Number(date.hour()) + 1;
                                var text = date.format(format) + ' - ' + nextHour + ':00';
                                return text;
                            },
                          // columnDelimiter: ', ',
                          // headerCategory: 'category',
                          // headerValue: 'value',
                          // dateFormatter(timestamp) {
                          //   console.log(timestamp);
                          //   return timestamp
                          //   },
                        },
                        svg: {
                            filename: `timeline ${new Date().toLocaleString()}`,
                        },
                        png: {
                            filename: `timeline ${new Date().toLocaleString()}`,
                        }
                    // autoSelected: 'zoom' ,
                    },
                },
                 events: {
                    dataPointSelection(event, chartContext, opts) {
                        // console.log(opts.w.config.series[opts.seriesIndex])
                        // console.log(opts.w.config.series[opts.seriesIndex].name)
                        // console.log(opts.w.config.series[opts.seriesIndex].data[opts.dataPointIndex])
                    },
                    // click(event, chartContext, opts) {
                    //     console.log(opts.config.series[opts.seriesIndex])
                    //     console.log(opts.config.series[opts.seriesIndex].name)
                    //     console.log(opts.config.series[opts.seriesIndex].data[opts.dataPointIndex])
                    // },
                    xAxisLabelClick: function(event, chartContext, config) {
                        // ...
                    },
                    // selection: function(chartContext, { xaxis, yaxis }) {
                    //     console.log(chartContext);
                    // },
                    // click: function(event, chartContext, config) {
                    //     console.log(event.target.parentElement.getAttribute("data:realIndex"))
                    // },
              },
            },
            plotOptions: {
              bar: {
                distributed: true,
                horizontal: true,
                barHeight: '80%',
                // isDumbbell: true,
              }
            },
            // colors: randomColor({
            // luminosity: "light",
            // hue: "blue",
            // count: 30
            // }),
            xaxis: {
                type: 'datetime',
                tickPlacement: 'on',
                // labels: {
                //     formatter: function(value) {
                //        return new Date(value);    
                //     },
                // },
            },
            yaxis: {
                // show: false,
                tooltip: {
                    enabled: true,
                },  
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
            },
            // tooltip: {
            //         custom: function(opts) {
            //         const desc =
            //           opts.ctx.w.config.series[opts.seriesIndex].data[
            //             opts.dataPointIndex
            //           ].description

            //         const value = opts.series[opts.seriesIndex][opts.dataPointIndex]

            //         return desc + ': ' + value;
            //       }
                // },  
states: {
  normal: {
    filter: { type: 'none', value: 0 },
  },
  hover: {
    filter: { type: 'lighten', value: 0.2 },
  },
  active: {
    filter: { type: 'darken', value: 0.2 },
    allowMultipleDataPointsSelection: false,
  },
},

        };

        var chart = new ApexCharts(document.querySelector("#apexchart"), options);
        chart.render();
}

// !--  Example Generate data -->
function generateDayWiseTimeSeries(s, count) {
  var values = [[
    4,3,10,9,29,19,25,9,12,7,19,5,13,9,17,2,7,5
  ], [
    2,3,8,7,22,16,23,7,11,5,12,5,10,4,15,2,6,2
  ]];
  var i = 0;
  var series = [];
  var x = new Date("11 Nov 2012").getTime();
  while (i < count) {
    series.push([x, values[s][i]]);
    x += 86400000;
    i++;
  }
  return series;
}
// ------------------------------------------------------//
function apexCandelStick() {

        var options = {
          series: [{
          data: [{
              x: new Date(1538778600000),
              y: [6629.81, 6650.5, 6623.04, 6633.33]
            },
            {
              x: new Date(1538780400000),
              y: [6632.01, 6643.59, 6620, 6630.11]
            },
            {
              x: new Date(1538782200000),
              y: [6630.71, 6648.95, 6623.34, 6635.65]
            },
            {
              x: new Date(1538784000000),
              y: [6635.65, 6651, 6629.67, 6638.24]
            },
            {
              x: new Date(1538785800000),
              y: [6638.24, 6640, 6620, 6624.47]
            },
            {
              x: new Date(1538787600000),
              y: [6624.53, 6636.03, 6621.68, 6624.31]
            },
            {
              x: new Date(1538789400000),
              y: [6624.61, 6632.2, 6617, 6626.02]
            },
            {
              x: new Date(1538791200000),
              y: [6627, 6627.62, 6584.22, 6603.02]
            },
            {
              x: new Date(1538793000000),
              y: [6605, 6608.03, 6598.95, 6604.01]
            },
            {
              x: new Date(1538794800000),
              y: [6604.5, 6614.4, 6602.26, 6608.02]
            },
            {
              x: new Date(1538796600000),
              y: [6608.02, 6610.68, 6601.99, 6608.91]
            },
            {
              x: new Date(1538798400000),
              y: [6608.91, 6618.99, 6608.01, 6612]
            },
            {
              x: new Date(1538800200000),
              y: [6612, 6615.13, 6605.09, 6612]
            },
            {
              x: new Date(1538802000000),
              y: [6612, 6624.12, 6608.43, 6622.95]
            },
            {
              x: new Date(1538803800000),
              y: [6623.91, 6623.91, 6615, 6615.67]
            },
            {
              x: new Date(1538805600000),
              y: [6618.69, 6618.74, 6610, 6610.4]
            },
            {
              x: new Date(1538807400000),
              y: [6611, 6622.78, 6610.4, 6614.9]
            },
            {
              x: new Date(1538809200000),
              y: [6614.9, 6626.2, 6613.33, 6623.45]
            },
            {
              x: new Date(1538811000000),
              y: [6623.48, 6627, 6618.38, 6620.35]
            },
            {
              x: new Date(1538812800000),
              y: [6619.43, 6620.35, 6610.05, 6615.53]
            },
            {
              x: new Date(1538814600000),
              y: [6615.53, 6617.93, 6610, 6615.19]
            },
            {
              x: new Date(1538816400000),
              y: [6615.19, 6621.6, 6608.2, 6620]
            },
            {
              x: new Date(1538818200000),
              y: [6619.54, 6625.17, 6614.15, 6620]
            },
            {
              x: new Date(1538820000000),
              y: [6620.33, 6634.15, 6617.24, 6624.61]
            },
            {
              x: new Date(1538821800000),
              y: [6625.95, 6626, 6611.66, 6617.58]
            },
            {
              x: new Date(1538823600000),
              y: [6619, 6625.97, 6595.27, 6598.86]
            },
            {
              x: new Date(1538825400000),
              y: [6598.86, 6598.88, 6570, 6587.16]
            },
            {
              x: new Date(1538827200000),
              y: [6588.86, 6600, 6580, 6593.4]
            },
            {
              x: new Date(1538829000000),
              y: [6593.99, 6598.89, 6585, 6587.81]
            },
            {
              x: new Date(1538830800000),
              y: [6587.81, 6592.73, 6567.14, 6578]
            },
            {
              x: new Date(1538832600000),
              y: [6578.35, 6581.72, 6567.39, 6579]
            },
            {
              x: new Date(1538834400000),
              y: [6579.38, 6580.92, 6566.77, 6575.96]
            },
            {
              x: new Date(1538836200000),
              y: [6575.96, 6589, 6571.77, 6588.92]
            },
            {
              x: new Date(1538838000000),
              y: [6588.92, 6594, 6577.55, 6589.22]
            },
            {
              x: new Date(1538839800000),
              y: [6589.3, 6598.89, 6589.1, 6596.08]
            },
            {
              x: new Date(1538841600000),
              y: [6597.5, 6600, 6588.39, 6596.25]
            },
            {
              x: new Date(1538843400000),
              y: [6598.03, 6600, 6588.73, 6595.97]
            },
            {
              x: new Date(1538845200000),
              y: [6595.97, 6602.01, 6588.17, 6602]
            },
            {
              x: new Date(1538847000000),
              y: [6602, 6607, 6596.51, 6599.95]
            },
            {
              x: new Date(1538848800000),
              y: [6600.63, 6601.21, 6590.39, 6591.02]
            },
            {
              x: new Date(1538850600000),
              y: [6591.02, 6603.08, 6591, 6591]
            },
            {
              x: new Date(1538852400000),
              y: [6591, 6601.32, 6585, 6592]
            },
            {
              x: new Date(1538854200000),
              y: [6593.13, 6596.01, 6590, 6593.34]
            },
            {
              x: new Date(1538856000000),
              y: [6593.34, 6604.76, 6582.63, 6593.86]
            },
            {
              x: new Date(1538857800000),
              y: [6593.86, 6604.28, 6586.57, 6600.01]
            },
            {
              x: new Date(1538859600000),
              y: [6601.81, 6603.21, 6592.78, 6596.25]
            },
            {
              x: new Date(1538861400000),
              y: [6596.25, 6604.2, 6590, 6602.99]
            },
            {
              x: new Date(1538863200000),
              y: [6602.99, 6606, 6584.99, 6587.81]
            },
            {
              x: new Date(1538865000000),
              y: [6587.81, 6595, 6583.27, 6591.96]
            },
            {
              x: new Date(1538866800000),
              y: [6591.97, 6596.07, 6585, 6588.39]
            },
            {
              x: new Date(1538868600000),
              y: [6587.6, 6598.21, 6587.6, 6594.27]
            },
            {
              x: new Date(1538870400000),
              y: [6596.44, 6601, 6590, 6596.55]
            },
            {
              x: new Date(1538872200000),
              y: [6598.91, 6605, 6596.61, 6600.02]
            },
            {
              x: new Date(1538874000000),
              y: [6600.55, 6605, 6589.14, 6593.01]
            },
            {
              x: new Date(1538875800000),
              y: [6593.15, 6605, 6592, 6603.06]
            },
            {
              x: new Date(1538877600000),
              y: [6603.07, 6604.5, 6599.09, 6603.89]
            },
            {
              x: new Date(1538879400000),
              y: [6604.44, 6604.44, 6600, 6603.5]
            },
            {
              x: new Date(1538881200000),
              y: [6603.5, 6603.99, 6597.5, 6603.86]
            },
            {
              x: new Date(1538883000000),
              y: [6603.85, 6605, 6600, 6604.07]
            },
            {
              x: new Date(1538884800000),
              y: [6604.98, 6606, 6604.07, 6606]
            },
          ]
        }],
        chart: {
          type: 'candlestick',
          height: 350
        },
        title: {
          text: 'CandleStick Chart',
          align: 'left'
        },
        xaxis: {
            type: 'datetime',
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#apexchart3"), options);
        chart.render();
}
 
function apexDumbbellHorizontalLine() {
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
<!-- https://apexcharts.com/docs/options/plotoptions/bar/# -->

<!-- https://www.syncfusion.com/javascript-ui-controls/js-gantt-chart -->

<!-- https://codepen.io/cb109/pen/QWEReJy --> <!--  Example Generate data -->

<!-- https://write.corbpie.com/apexcharts-toggle-data-with-buttons-example/ --> <!--  Example Generate data -->

<!-- https://apexcharts.com/docs/options/chart/events/#selection -->

<!-- https://codepen.io/junedchhipa/pen/YJQKOy -->
</html>