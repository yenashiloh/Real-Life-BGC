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
            </style>
        </head>
        <body>
            <p>Dear {{ $firstName }},</p>
            <p class="under">{!! preg_replace('/(?<!\n)\n(?!\n)/', '<br>', preg_replace('/\n{2,}/', '<br><br>', nl2br(strip_tags($underReviewContent, '<strong><p><br><u>e&nbsp;')))) !!}</p>



    </body>
    </html>
