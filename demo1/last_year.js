google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var jsonData = $.ajax({
        url:"eco_year.php",
        dataType: "json",
        async: false
    }).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var options = {
        title: 'Your scores this last year',
        curveType: 'function',
        legend: { position: 'bottom' }
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
}

