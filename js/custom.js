$(function() {
    $(".dropdown-trigger").dropdown();

    $(".close-alert").click(function() {
        $(this).parent().fadeOut(500);
    });
});