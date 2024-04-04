var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Food Pantry', 'HEROZERO', 'FOOD WASTE'],
        datasets: [{
            label: 'Sales',
            data: [33.3, 33.3, 33.3 ],
            backgroundColor: [
                '#F69D62', //foodpantry
                '#D56B26', //herozero
                '#EE762C',//foodwaste
               
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

var ctx = document.getElementById('lineChart').getContext('2d');
var lineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Food Pantry', 'HEROZERO', 'FOOD WASTE'],
        datasets: [{
            label: 'Sales',
            data: [50000, 150000, 250000 ],
            backgroundColor: [
                '#F69D62', //foodpantry
                '#D56B26', //herozero
                '#EE762C',//foodwaste
               
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