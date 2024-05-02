<!DOCTYPE html>
<html>
<head>
    <title>Under Review Email</title>
    <style>
        .under {
            margin-top: 0;
            margin-bottom: 20px;
        }
        .warm1{
            margin-bottom: 0; 
        }
        .warm2{
            margin-bottom: 0; 
            margin-top: 0;
        }
        .under2{
            margin-bottom: 20px;
        }
        .under3{
            margin-bottom: 20px;
        }
        .under4{
            margin-bottom: 0;
            margin-top: 0;
        }
        .under5{
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <p>Dear {{ $firstName }},</p>
    <p class="under">{!! preg_replace('/(?<!\n)\n(?!\n)/', '<br>', preg_replace('/\n{2,}/', '<br><br>', nl2br(strip_tags($declineContent, '<strong><p><br><u>e&nbsp;')))) !!}</p>
</body>
</html>
