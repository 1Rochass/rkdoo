<!DOCTYPE html>
<html>
<head>
	<title>Poloz</title>
	<link rel="stylesheet" href="http://bootstraptema.ru/plugins/2015/bootstrap3/bootstrap.min.css" />
    <link type="text/css" rel="StyleSheet" href="http://bootstraptema.ru/plugins/2016/shieldui/style.css" />
    <script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
    <script src="http://bootstraptema.ru/plugins/2016/shieldui/script.js"></script>
</head>
<body>
<center><h1>Kvorkin</h1></center>



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- График -->
            <div id="chart">
                     <script>
                         $(document).ready(function () {
                         $("#chart").shieldChart({
                         theme: "light",
                         primaryHeader: {
                         text: "Место в очереди"
                         },
                         exportOptions: {
                         image: false,
                         print: false
                         },
                         axisX: {

                         // categoricalValues: ["2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014"]
                         categoricalValues: [
                         <?php foreach ($data['grafic'] as $key => $value): ?>
                            
                                 <?php echo "\"" . $value['dateOfRecord'] . "\","?>
                            
                         <?php endforeach ?>]

                         },
                         tooltipSettings: {
                         chartBound: true,
                         axisMarkers: {
                         enabled: false,
                         mode: 'xy'
                         } 
                         },
                         dataSeries: [{
                         seriesType: 'line',
                         collectionAlias: "Место в очереди",
                         //data: [8,12,13,15,28,33,44,55,66,77,88,99,00]
                         data: [
                         <?php foreach ($data['grafic'] as $key => $value) {
                             echo $value['numberInQueue'] . ",";
                         } ?>
                         ]
                         }]
                         });
                         });
                     </script><!-- /.График --> 
        </div><!-- /.col-md-8 col-md-offset-2 -->
    </div><!-- /.row -->
</div><!-- /.container -->

<br><br><br> <!-- Отступ -->
<div id="table">
    <div id="alert" class="alert alert-warning" role="alert">
      Таблица группы 3-4 года
    </div>
    <?php 
        // Show children from 3_4 group
        foreach ($data['group3_4'] as $key => $value) {

                echo "<table id='group3_4' class='table'>"; // Table
                echo "<thead>
                    <tr>
                      <th scope='col'>№</th>
                      <th scope='col'>dateOfRecord</th>
                      <th scope='col'>queue</th>
                      <th scope='col'>applicationNumber</th>
                      <th scope='col'>applicationStatus</th>
                      <th scope='col'>facilities</th>
                      <th scope='col'>dateOfBirth</th>
                      <th scope='col'>dateOfRegistration</th>
                    </tr>
                  </thead>";

                foreach ($value as $key => $val) {      
                    echo "<tr>"; // Table

                    // Highlight our child
                    $end = end($data['grafic']); // Last record in db
                    if ($key+1 == $end['numberInQueue']) {
                        $key += 1; // Because "<td><b>" . $key+1 != numeric
                        echo "<td><b>" . $key . "</b></td>"; // + 1 because people must count from 1 and not from 0
                        echo "<td><b>" . $val['dateOfRecord'] . "</b></td>";
                        echo "<td><b>" . $val['queue']. "</b></td>";
                        echo "<td><b>" . $val['applicationNumber'] . "</b></td>";
                        echo "<td><b>" . $val['applicationStatus']. "</b></td>";
                        echo "<td><b>" . $val['facilities'] . "</b></td>";
                        echo "<td><b>" . $val['dateOfBirth']. "</b></td>";
                        echo "<td><b>" . $val['dateOfRegistration'] . "</b></td>";
                    }
                    else {
                         $key += 1; // Because "<td><b>" . $key+1 != numeric
                        echo "<td>" . $key . "</td>";
                        echo "<td>" . $val['dateOfRecord'] . "</td>"; 
                        echo "<td>" . $val['queue']. "</td>";
                        echo "<td>" . $val['applicationNumber'] . "</td>"; 
                        echo "<td>" . $val['applicationStatus']. "</td>";
                        echo "<td>" . $val['facilities'] . "</td>"; 
                        echo "<td>" . $val['dateOfBirth']. "</td>";
                        echo "<td>" . $val['dateOfRegistration'] . "</td>"; 
                    }

                   

                    echo "<tr>"; // Table
                }
                echo "</table>"; // Table

        }
    ?>
</div>
<?
    // Get last record
    $end = end($data['grafic']);
    echo "Number in queue: " . $end['numberInQueue'];

    // Get all children
    echo "<br>All children: " . count($data['allChildren']);

 ?>


 <!-- JS -->
 <script>
    $(document).ready(function(){
        $("#group3_4").slideUp();

        $(".alert").click(function(){
             $("#group3_4").slideToggle("slow");
        });
    });
 </script>
</body>
</html>