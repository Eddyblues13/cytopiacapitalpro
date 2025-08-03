<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cytopia capital pro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 10px;
            border-bottom: 3px solid #007bff;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            color: #333;
        }

        .footer {
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            color: white;
            background: #007bff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/menu/logo/1.png') }}" alt="Company Logo">
        </div>
        <div class="content">
            <p>Dear User,</p>
            <p>{!! nl2br(e($messageBody)) !!}</p>
            <p>Best Regards,</p>
            <p><strong>cytopia capital pro</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} cytopia capital pro. All rights reserved.</p>
        </div>
    </div>
</body>

</html>