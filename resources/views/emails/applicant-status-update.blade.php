<!DOCTYPE html>
<html>
<head>
    <title>Update on Your Application Status</title>
</head>
<body>
    <h2>Application Status Update</h2>
    <p>Hello {{ $applicant->first_name }} {{ $applicant->last_name }},</p>
    <p>Your application status has been updated to: {{ $applicant->status }}</p>
    <p>Thank you!</p>
</body>
</html>