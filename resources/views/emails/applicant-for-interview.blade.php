<!DOCTYPE html>
<html>
<head>
    <title>Interview Invitation Email</title>
    <style>
        .paragraph1{
            margin-top: 20px;
            margin-bottom: 20px; 
        }
        .paragraph2{
            margin-bottom: 0;
        }
        .paragraph3{
            margin-top: 0;
            margin-bottom: 20px; 
        }
        .warm{
            margin-bottom: 0;
        }
        .real{
            margin-top: 0;
        }

    </style>
</head>
<body>
    <p>Dear {{ $firstName }},</p>

    <p class="under">{!! preg_replace('/(?<!\n)\n(?!\n)/', '<br>', preg_replace('/\n{2,}/', '<br><br>', nl2br(strip_tags($interviewContent, '<strong><p><br><u>e&nbsp;')))) !!}</p>
</body>
</html>
