<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <h1>Welcome to Home Page!</h1>
    <p><?= $message ?? 'No message available.' ?></p>
    
    <form action="/users/store" method="POST">
        <label for="name">
            <span>
                Enter your message:
            </span>
            <input type="text" id="name" name="message" placeholder="Enter your message">
        </label>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
