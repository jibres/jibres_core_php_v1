<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();
require_once(root. 'content_a/products/productName.php');
?>
<div class="avand-md">
  <form method="post" autocomplete="off" id="form1">
    <section class="box">
      <div class="body">
        <p><?php echo T_("Edit group title") ?></p>
        <div class="input">
          <input type="text" name="group" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo \dash\data::groupTitle(); ?>">
        </div>
      </div>
      <footer class="txtRa">
        <button class="master btn"><?php echo T_("Edit") ?></button>
      </footer>
    </section>
  </form>
</div>