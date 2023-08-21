<?php
    $con = mysqli_connect("localhost","root","","doanweb2");
    ?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Food', 'Amount'],
          <?php
            $sql="SELECT * FROM tbl_food";
            $fire=mysqli_query($con,$sql);
                while($result=mysqli_fetch_assoc($fire)){
                    echo"['".$result['title']."',".$result['category_id']."]";
                }
          ?>
        ]);

        var options = {
          title: 'Best-selling product statistics'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1000px; height: 500px;"></div>
  </body>
</html>
