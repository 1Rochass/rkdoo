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
                    <!-- <script>
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
                         categoricalValues: ["2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014"]
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
                         data: [8,12,13,15,28,33,44,55,66,77,88,99,00]
                         }]
                         });
                         });
                     </script><!-- /.График --> 
        </div><!-- /.col-md-8 col-md-offset-2 -->
    </div><!-- /.row -->
</div><!-- /.container -->
<?php 

    var_dump($data);

 ?>
</body>
</html>