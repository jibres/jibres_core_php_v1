<?php if(\dash\data::editMode()) {?>
  <form method="post" autocomplete="off">
  	<input type="hidden" name="row" value="row">
    <div class="avand-lg">
      <div class="box">
      <header><h2><?php echo T_("Detail") ?></h2></header>
      <div class="body">

      	  <?php if(\dash\data::assistantList()) {?>
          <label for="assistant_id"><?php echo T_("Parent") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="assistant_id">
            <option value=""><?php echo T_("Please choose assistant_id") ?></option>
            <?php foreach (\dash\data::assistantList() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php } // endif ?>

        <?php if(\dash\data::detailsList()) {?>
          <label for="details_id"><?php echo T_("Parent") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="details_id">
            <option value=""><?php echo T_("Please choose details_id") ?></option>
            <?php foreach (\dash\data::detailsList() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php } // endif ?>

      	<label for="desc"><?php echo T_("Descrtiption") ?></label>
      	<div class="input">
      		<input type="text" name="desc">
      	</div>


      	<label for="debtor"><?php echo T_("Debtor") ?></label>
      	<div class="input">
      		<input type="text" minlength="0" maxlength="18"  name="debtor" data-format='price'>
      	</div>


      	<label for="creditor"><?php echo T_("Creditor") ?></label>
      	<div class="input">
      		<input type="text" minlength="0" maxlength="18"  name="creditor" data-format='price'>
      	</div>
      </div>
      <footer class="txtRa">
      	<button class="btn master"><?php echo T_("Add") ?></button>
      </footer>

      </div>
    </div>

  </form>
<?php } //endif ?>

