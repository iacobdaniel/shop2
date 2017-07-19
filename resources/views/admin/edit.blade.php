<?php
use Illuminate\Support\Facades\Input;
?>

@extends ('layout')

@section ('page_title')
    <title>Shop2 - Edit product</title>
@endsection

@section ('content')
    <h1>Shop2 - Edit <?= " " ?></h1>
    <form action="/update" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="<?= $product->id ?>">
        <label for="name">Name</label>
        <br>
        <input required type="text" name="name" value="<?= Input::old('name') ? Input::old('name') : $product->name ?>">
        <br>
        <br>
        <label for="price">Price</label>
        <br>
        <input required type="number" name="price" value="<?= Input::old('price') ? Input::old('price') : $product->price ?>">
        <br>
        <br>
        <label for="description">Description</label>
        <br>
        <textarea required type="text" name="description"><?= Input::old('description') ? Input::old('description') : $product->description ?></textarea>
        <br>
        <br>
        <image src="<?= empty(glob('images/' . $product->id . '.*')) ? '/images/0.png' : '/' . glob('images/' . $product->id . '.*')[0] ?>" />
        <br>
        <label for="image">Upload image (only PNG or JPEG/JPG file types with a maximum dimension of 200kB)</label>
        <br>
        <input type="file" name="image_upload" id="image_upload">
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