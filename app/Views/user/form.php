<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add User</title>
</head>
<body>
	<h1>Add New User</h1>
	<form action="/users/store" method="POST">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name">
		<br>
		<label for="email">Email:</label>
		<input type="text" name="email" id="email">
		<br>
		<label for="password">Password:</label>
		<input type="password" name="password" id="password">
		<br>
		<label for="password_confirmation">Confirm Password:</label>
		<input type="password" name="password_confirmation" id="password_confirmation">
		<br>
		<button type="submit">Submit</button>
	</form>
</body>
</html>
