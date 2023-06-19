/* global Chart:false */

function getDateIso(day) {
  return Date.UTC(
    day.getFullYear(),
    day.getMonth(),
    day.getDate(),
    day.getHours(),
    day.getMinutes(),
    day.getSeconds()
  );
}

function getDateFullTime(day, separator, lang = null) {
  var date = day.getDate() < 10 ? '0' + day.getDate() : day.getDate();
  var mounth = day.getMonth() + 1;
  var month = mounth < 10 ? '0' + mounth : mounth;

  return lang === 'en' 
  ? day.getFullYear() + separator + month + separator + date
  : 
  date + separator + month + separator + day.getFullYear()
}

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  // eslint-disable-next-line no-unused-vars
  function getDateIso(day) {
    return Date.UTC(
      day.getFullYear(),
      day.getMonth(),
      day.getDate(),
      day.getHours(),
      day.getMinutes(),
      day.getSeconds()
    );
  }
  var currentDay = new Date();

  var dayMinus0 = (new Date()).setDate(currentDay.getDate());
  var dayMinus0 = new Date(dayMinus0);

  var dayMinus1 = (new Date()).setDate(currentDay.getDate() - 1);
  var dayMinus1 = new Date(dayMinus1);

  var dayMinus2 = (new Date()).setDate(currentDay.getDate() - 2);
  var dayMinus2 = new Date(dayMinus2);

  var dayMinus3 = (new Date()).setDate(currentDay.getDate() - 3);
  var dayMinus3 = new Date(dayMinus3);

  var dayMinus4 = (new Date()).setDate(currentDay.getDate() - 4);
  var dayMinus4 = new Date(dayMinus4);

  var dayMinus5 = (new Date()).setDate(currentDay.getDate() - 5);
  var dayMinus5 = new Date(dayMinus5);

  var dayMinus6 = (new Date()).setDate(currentDay.getDate() - 6);
  var dayMinus6 = new Date(dayMinus6);

  var listOrders = JSON.parse(localStorage.getItem('listOrders'))
  var dataGrapheAmount = []
  var dataGrapheNumberOrders = []
  var labels = [
    getDateFullTime(dayMinus6, '-'),
    getDateFullTime(dayMinus5, '-'),
    getDateFullTime(dayMinus4, '-'),
    getDateFullTime(dayMinus3, '-'),
    getDateFullTime(dayMinus2, '-'),
    getDateFullTime(dayMinus1, '-'),
    getDateFullTime(dayMinus0, '-'),
  ]
  for (var i = 0; i < listOrders.recapOrders.length; i++) {
    dataGrapheAmount[listOrders.recapOrders.length - (i + 1)] = listOrders.recapOrders[i].totalSaleDayMinus
    dataGrapheNumberOrders[listOrders.recapOrders.length - (i + 1)] = listOrders.recapOrders[i].numberOrdersDayMinus
    labels[listOrders.recapOrders.length - (i + 1)] = labels[listOrders.recapOrders.length - (i + 1)] 
    + '\n(' + listOrders.recapOrders[i].numberOrdersDayMinus 
    + ' commandes)'
  }

  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: dataGrapheAmount
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              /* if (value >= 1000) {
                value /= 1000
                value += 'k'
              } */
              
              return parseFloat(value).toLocaleString('fr') + ' €'
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

  if ($('#div-loading')) {
    $('#div-loading').hide();
  }
  //$('#content-dashboard-1, #content-dashboard-2, #sales-chart').show();
  

  /* var $visitorsChart = $('#visitors-chart')
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  }) */
})
