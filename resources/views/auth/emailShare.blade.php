<!DOCTYPE html>
<html>
<head>
    <title>Invite using Caltimes</title>
</head>
<body>
<h4>{{$name}} share you a list on Caltimes: </h4>
<p>
    </br>
    <a href="{{ $link }}">Click here if you want access list now ({{$status}}).</a>
</p>
<p>
    In case this list is private:
    <a href="{{route('register')}}"> Please create an account to access it. </a>
</p>
</body>
</html>
