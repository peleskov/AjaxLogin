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
});