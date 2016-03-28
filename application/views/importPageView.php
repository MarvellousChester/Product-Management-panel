<h1>Product Import</h1>
<div class="importForm">
<form id="importForm" action="http://pmpanel.loc/data/import" method="get">
    <label>Magento Base URL:</label> <input name="url" type="text">
    <input class="submitButton" type="submit" value="Import products">
</form>
</div>
<p><?php if(isset($report)) echo $report; ?></p>