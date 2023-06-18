<!DOCTYPE html>
<html>
<head>
    <title>IntroCee Cover Email</title>
    <style>
        body{
            padding: 30px;
            font-family: 'Rubik', sans-serif;
        }

        .bg-light{
            background: rgba(0,0,0,0.05) !important;
        }

        .email-box{
            max-width: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: 10px 10px 40px rgba(0,0,0,0.1);
            margin: 0 auto;
        }

        .email-box .inner{
            padding: 30px;
        }

        .email-box .email-banner{
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .email-box small{
            color: #606060;
            font-style: italic;
        }

        .email-box .button{
            background: #FE6F28;
            border-radius: 5px;
            display: block;
            text-decoration: none;
            color: white;
            padding: 15px 30px;
            font-weight: 700;
            font-size: 18px;
            text-align: center;
            margin-top: 30px;
        }

        .email-box .footer{
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .email-box h1{
            margin: 0;
            font-size: 20px;
            padding-bottom: 20px;
            text-align: center;
        }

    </style>
</head>
<body class="bg-light">
    <div class="email-box">
        <img src="{{ asset('images/email-banner.jpg') }}" class="email-banner" />
        <div class="inner">
            <h1>
                {{ $mailData['title'] }}
            </h1>
            {!! $mailData['body'] !!}
            <a href="{{ $mailData['buttonlink'] }}" class="button">{{ $mailData['buttontext'] }}</a>
        </div>
        <div class="inner bg-light footer">
            <small>If you have any questions, please don't hesitate to email us at <a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a>. We will get back to you as soon as possible.</small>
        </div>
    </div>
</body>
</html>
