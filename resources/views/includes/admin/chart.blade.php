<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>

</head>
<body>
    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
    <script>
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
           "Dicembre"];
        var yValues = [35, 49, 50, 55, 60, 75, 120, 155, 110, 80, 50, 70];
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
            legend: {display: false},
            title: {
              display: true,
              text: "Numero visualizzazioni"
            }
          }
        });
        </script>
        
</body>
</html>