$(document).ready(function (e) {
    $("form").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
            url: "/HealthNet/recuperar.php",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                var blob = new Blob([data], {type: "text/plain;charset=utf-8"});
                saveAs(blob, "arquivo.txt");
                $("form")[0].reset(); 
            },
            error: function(e){
                console.warn('Erro ao recuperar arquivo');
            }
        });
    }));
});