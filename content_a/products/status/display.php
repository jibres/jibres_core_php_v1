<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();

?>


<form method="post" autocomplete="off" id="form1">
  <div class="avand-xl">



    <section class="box">

      <header><h2><?php echo T_("Product status"); ?></h2></header>
      <div class="body">

        <div class="pad unitsgPanel">

          <div class="mB10">
            <label for="status"><?php echo T_("Status"); ?></label>
            <select name="status" id="status" class="select22">
              <option value="available" <?php if(\dash\data::productDataRow_status() == 'available') {echo 'selected';} ?>><?php echo T_("Available"); ?></option>
              <option value="soon" <?php if(\dash\data::productDataRow_status() == 'soon') {echo 'selected';} ?>><?php echo T_("Soon"); ?></option>
              <option value="unavailable" <?php if(\dash\data::productDataRow_status() == 'unavailable') {echo 'selected';} ?>><?php echo T_("Unavailable"); ?></option>
              <option value="discountinued" <?php if(\dash\data::productDataRow_status() == 'discountinued') {echo 'selected';} ?>><?php echo T_("Discountinued"); ?></option>
              <?php if(\dash\data::productIsDeleted()) {?>
                <option value="deleted" <?php if(\dash\data::productDataRow_status() == 'deleted') {echo 'selected';} ?>><?php echo T_("Deleted"); ?></option>
              <?php } //endif ?>
            </select>
          </div>

          <?php if(!\dash\data::productIsDeleted()) {?>
            <p class="link" data-kerkere='.shobtnremove'><?php echo T_("Click here to remove product") ?></p>

            <div data-kerkere-content='hide' class="shobtnremove">
              <div class="btn linkDel"  data-confirm data-data='{"delete":"product"}'><?php echo T_("Remove product"); ?></div>
            </div>

          <?php } //endif ?>
        </div>
      </div>

    </section>


  </div>
</div>

</form>