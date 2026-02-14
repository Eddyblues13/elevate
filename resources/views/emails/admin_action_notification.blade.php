<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns:v='urn:schemas-microsoft-com:vml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0; maximum-scale=1.0;' />
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>

    <title>ElevateCapital - Admin Alert</title>

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

        html {
            width: 100%;
        }

        table {
            font-size: 14px;
            border: 0;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .badge-deposit {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-withdrawal {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-plan {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .badge-copy-trade {
            background-color: #fef3c7;
            color: #92400e;
        }

        .detail-row {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-label {
            color: #888888;
            font-size: 13px;
            font-family: "Work Sans", Arial, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: #333333;
            font-size: 15px;
            font-family: "Work Sans", Arial, sans-serif;
            font-weight: 600;
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

<body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>

    <!-- Header with Logo -->
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

    <!-- Action Type Banner -->
    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td align='center'>
                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                    <tr>
                        <td align='center' style='padding: 15px 0;'>
                            @php
                            $badgeClass = match($actionType) {
                            'Deposit' => 'badge-deposit',
                            'Withdrawal' => 'badge-withdrawal',
                            'Plan Purchase' => 'badge-plan',
                            'Copy Trade' => 'badge-copy-trade',
                            default => 'badge-deposit',
                            };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $actionType }}</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Main Content -->
    <table border='0' width='100%' cellpadding='0' cellspacing='0'>
        <tr>
            <td align='center'>
                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                    <tr>
                        <td align="left"
                            style="color: #888888; font-size: 16px; font-family: 'Work Sans', Arial, sans-serif; line-height: 24px; padding: 0 15px;">

                            <p style="color: #333; font-size: 18px; font-weight: 600; margin-bottom: 8px;">Admin
                                Notification</p>
                            <p style="margin-bottom: 20px;">A user has initiated a new <strong style="color: #333;">{{
                                    strtolower($actionType) }}</strong> on the platform. Here are the details:</p>

                            <!-- Amount Highlight -->
                            <table border='0' width='100%' cellpadding='0' cellspacing='0'
                                style="background: #f8f9fa; border-radius: 10px; margin-bottom: 20px;">
                                <tr>
                                    <td align='center' style='padding: 20px;'>
                                        <p
                                            style="color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">
                                            Amount</p>
                                        <p style="color: #333; font-size: 28px; font-weight: 700;">${{
                                            number_format($amount, 2) }}</p>
                                    </td>
                                </tr>
                            </table>

                            <!-- User Details -->
                            <table border='0' width='100%' cellpadding='0' cellspacing='0' style="margin-bottom: 20px;">
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                        <span class="detail-label">User</span><br>
                                        <span class="detail-value">{{ $userName }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                        <span class="detail-label">Email</span><br>
                                        <span class="detail-value">{{ $userEmail }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                        <span class="detail-label">Date &amp; Time</span><br>
                                        <span class="detail-value">{{ $date }}</span>
                                    </td>
                                </tr>

                                @foreach($details as $label => $value)
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #f0f0f0;">
                                        <span class="detail-label">{{ $label }}</span><br>
                                        <span class="detail-value">{{ $value }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                            <p style="margin-bottom: 10px;">Please review this {{ strtolower($actionType) }} in the
                                admin dashboard.</p>

                            <!-- CTA Button -->
                            <table border='0' width='100%' cellpadding='0' cellspacing='0' style="margin: 20px 0;">
                                <tr>
                                    <td align='center'>
                                        <a href="{{ url('/admin/dashboard') }}"
                                            style="display: inline-block; background-color: #6366f1; color: #ffffff; font-family: 'Work Sans', Arial, sans-serif; font-size: 14px; font-weight: 600; text-decoration: none; padding: 12px 30px; border-radius: 8px; letter-spacing: 0.5px;">
                                            Go to Admin Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p>Kind Regards,<br><strong>ElevateCapital System</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='f4f4f4'>
        <tr>
            <td height='25' style='font-size: 25px; line-height: 25px;'>&nbsp;</td>
        </tr>
        <tr>
            <td align='center'>
                <table border='0' align='center' width='590' cellpadding='0' cellspacing='0' class='container590'>
                    <tr>
                        <td>
                            <table border='0' align='left' cellpadding='0' cellspacing='0' class='container590'>
                                <tr>
                                    <td align='left'
                                        style='color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;'>
                                        <div style='line-height: 24px;'>
                                            <span style='color: #333333;'>Copyright {{ date('Y') }} - All Rights
                                                Reserved</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table border='0' align='right' cellpadding='0' cellspacing='0' class='container590'>
                                <tr>
                                    <td align='center'>
                                        <table align='center' border='0' cellpadding='0' cellspacing='0'>
                                            <tr>
                                                <td align='center'>
                                                    <span
                                                        style='font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px; color: #999;'>
                                                        Admin Notification - Do not reply
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
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