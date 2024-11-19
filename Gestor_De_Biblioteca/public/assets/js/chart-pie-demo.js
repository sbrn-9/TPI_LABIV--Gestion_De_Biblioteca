// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var catNames = JSON.parse(ctx.getAttribute("data-labels"));

var topCats = JSON.parse(ctx.getAttribute("data-values"));
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [catNames[0], catNames[1], catNames[2]],
    datasets: [{
      data: [Number(topCats[0]), Number(topCats[1]), Number(topCats[2])],
      backgroundColor: ['#8179C2','#B199EC', '#E1D9FF'],
      hoverBackgroundColor: ['#8179C2', '#B199EC', '#E1D9FF'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
