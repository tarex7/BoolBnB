<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

</head>

<body>
    <div class="container">
        <canvas id="myChart" style="width:100%;max-width:700px;height: 350px"></canvas>
        <script>
            for (var a = [], i = 0; i < 201; ++i) a[i] = i;

            // http://stackoverflow.com/questions/962802#962890
            function shuffle(array) {
                var tmp, current, top = array.length;
                if (top)
                    while (--top) {
                        current = Math.floor(Math.random() * (top + 1));
                        tmp = array[current];
                        array[current] = array[top];
                        array[top] = tmp;
                    }
                return array;
            }

            a = shuffle(a);

            var xValues = [
                "Gennaio",
                "Febbraio",
                "Marzo",
                "Aprile",
                "Maggio",
                "Giugno",
                "Luglio",
                "Agosto",
                "Settembre",
                "Ottobre",
                "Novembre",
                "Dicembre"
            ];
            var yValues = a;
            var barColors = ["red",
                "green",
                "blue",
                "orange",
                "brown",
                "purple",
                "yellow",
                "lightblue",
                "coral",
                "cornflowerBlue",
                "darkOrchid",
                "gold",
            ];

            new Chart("myChart", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Numero visualizzazioni"
                    }
                }
            });
        </script>

    </div>
</body>

</html>
