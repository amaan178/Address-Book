$(function() {
    $('.datepicker').datepicker({
        minDate: new Date(1900, 1, 1),
        maxDate: new Date(),
        yearRange: 25
    });

    $("#pic").change(function(){
        console.log(this.files[0]);
        if(this.files[0])
        {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = loadImage;
        }
    });

    function loadImage(e) {
        console.log(e);
        $("#temp-pic").attr('src', e.target.result);
    }
    $("#edit-contact-form").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            telephone: {
                required: true,
            },
            birthdate: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            address: {
                required: true,
                minlength: 5
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
});