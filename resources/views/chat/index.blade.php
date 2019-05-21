<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<ul class="chat">
    @foreach($messages as $message)
        <li>
            <b>{{$message->author}}</b>
            <p>{{$message->content}}</p>
        </li>
    @endforeach
</ul>
<hr>
<form action="/chat/message" method="POST">
    <input type="text" name="author" >
    <input type="text" name="content">
    <input type="submit" value="Send">
</form>
<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
<script>
    var socket = io(':6379');
    socket.on('message',function (data) {
        console.log(data);
    })
</script>
</body>
</html>