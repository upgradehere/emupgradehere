<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Email</title>
</head>

<body style="margin: 0; padding: 0; mso-line-height-rule: exactly; background-color: #f1f1f1;">
    <center style="width: 100%; background-color: #f1f1f1;">
        <div
            style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; font-family: 'Lato', sans-serif; font-size: 15px; line-height: 1.8; color: #333333;">
            <!-- Logo Section -->
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                style="margin: auto; text-align: center;">
                <tr>
                    <td>
                        <h1 style="margin: 0; font-size: 24px; font-weight: 700; color: #248c96;">Em Health</h1>
                        <img src="https://images.weserv.nl/?url=i.imgur.com/lJBUSdZ.png" alt="Em Health"
                            style="width: 50%; max-width: 300px; margin-top: 10px;">
                    </td>
                </tr>
            </table>

            <!-- Content Section -->
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                style="margin: auto; margin-top: 20px; text-align: center;">
                <tr>
                    <td>
                        <h2 style="font-size: 28px; font-weight: 400; color: #000000; margin-bottom: 10px;">Hasil
                            Pemeriksaan MCU</h2>
                        <p style="font-size: 16px; color: #555555; line-height: 1.8;">
                            Halo {{ $data['name'] }}, Hasil pemeriksaan MCU <strong>{{ $data['program'] }}</strong>
                            ({{ $data['company'] }}) Anda sudah tersedia. <br> Silahkan unduh hasil pemeriksaan MCU Anda
                            dibawah.
                        </p>
                        <a href="{{ $data['link'] }}" target="_blank"
                            style="display: inline-block; background-color: #248c96; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 5px; font-size: 16px; margin-top: 20px;">
                            Unduh Hasil
                        </a>
                    </td>
                </tr>
            </table>

            <!-- Footer Section -->
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%"
                style="margin: auto; margin-top: 30px; text-align: center;">
                <tr>
                    <td style="font-size: 14px; color: #777777;">
                        <p style="margin: 0;">&copy; 2025 Em Health | <a href="mcu-emhealth.com"
                                style="color: #248c96; text-decoration: none;">mcu-emhealth.com</a></p>
                    </td>
                </tr>
            </table>
        </div>
    </center>
</body>

</html>
