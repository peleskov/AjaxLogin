(function () {

    const result = {

        init: function () {

            this.eventSubscription()

        },

        eventSubscription: function () {

            $(document).on('af_complete', $.proxy(this.eventAfComplete, this))
        },

        eventAfComplete: function (event, response) {

            this.cleanDOM(response)
            this.offLibraries(response)
            this.getService(response)

        },

        cleanDOM: function (response) {

            $(response.form).find('.is-invalid').removeClass('is-invalid')
            $(response.form).find('.invalid-feedback').remove()
            $(response.form).find('.alert').hide()

        },

        offLibraries: function (response) {

            response.message = '';

        },

        getService: function (response) {
            let modalID, imageBlock, alertClass
            if ('modalID' in response.data) {
                modalID = response.data.modalID
            }
            if ('imageBlock' in response.data) {
                imageBlock = response.data.imageBlock // блок где должно вставляться изображение
            }
            let service = response.data.service

            const services = {
                'default': function () {
                    let alert = response.form.find('.alert')

                    if (response.data.nPh) {
                        $('.' + imageBlock).attr('src', response.data.nPh)
                    }

                    if (response.data.success) {
                        if (response.data.location){
                            window.location = response.data.location
                        }
                        alertClass = 'alert-success'
                        if (response.data.nPh && imageBlock) {
                            $('.' + imageBlock).attr('src', response.data.nPh)
                        }
                    } else {
                        alertClass = 'alert-danger'
                        $.each(response.data.errors, (i, msg) => {
                            response.form.find('[name="' + i + '"]')
                                .addClass('is-invalid')
                                .after($('<span class="invalid-feedback">' + msg + '</span>'))
                        });
                    }
                    if (modalID) {
                        $('.modal').modal('hide')
                        $('#' + modalID).modal('show')
                    }
                    if (alert && response.data.message) {
                        alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass(alertClass).text(response.data.message)
                    }
                }

            }

            return (services['default'])()

        }
    }

    result.init()

})()