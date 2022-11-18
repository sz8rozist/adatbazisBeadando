window.onload = function() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET','chart.php');
    xhr.send();
    xhr.onload = () => {
        const data = JSON.parse(xhr.response);
        var osztaly = [];
        var count = [];
        var color = [];

        if(data.dolgozo_count_osztaly.length > 0){
            for(var i = 0; i < data.dolgozo_count_osztaly.length; i++)
            {
                osztaly.push(data.dolgozo_count_osztaly[i].osztaly);
                count.push(data.dolgozo_count_osztaly[i].dolgozo);
                color.push(data.dolgozo_count_osztaly[i].color);
            }

            var graph1 = new Chart(document.getElementById("pie_chart"), {
                type:"pie",
                data:{
                    labels:osztaly,
                    datasets:[
                        {
                            backgroundColor:color,
                            color:'#fff',
                            data:count
                        }
                    ]
                },
                options: {
                    aspectRatio:1,
                    maintainAspectRatio: false,
                }
            });
        }else{
            // Appendelni kell ha nincs adat.
        }

        if(data.projekt_ar_osztaly.length > 0){
            var osztaly2 = [];
            var count2 = [];
            var color2 = [];

            for(var i = 0; i < data.projekt_ar_osztaly.length; i++)
            {
                osztaly2.push(data.projekt_ar_osztaly[i].osztaly);
                count2.push(data.projekt_ar_osztaly[i].projekt_ar);
                color2.push(data.projekt_ar_osztaly[i].color);
            }

            var graph2 = new Chart(document.getElementById("bar_chart"), {
                type: 'polarArea',
                data: {
                    labels: osztaly2,
                    datasets: [{
                        label: "",
                        data: count2,
                        backgroundColor: color2,
                        borderColor: color2,
                        borderWidth: 1
                    }]
                },
                options: {
                    aspectRatio:1,
                    maintainAspectRatio: false,
                }
            });
        }else{
            // Appendelni kell hogy nincs adat
        }

    }
}