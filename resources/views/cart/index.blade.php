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
    <?php else: ?>
    <h2><?= translate('Cart empty') ?></h2>
    <?php endif; ?>
@endsection