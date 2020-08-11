<?php
if(\dash\data::productDataRow_parent())
{
  require_once('display-child.php');
}
else
{
  require_once('display-master.php');
}

?>

<?php if(!\dash\data::productDataRow_parent()) {?>
<form method="post" autocomplete="off" id="form1" data-patch>
	<input type="hidden" name="setstatus" value="setstatus">
  <div class="avand-md">



    <section class="box">

      <header><h2><?php echo T_("Product status"); ?></h2></header>
      <div class="body">

        <div class="row padLess">

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="available" type="radio" name="status" value="available" <?php if(\dash\data::productDataRow_status() == 'available') {echo 'checked';} ?>>
              <label for="available">
                <div>
                  <div class="title"><?php echo T_("Available"); ?></div>
                  <div class="addr"><?php echo T_("The product is available"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="soon" type="radio" name="status" value="soon" <?php if(\dash\data::productDataRow_status() == 'soon') {echo 'checked';} ?>>
              <label for="soon">
                <div>
                  <div class="title"><?php echo T_("Soon"); ?></div>
                  <div class="addr"><?php echo T_("The product is soon"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="unavailable" type="radio" name="status" value="unavailable" <?php if(\dash\data::productDataRow_status() == 'unavailable') {echo 'checked';} ?>>
              <label for="unavailable">
                <div>
                  <div class="title"><?php echo T_("Unavailable"); ?></div>
                  <div class="addr"><?php echo T_("The product is unavailable"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="discountinued" type="radio" name="status" value="discountinued" <?php if(\dash\data::productDataRow_status() == 'discountinued') {echo 'checked';} ?>>
              <label for="discountinued">
                <div>
                  <div class="title"><?php echo T_("Discountinued"); ?></div>
                  <div class="addr"><?php echo T_("The product is discountinued"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <?php if(\dash\data::productIsDeleted()) {?>
            <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
              <div class="radio4">
                <input  id="deleted" type="radio" name="status" value="deleted" <?php if(\dash\data::productDataRow_status() == 'deleted') {echo 'checked';} ?>>
                <label for="deleted">
                  <div>
                    <div class="title"><?php echo T_("Discountinued"); ?></div>
                    <div class="addr"><?php echo T_("The product is deleted"); ?></div>
                  </div>
                </label>
              </div>
            </div>
          <?php } //endif ?>
        </div>
        </div>

      <?php if(!\dash\data::productIsDeleted()) {?>
        <footer class="txtRa">
          <div class="btn linkDel"  data-confirm data-data='{"delete":"product"}'><?php echo T_("Remove product"); ?></div>
        </footer>
     <?php } //endif ?>
      </section>


    </div>
  </div>

</form>
<?php } //endif ?>