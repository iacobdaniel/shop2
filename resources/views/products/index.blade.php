@extends ('layout')

@section ('page_title')
    <title>Shop2 - home page</title>
@endsection

@section ('content')
    <div class="language_container">
        <a class="lang_button <?= $lang=='en' ? 'selected' : '' ?>" href="/index.php?lang=en">EN</a>
        <a class="lang_button <?= $lang=='ro' ? 'selected' : '' ?>" href="/index.php?lang=ro">RO</a>
        <a class="lang_button <?= $lang=='de' ? 'selected' : '' ?>" href="/index.php?lang=de">DE</a>
    </div>
    <h1>Shop2 - Home page - product listing</h1>
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
                <a class="add_to_cart_btn" href="/cart?add=<?= $product->id ?>"><?= translate('Add to cart') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <h2><?= translate('All the products are already in the cart or there are no products available.') ?></h2>
    <?php endif; ?>
    <a class="go_to_cart" href="/cart"><?= translate('See the cart') ?></a>
    <?php if($order_mail): ?>
    <div class="mail_success">
        <p>Your order has been successfully sent!</p>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery(".mail_success").delay(5000).fadeOut(300);
        });
    </script>
    <?php endif; ?>
@endsection