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
            let modalID, imageBlock
            if ('modalID' in response.data) {
                modalID = response.data.modalID
            }
            if ('imageBlock' in response.data) {
                imageBlock = response.data.imageBlock // блок где должно вставляться изображение
            }

            let service = response.data.service

            const services = {
                'signup': function () {
                    if (response.success || response.data.success) {
                        if (modalID) {
                            $('.modal').modal('hide')
                            $('#' + modalID).modal('show')
                        }
                        let alert = response.form.find('.alert')
                        alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass('alert-success').text(response.message)
                    } else {
                        $.each(response.data.errors, (i, msg) => {
                            response.form.find('[name="' + i + '"]')
                                .addClass('is-invalid')
                                .after($('<span class="invalid-feedback">' + msg + '</span>'))
                        });
                    }
                },
                'login': function () {

                    if (response.success || response.data.success) {
                        window.location = response.data.location
                    } else {
                        let alert = response.form.find('.alert')
                        alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass('alert-error').text(response.message)

                        response.form.find('[name="username"]').addClass('is-invalid')
                        response.form.find('[name="password"]')
                            .addClass('is-invalid')
                            .after($('<span class="invalid-feedback">' + (response.message || 'Некорректный логин или пароль.') + '</span>'))
                    }

                },
                'forgotpass': function () {

                    if (response.success || response.data.success) {
                        if (modalID) {
                            $('.modal').modal('hide')
                            $('#' + modalID).modal('show')
                        }
                    } else {
                        let alert = response.form.find('.alert')
                        alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass('alert-error').text(response.message)
                        
                        $.each(response.data.errors, (i, msg) => {
                            response.form.find('[name="' + i + '"]')
                                .addClass('is-invalid')
                                .after($('<span class="invalid-feedback">' + msg + '</span>'))
                        });
                    }

                },
                'changepass': function () {

                    if (response.success || response.data.success) {
                        if (modalID) {
                            $('.modal').modal('hide')
                            $('#' + modalID).modal('show')
                        }

                        let alert = response.form.find('.alert')
                        alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass('alert-success').text(response.message)

                    } else {
                        response.form.find('.alert').show().addClass('alert-error').text(response.message)
                        $.each(response.data.errors, (i, msg) => {
                            response.form.find('[name="' + i + '"]')
                                .addClass('is-invalid')
                                .after($('<span class="invalid-feedback">' + msg + '</span>'))
                        });
                    }

                },
                'updateprof': function () {

                    if (response.success || response.data.success) {
                        if (response.data.nPh) {
                            if (modalID) {
                                $('.modal').modal('hide')
                                $('#' + modalID).modal('show')
                            }
   
                            let alert = response.form.find('.alert')
                            alert.show().attr('class', alert.attr('class').replace(/\balert-\w*\b/g, '')).addClass('alert-success').text(response.message)

                            // Замена изображения
                            $('.' + imageBlock).attr('src', response.data.nPh)
                        } else {
                            console.log('Произошла непредвиведдая ошибка!')
                        }

                    } else {
                        response.form.find('.alert').show().addClass('alert-error').text(response.message)
                        $.each(response.data.errors, (i, msg) => {
                            response.form.find('[name="' + i + '"]')
                                .addClass('is-invalid')
                                .after($('<span class="invalid-feedback">' + msg + '</span>'))
                        });
                    }

                },
                'default': 'service not found!'

            }

            return (services[service] || services['default'])()

        }
    }

    result.init()

})()