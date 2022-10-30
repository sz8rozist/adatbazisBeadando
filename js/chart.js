window.onload = function() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET','chart.php');
    xhr.send();
    xhr.onload = () => {
        const data = JSON.parse(xhr.response);
        var osztaly = [];
        var count = [];
        var color = [];

        for(var i = 0; i < data.length; i++)
        {
            osztaly.push(data[i].osztaly);
            count.push(data[i].dolgozo);
            color.push(data[i].color);
        }
        var chart_data = {
            labels:osztaly,
            datasets:[
                {
                    label:'Vote',
                    backgroundColor:color,
                    color:'#fff',
                    data:count
                }
            ]
        };
        var options = {
            responsive:false,
            aspectRatio:1,
            maintainAspectRatio: false,
        };
        var group_chart1 = document.getElementById("pie_chart");

        var graph1 = new Chart(group_chart1, {
            type:"pie",
            data:chart_data,
            options: options
        });

    }
}