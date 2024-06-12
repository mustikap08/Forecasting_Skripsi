// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "Mar 1",
            "Mar 2",
            "Mar 3",
            "Mar 4",
            "Mar 5",
            "Mar 6",
            "Mar 7",
            "Mar 8",
            "Mar 9",
            "Mar 10",
            "Mar 11",
            "Mar 12",
            "Mar 13",
        ],
        datasets: [
            {
                label: "Sales",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [
                    10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259,
                    25849, 24159, 32651, 31984, 38451,
                ],
                yAxisID: "y1", // Assign this dataset to y-axis with id 'y1'
                backgroundColor: "transparent", // Remove background
            },
            {
                label: "Sales Forecast",
                lineTension: 0.3,
                backgroundColor: "rgba(255,193,7,0.2)",
                borderColor: "rgba(255,193,7,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(255,193,7,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(255,193,7,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: [
                    20000, 18000, 22000, 25000, 28000, 30000, 32000, 33000,
                    34000, 36000, 38000, 40000, 42000,
                ],
                yAxisID: "y2", // Assign this dataset to y-axis with id 'y2'
                backgroundColor: "transparent", // Remove background
            },
        ],
    },
    options: {
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "date",
                    },
                    gridLines: {
                        display: false,
                    },
                    ticks: {
                        maxTicksLimit: 7,
                    },
                },
            ],
            yAxes: [
                {
                    id: "y1", // Assign id 'y1' for the first y-axis
                    position: "left", // Position on the left side
                    ticks: {
                        min: 0,
                        max: 20000,
                        maxTicksLimit: 5,
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    },
                },
                {
                    id: "y2", // Assign id 'y2' for the second y-axis
                    position: "right", // Position on the right side
                    ticks: {
                        min: 0,
                        max: 20000,
                        maxTicksLimit: 5,
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    },
                },
            ],
        },
        legend: {
            display: true,
        },
    },
});

// Fungsi untuk mengambil data dari server dan mengupdate chart
var url = "/getData";

var url = "/getData";

fetch(url)
    .then(function (response) {
        return response.json(); // Mengonversi respons menjadi JSON
    })
    .then(function (serverData) {
        // Tangani respons dari server

        // Perbarui data label dan data grafik
        myLineChart.data.labels = serverData.map(function (item) {
            return item.month; // Ubah sesuai dengan nama kolom untuk label
        });
        myLineChart.data.datasets[0].data = serverData.map(function (item) {
            return item.sales; // Ubah sesuai dengan nama kolom untuk nilai
        });

        myLineChart.data.datasets[1].data = serverData.map(function (item) {
            return item.sales_forecast; // Ubah sesuai dengan nama kolom untuk nilai
        });

        // Perbarui grafik
        myLineChart.update();
    })
    .catch(function (error) {
        // Tangani kesalahan jika ada
        console.log(error);
    });

// Setelah melakukan fetch data, inisialisasi grafik batang
var LineChartCanvas = $("#myAreaChart").get(0).getContext("2d");
