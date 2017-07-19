@extends ('layout')

@section ('page_title')
    <title>Shop2 - Login</title>
@endsection

@section ('content')
    <h1>Shop2 - Login</h1>
    <p>
        <a href="/">Go to frontend</a>
    </p>
    <form action="/login" method="post">
        {{ csrf_field() }}
        <label for="user">Username: </label>
        <input required type="text" name="user">
        <br>
        <br>
        <label for="password">Password: </label>
        <input required type="password" name="password">
        <br>
        <br>
        <button type="submit">Login</button>
    </form>
    <?php if ($errors->any() || $error): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors->all() as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
                <?= $error ? '<li>The username or password are incorrect</li>' : '' ?>
            </ul>
        </div>
    <?php endif; ?>
@endsection