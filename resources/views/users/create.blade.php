<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create user</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<main class="app-container">
    <h1 class="title">Create a user</h1>
    <form action="create-submit" method="POST">
        @csrf
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" placeholder="Please input the new users name">
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" placeholder="Please input the new users email">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Please input the new users email">
        <label for="isAdmin">Admin: </label>
        <select name="isAdmin" id="isAdmin">
            <option value="0" selected>No</option>
            <option value="1">Yes</option>
        </select>
        <button>Create user</button>
    </form>
</main>
</body>
</html>
