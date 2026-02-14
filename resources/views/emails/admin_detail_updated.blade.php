<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns:v='urn:schemas-microsoft-com:vml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0; maximum-scale=1.0;' />
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
    <title>ElevateCapital</title>
    <style type='text/css'>
        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
        }

        table {
            font-size: 14px;
            border: 0;
        }

        @media only screen and (max-width: 640px) {
            .container590 {
                width: 440px !important;
            }

            .container580 {
                width: 400px !important;
            }
        }

        @media only screen and (max-width: 479px) {
            .container590 {
                width: 280px !important;
            }

            .container580 {
                width: 260px !important;
            }
        }
    </style>
</head>

<body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
    <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#ffffff'>
        <tr>
            <td align='center'>
                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                    <tr>
                        <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td align='center'>
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td align='center' height='70' style='height:70px;'>
                                        <a href=''
                                            style='display: block; border-style: none !important; border: 0 !important;'>
                                            <img width="10" height="10" border="0"
                                                style="display: block; width: 10px; height: 10px;"
                                                src="{{ asset('assets/img/logo.png') }}" alt="ElevateCapital" />
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td align='center'>
                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                    <tr>
                        <td align="left"
                            style="color: #888888; font-size: 16px; font-family: Arial, sans-serif; line-height: 24px;">

                            <p style="margin-bottom: 16px;">Dear <strong>{{ $adminName }}</strong>,</p>

                            <p style="margin-bottom: 16px;">Your admin account details have been updated. Here are the
                                details:</p>

                            <table border="0" cellpadding="8" cellspacing="0"
                                style="border: 1px solid #e5e7eb; border-radius: 8px; width: 100%; margin-bottom: 16px;">
                                <tr style="background-color: #f9fafb;">
                                    <td
                                        style="font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb; padding: 10px 16px;">
                                        Change Type</td>
                                    <td style="color: #6b7280; border-bottom: 1px solid #e5e7eb; padding: 10px 16px;">{{
                                        $changeType }}</td>
                                </tr>
                                @foreach($changedFields as $field => $value)
                                <tr>
                                    <td
                                        style="font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb; padding: 10px 16px;">
                                        {{ $field }}</td>
                                    <td style="color: #6b7280; border-bottom: 1px solid #e5e7eb; padding: 10px 16px;">{{
                                        $value }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td
                                        style="font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb; padding: 10px 16px;">
                                        Changed By</td>
                                    <td style="color: #6b7280; border-bottom: 1px solid #e5e7eb; padding: 10px 16px;">{{
                                        $changedBy }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 600; color: #374151; padding: 10px 16px;">Date</td>
                                    <td style="color: #6b7280; padding: 10px 16px;">{{ $changeDate }}</td>
                                </tr>
                            </table>

                            <p style="margin-bottom: 16px;">If you did not make this change, please contact the super
                                administrator immediately.</p>

                            <p>Kind Regards,<br>ElevateCapital.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='f4f4f4'>
        <tr>
            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
        </tr>
        <tr>
            <td align='center'>
                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                    <tr>
                        <td align='left'
                            style='color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;'>
                            <span style='color: #333333;'>Copyright {{ date('Y') }} - All Rights Reserved</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
        </tr>
    </table>
</body>

</html>