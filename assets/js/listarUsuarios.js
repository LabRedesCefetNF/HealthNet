var inserirSelect = function(data){
    var select = $('#idRelacionado');
    var usuarios = JSON.parse(data);

    for(var i = 0; i< usuarios.length; i++){
        if(i == 0){
            var option = $('<option/>', {value : usuarios[i].id, text: usuarios[i].nome, selected : 'selected'});
        }else{
            var option = $('<option/>', {value : usuarios[i].id, text: usuarios[i].nome});
        }

        $(select).append(option);
    }
}

var listarUsuarios = function(idAtual){
    $.ajax({
        type: "GET",
        url: "/HealthNet/listarUsuarios.php",
        data:  {'id' : idAtual},
        success: function(data){
            inserirSelect(data);
        },
        error: function(e){
            console.warn('Erro ao obter usuarios');
        }
    });
}

$(document).ready(function (e) {
    var idAtual = $('#idDono').val();
    listarUsuarios(idAtual);
});