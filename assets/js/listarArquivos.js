var inserirLinhas = function(data){
    var table = $('table');
    var arquivos = JSON.parse(data);

    for(var i = 0; i< arquivos.length; i++){
        var linha = $('<tr/>');

        $('<td/>', {text:arquivos[i].dado}).appendTo(linha);
        $('<td/>', {text:arquivos[i].nome}).appendTo(linha);
        
        var radio = $('<input/>', {type:'radio', name: 'idArquivo', value: arquivos[i].id});
        
        if(i == 0){
            $(radio).attr('checked', 'checked');
        }
        
        $('<td/>').append(radio).appendTo(linha);

        $(table).append(linha);
    }
}

var listarArquivos = function(){
    $.ajax({
        type: "GET",
        url: "/HealthNet/listarArquivos.php",
        success: function(data){
            inserirLinhas(data);
        },
        error: function(e){
            console.warn('Erro ao obter arquivos');
        }
    });
}

$(document).ready(function (e) {
    listarArquivos();
});