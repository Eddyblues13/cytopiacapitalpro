<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns:v='urn:schemas-microsoft-com:vml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0; maximum-scale=1.0;' />
    <!--[if !mso]-->
    <!-- -->
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel='stylesheet'>
    <!--<![endif]-->

    <title>Withdrawal Approved - cytopia capital pro</title>

    <style type='text/css'>
        /* Your existing CSS styles here */
        body {
            width: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
        }
        /* Include all other styles from your template */
    </style>
</head>

<body class='respond' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'>
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
                                        <a href='{{ config('app.url') }}'
                                            style='display: block; border-style: none !important; border: 0 !important;'>
                                            <img width="10" height="10" border="0"
                                                style="display: block; width: 10px; height: 10px;"
                                                src="{{ asset('assets/img/logo.png') }}" alt="cytopia capital pro" />
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

                            <p>Dear {{ $withdrawal->user->name }},</p>
                            <p>Your withdrawal request has been <strong>approved</strong> with the following details:</p>
                            <ul>
                                <li>Amount: ${{ number_format($withdrawal->amount, 2) }}</li>
                                <li>Payment Method: {{ $withdrawal->account_type }}</li>
                                <li>Status: Approved</li>
                                <li>Date: {{ $withdrawal->updated_at->format('Y-m-d H:i:s') }}</li>
                                <li>Transaction ID: {{ $withdrawal->id }}</li>
                            </ul>
                            <p>The funds should be processed and transferred to your account shortly.</p>
                            <p>If you have any questions, please contact our support team.</p>
                            <p>Thank you for using our service!</p>
                            <p>Kind Regards,<br>cytopia capital pro.</p>
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
                        <td>
                            <table border='0' align='left' cellpadding='0' cellspacing='0' class='container590'>
                                <tr>
                                    <td align='left'
                                        style='color: #aaaaaa; font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;'>
                                        <div style='line-height: 24px;'>
                                            <span style='color: #333333;'>Copyright {{ date('Y') }} - All Rights Reserved</span>
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
                                                    <a style='font-size: 14px; font-family: "Work Sans", Calibri, sans-serif; line-height: 24px;color: #5caad2; text-decoration: none;font-weight:bold;'
                                                        href='{{ config('app.url') }}/unsubscribe'>UNSUBSCRIBE</a>
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