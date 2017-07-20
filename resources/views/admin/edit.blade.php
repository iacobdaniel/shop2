<?php
use Illuminate\Support\Facades\Input;

$name = Input::old('name');
$price = Input::old('price');
$description = Input::old('description');
?>

@extends ('layout')

@section ('page_title')
    <title>Shop2 - <?= $prod_exist ? "Edit product " . $product->name : "Add product" ?></title>
@endsection

@section ('content')
    <h1>Shop2 - <?= $prod_exist ? "Edit product " . $product->name : "Add product" ?></h1>
    <form action="/save" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="<?= $prod_exist ? $product->id : '0' ?>">
        <label for="name">Name</label>
        <br>
        <input required type="text" name="name" value="<?= isset($name) ? $name : ($prod_exist ? $product->name : '') ?>">
        <br>
        <br>
        <label for="price">Price</label>
        <br>
        <input required type="number" name="price" value="<?= isset($price) ? $price : ($prod_exist ? $product->price : '') ?>">
        <br>
        <br>
        <label for="description">Description</label>
        <br>
        <textarea required type="text" name="description"><?= isset($description) ? $description : ($prod_exist ? $product->description : '') ?></textarea>
        <br>
        <br>
        <?php if($prod_exist): ?>
        <image src="<?= empty(glob('images/' . $product->id . '.*')) ? '/images/0.png' : '/' . glob('images/' . $product->id . '.*')[0] ?>" />
        <?php endif; ?>
        <br>
        <label for="image">
            Upload image (only PNG or JPEG/JPG file types with a maximum dimension of 200kB)
            <?= $prod_exist ? '' : '<br><span style="color: red;">Product image is required for new products!</span>' ?>
        </label>
        <br>
        <input <?= $prod_exist ? '' : 'required' ?> type="file" name="image_upload" id="image_upload">
        <br>
        <br>
        <button class="add_to_cart_btn" type="submit"><?= $prod_exist ? 'Save' : 'Add' ?></button>
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