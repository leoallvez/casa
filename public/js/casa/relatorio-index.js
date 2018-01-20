$(document).ready(function () {

    $("#periodo_inicio").html(reformatDate($("#data_inicio").val()));
    $("#periodo_fim").html(reformatDate($("#data_fim").val()));
    $("#span_sexo").html($("#sexo option:selected").text());
    $("#span_status").html($("#status option:selected").text());
    $("#span_etnia").html($("#etnia option:selected").text());
    $("#span_idade").html($("#idade option:selected").text());
});

function reformatDate(dateStr) {
    dArr = dateStr.split("-"); // ex input "2010-01-18"
    return dArr[2] + "/" + dArr[1] + "/" + dArr[0]; //ex out: "18/01/10"
}

function print(button) {
    var button = $(button);
    $("#display_filtro").show();
    button.hide();
    $("#printing-area").print();
    $("#display_filtro").hide();
    button.show();
}

var dadosStatus = ($('#dadosStatus').val()) ? JSON.parse($('#dadosStatus').val()) : null;
// GRÁFICO DE STATUS DOS ADOTIVOS
if (dadosStatus) {

    Highcharts.chart('grafico-status', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Adotivos por status',
            style: {
                'fontSize': '30px',
                'color': '#00BFFF',
                'fontWeight': 'bold'
            }
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45,
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: 50,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Quantidate de adotivos',
            data: dadosStatus,
            dataLabels: {
                style: {
                    'fontSize': '16px',
                    'fontFamily': 'Verdana'
                }
            }
        }]
    });
}

var dadosSexos = ($('#dadosSexo').val()) ? JSON.parse($('#dadosSexo').val()) : null;
// GRÁFICO DE SEXO DOS ADOTIVOS
if (dadosSexos) {

    Highcharts.chart('grafico-sexo', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0
            }
        },
        tooltip: {
            pointFormat: '<b>{series.name}</b><br><b>{point.y:.1f}%</b>',
        },
        colors: ["#ff0080", "#00bfff"],
        title: {
            text: 'Porcentagem de adotivos por sexo',
            style: {
                'fontSize': '30px',
                'color': '#00BFFF',
                'fontWeight': 'bold',
            }
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45,
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Porcentagem de adotivos por sexo'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        series: [{
            name: 'Porcentagem',
            colorByPoint: true,
            data: dadosSexos,
            dataLabels: {
                style: {
                    'fontSize': '20px',
                    'fontFamily': 'Verdana'
                }
            }
        }]
    });
}

var dadosEtnias = ($('#dadosEtnias').val()) ? JSON.parse($('#dadosEtnias').val()) : null;
// GRÁFICO DE ETNIAS
if (dadosEtnias) {

    Highcharts.chart('grafico-etnias', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: false,
                alpha: 0
            }
        },
        title: {
            text: 'Porcentagem de adotivos por etnias',
            style: {
                'fontSize': '30px',
                'color': '#00BFFF',
                'fontWeight': 'bold',
            }
        },
        subtitle: {
            text: '',
            style: {
                'fontSize': '25px',
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: 20,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        yAxis: {
            title: {
                text: 'Porcentagem por etnias'
            }
        },
        legend: {
            enabled: true
        },
        series: [{
            name: 'Quantidade de adotivos',
            data: dadosEtnias,
            style: {
                'fontSize': '30px'
            },
            dataLabels: {
                style: {
                    'fontSize': '16px',
                    'fontFamily': 'Verdana'
                }
            }
        }]
    });
}