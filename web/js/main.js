$(document).ready(function(){

    //form submit
    $('form').submit(function(){
        $(this).css('opacity', 0.4);
    });

    $('.select2').select2({
        placeholder: "Choisissez une option",
        allowClear: true
    });


    $(".summernote").summernote({
        height: 250,
        focus: false, //set focus editable area after Initialize summernote
    });

    $(".money").mask("99.99", {reverse: true});
    $(".ref").mask("aa-9999-a");
    $(".cp").mask("99999", {reverse: true});
    $(".surface").mask("99.99");
    $(".nbrooms").mask("99");
    $(".bedrooms").mask("99");



});