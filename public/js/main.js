$(document).ready(function()
{
    $('form.ajax').submit(function()
    {
        
        return false;
    });

    if ($('#login-window').length > 0)
    {
        $('.login').click(function()
        {
            $('#login-window').modal('show');
            return false;
        });
    }

    $('.modal').on('shown.bs.modal', function() {
        $(this).find('[autofocus]').focus();
    });
});

