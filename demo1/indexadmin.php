<?php
session_start();
if(!isset($_SESSION['uid'])){
    header('location: loginpage.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<title>My profile </title>


<head>
    <title>LogInPageAdmin</title>
    <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="indexadmin.js"></script>
    <link rel="stylesheet" href="indexadmin.css">
   <!--  <script type="text/javascript" src="map.js"></script> -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js"></script>
    <script src="js/vendor/jquery.ui.widget.js"></script>
    <script src="js/jquery.iframe-transport.js"></script>
<!--    <script src="js/jquery.fileupload.js"></script>-->
<!--    <script src="upload.js"></script>-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>







</head>
<body background="images/rio.jpg">
<header>
    <nav>
        <a class="welcomemsg">Welcome back Admin</a>
        <button onclick="adminFunction()" id="switch">MapPage</button>
        <a id="logout"  href="logout.php">Logout</a>
    </nav>
</header>

<main>

    <div id="dashboard" style="display: inline">

        <h1>There are the diagrams for some data</h1>
        <div class="dashboard-left">

             <div class="diagram-left" id="user_div" style="border: 1px solid #ccc; "></div>

             <div class="diagram-left" id="month_div" style="border: 1px solid #ccc; "></div>

              <div class="diagram-left" id="hour_div" style="border: 1px solid #ccc; "></div>
        </div>

        <div class="dashboard-right">

            <div class="diagram-right" id="activity_div" style="border: 1px solid #ccc; "></div>

            <div class="diagram-right" id="day_div" style="border: 1px solid #ccc; "></div>

            <div class="diagram-right" id="year_div" style="border: 1px solid #ccc; "></div>
        </div>


    </div>

    <div id="mapcontainer" style="display: none">
        <script>
            function adminFunction() {
                let x = document.getElementById("mapcontainer");
                let y = document.getElementById("dashboard");
                if(x.style.display === 'none'){
                    x.style.display = 'inline';
                    y.style.display = 'none';
                    document.getElementById('switch').innerHTML = 'Dashboard';

                }else{
                    x.style.display = 'none';
                    y.style.display = 'inline';
                    document.getElementById('switch').innerHTML = 'Map Page';

                }

            }
        </script>

        <div id="mapid"></div>
    
        <script type="text/javascript" src="mapadmin.js"></script>
        <div id="adminform" >
        	<form name="heatmapadmin" id="heatmapadmin" >
        		<label for="datepicker" name="date_range">Pick your desired daterange</label>
			        <div id="datepicker">
			        	<input type="text" name="datetimefilter" id="datetimefilter"  value=""/>
                        <script type="text/javascript">
                            $(function() {

                                $('input[name="datetimefilter"]').daterangepicker({
                                    timePicker: true,
                                    timePicker24Hour:true,
                                    autoUpdateInput: false,
                                    locale: {
                                        cancelLabel: 'Clear'
                                    }
                                });

                                $('input[name="datetimefilter"]').on('apply.daterangepicker', function(ev, picker) {
                                    $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm:ss') + ' - ' + picker.endDate.format('DD-MM-YYYY HH:mm:ss'));
                                });

                                $('input[name="datetimefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                                    $(this).val('');
                                });

                            });
                        </script>
            

        		<label for="type" name="date">Pick your desired activity</label>
        		<select id="type" name="type">
        			<option value="WALKING">WALKING</option>
        			<option value="RUNNING">RUNNING</option>
        			<option value="STILL">STILL</option>
        			<option value="IN_VEHICLE">IN VEHICLE</option>
        			<option value="ON_BICYCLE">ON BICYCLE</option>
                    <option value="ON_FOOT">ON FOOT</option>
                    <option value="ALL">ALL TYPES</option>
        		</select><br>
                <button type="button" name="sumbithmadmin"  onclick="submitform()">See your Heatmap</button>
                <button type="button" name="export" onclick="submitexport()" >Export</button>
            </form>
<!--            <script type="text/javascript"  src="export.js"></script>-->
<!--            <label for="db">Export or Delete DataBase</label>-->
<!--            <button id="export  name="export">EXPORT</button>-->

        </div>


        		<button type="button" name="delete" id="delete">DELETE</button>
                <p style="color: aliceblue"  id="message" ></p>
                <script type="text/javascript"  src="delete_dp.js"></script>

    </div>
    </div>




</main>




</body>

</html>

