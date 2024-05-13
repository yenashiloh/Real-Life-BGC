<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incomplete Requirements</title>
</head>
<body style="font-family: Arial, sans-serif;">

    <div>
        @if (!empty($firstName))
            <p>Hi {{ $firstName }},</p>
        @else
            <p>Hi Applicant,</p>
        @endif

        <p>Please submit the following documents on the website:</p>
        <ul>
            @foreach($uncheckedDocumentTypes as $docType)
                <li>{{ $docType }}</li>
            @endforeach
        </ul>
        <p>Thank you.</p>
    </div>

</body>
</html>
