<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<h4> {{$subject }} </h4>
	<p><b> {{$msg}} </b></p>
	<p>От: <b>{{Auth::user()->name}}</b> {{Auth::user()->email}} 	 </p>
	
</body>
</html>