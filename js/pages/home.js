$(function() {
    $('.modal').modal();

    $('.delete-contact').click(function(){
        var id = $(this).data('id');
        $("#modal-agree-button").attr('href', `delete-contact.php?id=${id}`);
    });
});