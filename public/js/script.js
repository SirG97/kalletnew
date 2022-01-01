document.addEventListener('DOMContentLoaded', (event) => {
    const account = $("#account_number");
    account.on('keyup', () => {
        const account_number = account.val();
        if (account_number.length >= 10) {
            resolveAccountNumber();
        }
    });

    $("#bank").on('change', () => {
        if (account.val() !== '' && account.val().length >= 10) {
            resolveAccountNumber();
        }
    });

    function resolveAccountNumber() {
        account.attr('readonly', true);
        let d = new FormData();

        // d.append('_token', $('#token').data('token'));
        d.append('account_number', $('#account_number').val());
        d.append('bank', $('#bank').val());
        d.append('_token',  $('meta[name="csrf-token"]').attr('content'));
        $.ajax({
            url: '/account/resolve',
            type: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: d,
            beforeSend: function () {
                $('#accountHelpText').html(`<span class="text-primary">Resolving account number. Please wait... <span class="fas fa-circle-notch fa-spin"></span></i>`);
            },
            success: function (response) {
                account.attr('readonly', false);

                // console.log(response);
                if (response.status == 'success') {
                    $('#accountHelpText').html(`<span class="text-success">Success! ${response.message}</span>`);
                    $('#account_name').val(response.data.account_name);
                    $('#bank_name').val($('#bank option:selected').text());
                    $('#accountSaveBtn').attr('disabled', false);
                } else {
                    $('#accountHelpText').html(`<span class="text-danger">${response.message}</span>`);
                    $('#account_name').val('');
                    $('#accountSaveBtn').attr('disabled', true);
                }
            },
            error: function (request, error) {
                account.attr('readonly', false);
                $('#accountHelpText').html(`<span class="text-danger">Sorry! an error occurred, please try again</span>`);
                $('#account_name').val('');
                $('#accountSaveBtn').attr('disabled', true);
            }
        });
    }

});
