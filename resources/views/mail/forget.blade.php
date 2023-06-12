<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    Hi: <br>

    Mude sua senha <a href="http://127.0.0.1:8000/reset/{{$data}}">Clique aqui</a><br>
    Pincode: {{ $data }}
</body>
</html>