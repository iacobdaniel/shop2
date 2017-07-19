@extends ('layout')

@section ('page_title')
    <title>Shop2 - cart</title>
@endsection

@section ('content')
    <h1>Shop2 - Cart</h1>
    <a href="/"><?= translate('Go to homepage') ?></a>
    <?php if($prod_exist): ?>
    <table class="table product_table">
        <tr>
            <th><?= translate('Image') ?></th>
            <th><?= translate('Product name') ?></th> 
            <th><?= translate('Price') ?></th>
            <th><?= translate('Description') ?></th>
            <th></th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><img src="<?= empty(glob('./images/' . $product->id . '.*')) ? './images/0.png' : glob('./images/' . $product->id . '.*')[0] ?>"></td>
            <td><?= $product->name ?></td>
            <td><?= $product->price ?></td>
            <td><?= $product->description ?></td>
            <td>
                <a class="add_to_cart_btn" href="/cart?remove=<?= $product->id ?>"><?= translate('Remove from cart') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <form action="/email" method="post">
        {{ csrf_field() }}
        <input required placeholder="<?php echo translate("Name"); ?>" type="text" name="client">
        <br>
        <br>
        <input required placeholder="<?php echo translate("email"); ?>" type="text" name="email">
        <br>
        <br>
        <textarea required placeholder="<?php echo translate("Other details... (address and/or any special request)"); ?>" name="details"></textarea>
        <br>
        <br>
        <button type="submit"><?php echo translate("Order now!"); ?></button>
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
    <?php else: ?>
    <h2><?= translate('Cart empty') ?></h2>
    <?php endif; ?>
@endsection