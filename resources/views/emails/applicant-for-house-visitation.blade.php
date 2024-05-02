<!DOCTYPE html>
<html>
<head>
    <title>House Visitation Invitation Email</title>
    <style>
        .warm {
            margin: 0;
        }
        .paragraph3{
            margin-top: 0;
        }
        .paragraph2{
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <p>Dear {{ $firstName }},</p>
    <p class="under">{!! preg_replace('/(?<!\n)\n(?!\n)/', '<br>', preg_replace('/\n{2,}/', '<br><br>', nl2br(strip_tags($houseVisitationContent, '<strong><p><br><u>e&nbsp;')))) !!}</p>
</body>
</html>
