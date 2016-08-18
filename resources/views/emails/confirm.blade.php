<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Mail Confirmation</title>
</head>
<body>
    <h1>Thank you for joining us!</h1>

    <p>
        Now you must <a href="{{ url('register/confirm', ['code' => $newUser->confirmation_code]) }}">confirm your E-Mail Address</a>!
    </p>
    <br>
    <a href="{{ url('register/confirm', ['code' => $newUser->confirmation_code]) }}">{{ url('register/confirm', ['code' => $newUser->confirmation_code]) }}</a>
</body>
</html>