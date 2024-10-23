<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Whisper</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4a90e2;
            padding: 20px;
            text-align: center;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
            text-align: center;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .code {
            display: inline-block;
            background-color: #f1f1f1;
            border-radius: 6px;
            padding: 10px 20px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 20px 0;
            color: #4a90e2;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
            color: #777777;
            font-size: 14px;
        }
        .footer a {
            color: #4a90e2;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        Whisper - Email Verification
    </div>
    <div class="content">
        <p>Hello,</p>
        <p>Thank you for signing up with <strong>Whisper</strong>! Please use the following code to verify your email address:</p>
        <div class="code">{{ $code }}</div>
        <p>If you didn’t request this, you can safely ignore this email.</p>
        <p>Thank you!<br>The <a href="https://whisper.epicmaze.ir" target="_blank">Whisper</a> Team</p>
    </div>
    <div class="footer">
        © 2024 Whisper. All rights reserved. | <a href="#">Privacy Policy</a>
    </div>
</div>
</body>
</html>
