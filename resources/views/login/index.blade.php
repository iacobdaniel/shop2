@extends ('layout')

@section ('page_title')
    <title>Shop2 - Login</title>
@endsection

@section ('content')
    <h1>Shop2 - Login</h1>
    <p>
        <a href="/">Go to frontend</a>
    </p>
    <?= $error ? '<p class="file_upload_error_notif">The username or password are incorrect</p>' : '' ?>
    <form action="/login" method="post">
        {{ csrf_field() }}
        <label for="user">Username: </label>
        <input type="text" name="user">
        <br>
        <br>
        <label for="password">Password: </label>
        <input type="password" name="password">
        <br>
        <br>
        <button type="submit">Login</button>
    </form>
@endsection