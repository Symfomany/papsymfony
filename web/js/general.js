$(document).ready(function(){

    //form submit
    $('form').submit(function(){
        $(this).css('opacity', 0.4);
    });


    $('.timeline-date').each(function() {
        console.log($(this).text());
        //moment($(this).text()).fromNow();
    });

});





