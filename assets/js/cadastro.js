var cadastrarUsuario = function(){
    var nome = $('#nome').val();
    var senha = $('#senha').val();
    
    var data = {'nome' : nome, 'senha' : senha};

    var jqXHR = $.ajax({
        type: 'POST',
        url: '/HealthNet/cadastro.php',
        data: data,
        success: function(data){
            var blob = new Blob([data], {type: "text/plain;charset=utf-8"});
            saveAs(blob, "privateKey.pem");
        },
        error: function(){
            console.warn('Erro ao gerar a chave');
        }
    });
};
