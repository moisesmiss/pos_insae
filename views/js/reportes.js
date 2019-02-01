/*=========================================
=            formatear numeros            =
=========================================*/

(function(){
    $('.count').number(true);
})();


/*=====  End of formatear numeros  ======*/


/*========================================
=            NUMERO DE VENTAS            =
========================================*/

var divGraficaVentas = document.getElementById("graficaVentas").getContext('2d');
function imprimirGraficaVentas(data){
    $.ajax({
        url: 'ajax/reportes.ajax.php?action=filtro-ventas',
        type: 'POST',
        dataType: 'json',
        data: data,
    })
    .done(function(r) {
        // console.log("success",r);  
        //dar formato a los meses  
        if(moment(r.labels[0], 'MM/YYYY', true).isValid()){
            for(var i = 0; i < r.labels.length; i++){
                r.labels[i] = moment(r.labels[i], 'MM/YYYY').format('MMM');
            }

        }
        var myChart = new Chart(divGraficaVentas, {
            type: 'line',
            data: {
                labels: r.labels,
                datasets: [{
                    label: '# de ventas',
                    data: r.data,
                    backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:false
                        }
                    }]
                }
            }
        });
    })
    .fail(function(r) {
        console.log("error", r.responseText);
    }); 
}
imprimirGraficaVentas();

$(".filtro-ventas").on('change', function(){
    var month = $('#filtroMonthVentas').val();
    var year = $('#filtroYearVentas').val();
    var data = {
        month : month,
        year : year,
    };

    imprimirGraficaVentas(data);

});

/*=====  End of NUMERO DE VENTAS  ======*/

