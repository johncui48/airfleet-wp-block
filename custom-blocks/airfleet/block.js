$(document).ready(function () {
    $('.readmore-btn').click(function () {
        $( this ).parent().next().css("display", "block");
        $( this ).parent().hide();
    });
})