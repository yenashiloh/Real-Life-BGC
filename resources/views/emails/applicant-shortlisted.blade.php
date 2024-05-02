<!DOCTYPE html>
<html>
<head>
    <title>Shortlisted Email</title>
    <style>
        .paragraph{
            margin-bottom: 20px;
        }
        .paragraph1{
            margin-top: 0;
            margin-bottom: 0;
        }
        .paragraph2{
            margin-top: 0;
            margin-bottom: 0;
        }
        .paragraph3{
            margin-top: 20px;
            margin-bottom: 0;
        }
        .paragraph4{
            margin-top: 0;
            margin-bottom: 0;
        }
        .link{
            margin-top: 20px;
            margin-bottom: 20px;
            font-style: italic;
        }
        .warm{
            margin-top: 20px;
            margin-bottom: 0; 
        }
        .paragraph5{
            margin-top: 0; 
        }
    </style>
</head>
<body>
    <p class="paragraph">Dear {{ $firstName }},</p>
    <p class="under">{!! preg_replace('/(?<!\n)\n(?!\n)/', '<br>', preg_replace('/\n{2,}/', '<br><br>', nl2br(strip_tags($shortlistedContent, '<strong><p><br><u>e&nbsp;')))) !!}</p>
</body>
</html>
