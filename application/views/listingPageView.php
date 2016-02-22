<?php

use Cgi\Application\Core\UrlHandler;

?>

<table>
    <caption>Products</caption>
    <tr>
        <th>Product ID</th>
        <th>Name
            <a href="<?=UrlHandler::updateUrl(['sortBy' => 'name', 'option' => 'ASC']); ?>">&#8593;</a>
            <a href="<?=UrlHandler::updateUrl(['sortBy' => 'name', 'option' => 'DESC']); ?>">&#8595;</a>
        </th>
        <th>Price
            <a href="<?=UrlHandler::updateUrl(['sortBy' => 'final_price_without_tax', 'option' => 'ASC']); ?>">&#8593;</a>
            <a href="<?=UrlHandler::updateUrl(['sortBy' => 'final_price_without_tax', 'option' => 'DESC']); ?>">&#8595;</a>
        </th>
        <th></th>
    </tr>
<?php
    foreach ($products as $item) {
?>
    <tr>
        <td> <?=$item['product_id']?>  </td>
        <td class="nameColumn"> <?=$item['name']?> </td>
        <td> <?=$item['final_price_without_tax']?></td>
        <td><a href="http://pmpanel.loc/data/edit?id=<?=$item['product_id']?>">Edit</a>  </td></td>
    </tr>
    <?php } ?>

</table>

<div class="pager">
<?php for($i = 1; $i <= $amountOfPages; $i++) {
    echo '<p><a href=' . UrlHandler::updateUrl(['page' => $i]) . '>' . $i .'</a></p>';
}
?>
</div>
