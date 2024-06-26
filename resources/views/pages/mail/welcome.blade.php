<!DOCTYPE html>
<html>
<head>
    <title>Welcome to YourWebsite!</title>
</head>
<body>
    <h2>Welcome to YourWebsite!</h2>
    <p>Hi {{ $user->name }},</p>
    <p>Thank you for registering an account with us. Here are your login details:</p>
    <ul>
        <li><strong>Email:</strong> {{ $user->email }}</li>

    </ul>
    <p>You can use registed email to recovery your password in case you lost it </p>
    <p>Please keep this information secure and do not share it with anyone.</p>
    <p>If you have any questions or need assistance, feel free to contact our support team.</p>
    <p>Best regards,<br> TREE ONE Website Team</p>
</body>
</html>