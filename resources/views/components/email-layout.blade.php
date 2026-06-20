<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
</head>
<body style="margin:0; style= padding:0; background-color:#cacaca;">
    <table width="100%" style="background:cacaca; padding:20px;">
        <tr>
            <td align="center">

                <!-- Header -->
                <table width="600" style="background:#0d6efd; border-radius:8px 8px 0 0;">
                    <tr>
                        <td align="center" style="padding:24px;">
                            <h1 style="color:#fff; font-size:22px; margin:0;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>
                </table>

                <!-- Body -->
                <table width="600" style="background:#020617; padding:30px; border-radius:0 0 8px 8px;">
                    <tr>
                        <td style="color:#fff; font-size:15px; line-height:1.6;">
                            {{ $slot ?? '' }}
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="padding-top:24px; font-size:12px; color:#888;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
                        </td>
                    </tr>
                </table>

            </td>
          
        </tr>
    
</body>
</html>