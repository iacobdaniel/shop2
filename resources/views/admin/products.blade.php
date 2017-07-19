@extends ('layout')

@section ('page_title')
    <title>Shop2 - ADMIN - MANAGE PRODUCTS</title>
@endsection

@section ('content')
    <h1>Shop2 - ADMIN - MANAGE PRODUCTS</h1>
    <?php if($prod_exist): ?>
    <table class="table product_table">
        <tr>
            <th>Image</th>
            <th>Product name</th> 
            <th>Price</th>
            <th>Description</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><img src="<?= empty(glob('./images/' . $product->id . '.*')) ? './images/0.png' : glob('./images/' . $product->id . '.*')[0] ?>"></td>
            <td><?= $product->name ?></td>
            <td><?= $product->price ?></td>
            <td><?= $product->description ?></td>
            <td>
                <a class="add_to_cart_btn" href="/products/<?= $product->id ?>/edit">Edit product</a>
            </td>
            <td>
                <a class="add_to_cart_btn delete_button" data-name="<?= $product->name ?>" href="/products/<?= $product->id ?>/delete">Delete product</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
    <h2>No products in the DB.</h2>
    <?php endif; ?>
    <a class="go_to_cart" href="/products/create">Add new product</a>
    <script type="text/javascript">
        jQuery(document).ready(function () {
             jQuery('a.delete_button').click(function() {
                 return confirm("Are you sure you want to delete " + jQuery(this).data('name') + "?");
             });
        });
    </script>
@endsection