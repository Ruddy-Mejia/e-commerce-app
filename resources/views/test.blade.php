<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prueba Apex</title>
    <style>
        body { font-family: sans-serif; padding: 2rem; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

    <h2>Prueba de gráfico</h2>
    <div id="ventas-chart" style="height: 350px;"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Ventas',
                    data: [1000, 2000, 1500, 3000, 2500, 4000]
                }],
                xaxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun']
                },
                title: {
                    text: 'Ventas por mes',
                    align: 'left'
                }
            };

            var chart = new ApexCharts(document.querySelector("#ventas-chart"), options);
            chart.render();
        });
    </script>

</body>
</html>
