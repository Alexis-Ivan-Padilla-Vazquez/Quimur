$(function(){
    /* Customer identity hover */
    $('a.customer').hover(function(){
        $('span.blackandwhite-picture', $(this)).hide();
    },function(){
        $('span.blackandwhite-picture', $(this)).show();
    });
})
