<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:padding-left="http://www.w3.org/1999/xhtml">
<head>
    <title>Password Reset</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style>
        html,
        body,
        table,
        tbody,
        tr,
        td,
        div,
        p,
        ul,
        ol,
        li,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 0;
            line-height: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-spacing: 0;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        table td {
            border-collapse: collapse;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }
        /* Outermost container in Outlook.com */

        .ReadMsgBody {
            width: 100%;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: Arial;
        }

        h1 {
            font-size: 28px;
            font-weight:normal;
            line-height: 32px;
            padding-top: 10px;
            padding-bottom: 24px;
        }


        h2 {
            font-size: 24px;
            line-height: 28px;
            padding-top: 10px;
            padding-bottom: 20px;
        }

        h3 {
            font-size: 20px;
            line-height: 24px;
            padding-top: 10px;
            padding-bottom: 16px;
        }

        h4 {
            font-size: 18px;
            line-height: 21px;
            padding-top: 10px;
            padding-bottom: 12px;
        }

        h5 {
            font-size: 16px;
            line-height: 21px;
            padding-top: 10px;
            padding-bottom: 8px;
        }

        h6 {
            font-size: 14px;
            line-height: 21px;
            padding-top: 10px;
            padding-bottom: 8px;
        }

        p {
            font-size: 16px;
            line-height: 20px;
            font-family: Georgia, Arial, sans-serif;
        }

        @media all and (max-width: 599px) {
            .container600 {
                width: 100%;
            }
        }
    </style>
</head>
<body style="background-image: url('https://ibb.co/vsL7tfn');">


<table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
    <tr>
        <td width="100%" style="min-width:100%;background-image:url('https://ibb.co/vsL7tfn');padding:10px;">
            <center>
                <table class="container600" cellpadding="0" cellspacing="0" width="600">
                    <tr>
                        <td width="100%" style="text-align:left;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%; ">
                                <tr>
                                    <td width="100%" style="min-width:100%;background-color:whitesmoke; padding:50px; border-style: inset; border-color: #FB8A2E;">
                                        <a href="{{ $home }}"> </a>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%; ">
                                <tr>
                                    <td width="100%" style="min-width:100%;background-color:#F8F7F0;color:#686868;padding:30px;">
                                        <h2 style="font-family:Arial;font-size:36px;line-height:44px;padding-top:10px;padding-bottom:10px; text-align: center">Password Reset</h2>

                                        <br> <p style="text-align:center;">Reset your password by clicking on this <i><a style="color: #FB8A2E;; text-decoration: none" href="{{ $url }}">link.</a> Link expires in 2 hours.</i>
                                        </p>
                                        <br>

                                        <form action="{{$url}}"><input style="background-color: #FB8A2E;;

                                            color: #fafff4;
                                            margin-left: 200px;
                                            margin-top: 30px;
                                            text-align: center;
                                            text-decoration: none;
                                            display: inline-block;
                                            font-size: 20px;
                                            border-radius: 25%;
                                            max-width: 30%;
                                            width: 150px;


                                            cursor: pointer;" type="submit" value="Reset"> </form>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%; background-color: black; ">
                                <tr>
                                    <td width="100%" style="min-width:100%;background-color:#313E46;color:whitesmoke;;padding:30px;">
                                        <p style="font-size:16px;line-height:20px;font-family:Georgia,Arial,sans-serif;text-align:center;">2019 @ COPYRIGHT - <a style="color:#FB8A2E; text-decoration: none" target="_blank" href="{{ $home }}">Christ Light</a> </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
</table>
</body>
</html>
