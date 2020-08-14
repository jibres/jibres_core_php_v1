<?php if(\dash\data::editMode()) {?>
  <form method="post" autocomplete="off">
  	<input type="hidden" name="row" value="row">
    <div class="avand-lg">
      <div class="box">
      <header><h2><?php echo T_("Detail") ?></h2></header>
      <div class="body">

      	  <?php if(\dash\data::assistantList()) {?>
          <label for="assistant_id"><?php echo T_("Accounting assistant") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="assistant_id">
            <option value=""><?php echo T_("Please choose assistant_id") ?></option>
            <?php foreach (\dash\data::assistantList() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php } // endif ?>

        <?php if(\dash\data::detailsList()) {?>
          <label for="details_title"><?php echo T_("Accounting details") ?></label>
          <select class="select22" data-model='tag' name="details_title">
            <option value=""><?php echo T_("Please choose details") ?></option>
            <?php foreach (\dash\data::detailsList() as $key => $value) {?>
              <option value="<?php echo $value ?>"><?php echo $value; ?></option>
            <?php } // endfor ?>
          </select>
        <?php }else{ ?>
          <label for="details_title"><?php echo T_("Accounting detail") ?></label>
          <div class="input">
            <input type="text" name="details_title">
          </div>
        <?php } // endif ?>

      	<label for="desc"><?php echo T_("Description") ?></label>
      	<div class="input">
      		<input type="text" name="desc">
      	</div>


        <div class="f">
          <div class="c mLa5">
            <div class="radio3 mB5">
              <input type="radio" name="type" value="debtor" id="debtor" <?php if(\dash\data::dataRow_type() === 'debtor') {echo 'checked';} ?>  >
              <label for="debtor"><?php echo T_("Debtor"); ?></label>
            </div>
          </div>
          <div class="c mLa5">
            <div class="radio3 mB5">
              <input type="radio" name="type" value="creditor" id="creditor" <?php if(\dash\data::dataRow_type() === 'creditor') {echo 'checked';} ?>  >
              <label for="creditor"><?php echo T_("Creditor"); ?></label>
            </div>
          </div>
        </div>


      	<label for="value"><?php echo T_("Value") ?></label>
      	<div class="input">
      		<input type="text" minlength="0" maxlength="18"  name="value" data-format='price'>
      	</div>

      </div>
      <footer class="txtRa">
      	<button class="btn master"><?php echo T_("Add") ?></button>
      </footer>

      </div>
    </div>

  </form>
<?php } //endif ?>

