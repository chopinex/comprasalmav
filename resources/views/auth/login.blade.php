<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
</head>
<body>
	<form action="/ingresar" method="post">
		@csrf
		email
		<input type="email" name="email">
		password
		<input type="password" name="password">
		<input type="submit" value="Ingresar">
	</form>
</body>
</html>