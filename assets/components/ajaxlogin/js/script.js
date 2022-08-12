$(document).ready(() => {
    /*Mask inputs*/
    if ($('input[type="tel"]').length > 0) {
        $('input[type="tel"]').inputmask("+7 999 999-99-99");
    }
    /*Mask inputs*/

    /*ON/OFF Show password*/
    $('.btn-pwdshow').on('click', (el) => {
        $(el.currentTarget).toggleClass('show')
        if ($(el.currentTarget).prev().attr('type') == 'password') {
            $(el.currentTarget).prev().attr('type', 'text');
        } else {
            $(el.currentTarget).prev().attr('type', 'password');
        }

    });
    /*ON/OFF Show password*/

    /*Custom select*/
    if ($('.custom-select2').length > 0) {
        $('.custom-select2').select2({
            minimumResultsForSearch: -1
        })
            .on("select2:open", function () {
                $('.select2-results__options').addClass('scrollbar-inner').scrollbar();
            });

        $('.custom-select2.multiple').select2({
            minimumResultsForSearch: -1,
            multiple: true
        })
            .on("select2:open", function () {
                $('.select2-results__options').addClass('scrollbar-inner').scrollbar();
            });
    }
    /*Custom select*/

    /*Custom scroll*/
    if ($('.scrollbar-inner').length > 0) {
        $('.scrollbar-inner').scrollbar();
    }
    /*Custom scroll*/


    /*
    $(document).on('af_complete', function (event, response) {
        var form = response.form;
        $(form).find('.is-invalid').removeClass('is-invalid');
        $(form).find('.invalid-feedback').remove();
        if (response.success) {
            $(form).closest('.modal').modal('hide');
            if ($(form).closest('.modal').is('#modalQuestion')) {
                $('#modalSuccessQuestion').modal('show');
            } else {
                $('#modalSuccessMsg').modal('show');
            }
        } else {
            $('#modalErrorMsg').modal('show');
            $.each(response.data, (i, val) => {
                $(form).find('[name="' + i + '"').addClass('is-invalid').after('<span class="invalid-feedback">' + val + '</span>');
            });
    
        }
        response.message = '';
        */
});