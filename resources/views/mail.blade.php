<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h3>Thank you for registering </h3>

        <div>
            <div>Please click 
            <a href="{{ route('verify', ['id'=> $user->id]) }}">here</a>    
            to verify your email </div>
        </div>
    </div>
</body>
</html>