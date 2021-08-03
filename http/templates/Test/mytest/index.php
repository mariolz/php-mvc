<html>
<head>{{$test}}</head>
<body>
<div>{{$myname}}</div>
{{foreach($memners as $k=>$v)}}
<div>{{$v}}</div>
{{endforeach}}
</body>
</html>