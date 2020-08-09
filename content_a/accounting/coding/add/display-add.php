<form method="post" autocomplete="off">
  <div class="avand-lg">
    <div class="box">
      <header><h2><?php echo T_("Add new accounting coding") ?></h2></header>
      <div class="body">

        <?php if(\dash\data::parentList()) {?>
          <label for="parent"><?php echo T_("Parent") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="parent">
            <option value=""><?php echo T_("Please choose parent") ?></option>
            <?php foreach (\dash\data::parentList() as $key => $value) {?>
              <option value="<?php echo \dash\get::index($value, 'id') ?>"><?php echo \dash\get::index($value, 'full_title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php } // endif ?>

        <label for="title"><?php echo T_("Title") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="text" name="title" id="title" required value="<?php echo \dash\data::dataRow_title(); ?>">
        </div>

        <?php if(\dash\data::myType() === 'assistant' || \dash\data::myType() === 'total' || \dash\data::myType() === 'group') {?>
          <label for="nature"><?php echo T_("Nature") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
          <select class="select22" name="nature">
            <option value=""><?php echo T_("Please choose nature") ?></option>

            <?php if(\dash\data::myType() === 'assistant' || \dash\data::myType() === 'total') {?>
              <option value="debtor" <?php if(\dash\data::dataRow_nature() === 'debtor') {echo 'selected';} ?>><?php echo T_("Debtor") ?></option>
              <option value="creditor" <?php if(\dash\data::dataRow_nature() === 'creditor') {echo 'selected';} ?>><?php echo T_("Creditor") ?></option>
              <option value="debtor-creditor" <?php if(\dash\data::dataRow_nature() === 'debtor-creditor') {echo 'selected';} ?>><?php echo T_("Debtor-Creditor") ?></option>
            <?php } // endif ?>

            <?php if(\dash\data::myType() === 'group') {?>
              <option value="balance sheet" <?php if(\dash\data::dataRow_nature() === 'balance sheet') {echo 'selected';} ?>><?php echo T_("Balance Sheet") ?></option>
              <option value="disciplinary" <?php if(\dash\data::dataRow_nature() === 'disciplinary') {echo 'selected';} ?>><?php echo T_("Disciplinary") ?></option>
              <option value="harmful profit" <?php if(\dash\data::dataRow_nature() === 'harmful profit') {echo 'selected';} ?>><?php echo T_("Harmful-Profit") ?></option>
            <?php } // endif ?>
          </select>
        <?php } // endif ?>

        <?php if(\dash\data::myType() === 'assistant' ) {?>

        <div class="switch1 mT10">
              <input type="checkbox" name="detailable" id="detailable"  <?php if(\dash\data::dataRow_detailable()) {echo 'checked';}?> >
              <label for="detailable" data-on="<?php echo T_("Yes") ?>" data-off="<?php echo T_("No") ?>"></label>
              <label for="detailable"><?php echo T_("Detailable?"); ?></label>
            </div>
        <?php } // endif ?>



        <label for="code"><?php echo T_("Code") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="number" min="10" max="9999999999" name="code" id="code" required value="<?php echo \dash\data::dataRow_code(); ?>" <?php if(\dash\data::editMode()) { echo 'disabled'; }?> >
        </div>


      </div>
      <?php if(\dash\data::editMode()) {?>
      <footer class="f">
        <div class="cauto">
          <div data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove") ?></div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <button class="btn success"><?php echo T_("Edit") ?></button>
        </div>

      </footer>
        <?php }else{ ?>
      <footer class="txtRa">
          <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
      <?php } //endif ?>
    </div>
  </div>
</form>
