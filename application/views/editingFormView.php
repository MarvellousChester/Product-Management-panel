<form id="editForm" action="http://pmpanel.loc/data/edit?id=<?=$data->get('product_id');?>" method="post">
    <label>Name:</label>
    <input name="name" type="text" value="<?=$data->get('name'); ?>">
    <br />
    <label>SKU:</label>
    <input name="sku" type="text" value="<?=$data->get('sku'); ?>">
    <br />
    <label>Status:</label>
    <select name="is_saleable">
        <option value="1">Enabled</option>
        <option value="0">Disabled</option>
    </select>
    <br />
    <label>Description:</label>
    <input name="description" type="text" value="<?=$data->get('description'); ?>">
    <br />
    <label>Price:</label>
    <input name="final_price_without_tax" type="text" value="<?=$data->get('final_price_without_tax'); ?>">
    <br />
    <label>Last Updated:</label>
    <input name="updated" type="text" disabled="disabled " value="<?=$data->get('updated'); ?>">
    <br />
    <input class="submitButton" type="submit" value="Update">
</form>

