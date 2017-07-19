@extends ('layout')

@section ('page_title')
    <title>Shop2 - Create</title>
@endsection

@section ('content')
    <h1>Shop2 - Create new product</h1>
    <form action="/create" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <label for="name">Name</label>
        <br>
        <input required type="text" name="name" value="{{ old('name') }}">
        <br>
        <br>
        <label for="price">Price</label>
        <br>
        <input required type="number" name="price" value="{{ old('price') }}">
        <br>
        <br>
        <label for="description">Description</label>
        <br>
        <textarea required type="text" name="description">{{ old('description') }}</textarea>
        <br>
        <br>
        <label for="image">Upload image (only PNG or JPEG/JPG file types with a maximum dimension of 200kB)</label>
        <br>
        <input required type="file" name="image_upload" id="image_upload">
        <br>
        <br>
        <button class="add_to_cart_btn" type="submit">Save</button>
    </form>
    <?php if ($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors->all() as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
@endsection