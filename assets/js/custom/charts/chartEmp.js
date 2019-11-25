// Load the Visualization API and the line package.
google.charts.load('current', {'packages': ['corechart']
});
// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(pie_emp);

function pie_emp() {
    $.ajax({
        type: 'POST',
        url: baseurl + 'employee/getcount',
        success: function (data1) {
            var data = new google.visualization.DataTable();
            // Add legends with data type
            data.addColumn('string', 'name');
            data.addColumn('number', 'count');
            //Parse data into Json
            var jsonData = $.parseJSON(data1);
            for (var i = 0; i < jsonData.length; i++) {
                data.addRow([jsonData[i].name, parseInt(jsonData[i].count)]);
            }

            var options = {
                'legend': 'bottom',
                is3D: true,
                // pieSliceText: 'value-and-percentage',
                // legend: { position: 'labeled' },
                // backgroundColor: 'transparent'
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_emp'));
            chart.draw(data, options);
        }
    });
}
$(window).resize(function () {
    pie_emp();
});