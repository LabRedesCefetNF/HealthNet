//https://www.codexworld.com/ajax-file-upload-with-form-data-jquery-php-mysql/

$(document).ready(function (e) {
    $("form").on('submit',(function(e) {
    e.preventDefault();
    $.ajax({
        url: "/HealthNet/armazenar.php",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
            $("form")[0].reset(); 
        },
        error: function(e){
            console.warn('Erro ao armazenar arquivo');
        }
    });
}));
});