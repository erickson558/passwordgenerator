(function ($) {
    $(function () {
        var toast = new bootstrap.Toast($('#toastCopy'));
        var endpoint = 'api/password.php';

        $('#generateBtn').on('click', function () {
            var len = $('#lengthSelect').val();

            $(this).prop('disabled', true).removeClass('animate__pulse');
            $('#password').removeClass('animate__fadeIn').addClass('animate__fadeOut');

            $.getJSON(endpoint + '?length=' + encodeURIComponent(len), function (data) {
                $('#password')
                    .val(data.password)
                    .removeClass('animate__fadeOut')
                    .addClass('animate__fadeIn');

                if (data.version) {
                    $('#appVersion').text(data.version);
                }

                $('#copyBtn').prop('disabled', false);
            }).always(function () {
                $('#generateBtn').prop('disabled', false).addClass('animate__pulse');
            });
        });

        $('#copyBtn').on('click', function () {
            var txt = $('#password').val();

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(txt).then(function () {
                    toast.show();
                }, function () {
                    fallbackCopy(txt);
                });
            } else {
                fallbackCopy(txt);
            }
        });

        function fallbackCopy(text) {
            var ta = $('<textarea>').appendTo('body').val(text).select();
            document.execCommand('copy');
            ta.remove();
            toast.show();
        }
    });
})(jQuery);
