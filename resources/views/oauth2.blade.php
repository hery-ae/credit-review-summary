<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ $title ?? config('app.name') }}</title>
    </head>
    <body>

        <script type="text/javascript" src="/js/vendors.bundle.js"></script>
        <script type="text/javascript" src="/js/app.bundle.js"></script>
        <script type="text/javascript">
        $(document).ready( function() {
            $.ajax({
                method: 'GET',
                url: 'https://sso.ccbi.co.id/auth/realms/ccbi/protocol/openid-connect/auth',
                data: {
                    state: '5a33a8ed70dbb047c7836037f9f08863',
                    response_type: 'code',
                    redirect_uri: 'http://devdloan.ccbi.co.id/sso/login',
                    client_id: 'los-service',
                }
            }).done( function(response) {
                alert( "success" );
            });
        });
        </script>
    </body>
</html>
