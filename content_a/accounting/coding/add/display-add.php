<form method="post" autocomplete="off">
  <div class="avand">
    <div class="row">
      <div class="c-xs-12 c-sm-12 c-md-6">
        <?php echo \dash\data::dataTableAll(); ?>
      </div>
      <div class="c-xs-12 c-sm-12 c-md-6">
        <div class="box">
          <header><h2><?php if(\dash\data::editMode()){ echo T_("Edit accounting coding"); }else{ echo T_("Add new accounting coding"); }  ?></h2></header>
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
            <?php if(\dash\data::myType() === 'group') {?>

              <label for="class"><?php echo T_("Class") ?> </label>
              <select class="select22" name="class" data-model='tag'>
                <option value=""><?php echo T_("Please choose class") ?></option>
                <option value="<?php echo \dash\data::dataRow_class(); ?>" selected><?php echo \dash\data::dataRow_class(); ?></option>
              </select>

            <?php } //endif ?>

            <?php if(\dash\data::myType() === 'total') {?>

              <label for="topic"><?php echo T_("Topic") ?> </label>
              <select class="select22" name="topic" data-model='tag'>
                <option value=""><?php echo T_("Please choose topic") ?></option>
                <option value="<?php echo \dash\data::dataRow_topic(); ?>" selected><?php echo \dash\data::dataRow_topic(); ?></option>
              </select>

            <?php } //endif ?>

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

            <div class="switch1 mT10">
              <input type="checkbox" name="status" id="status"  <?php if(\dash\data::dataRow_status() === 'enable') {echo 'checked';}?> >
              <label for="status" data-on="<?php echo T_("Enable") ?>" data-off="<?php echo T_("Disable") ?>"></label>
              <label for="status"><?php echo T_("Status"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="naturecontrol" id="naturecontrol"  <?php if(\dash\data::dataRow_naturecontrol()) {echo 'checked';}?> >
              <label for="naturecontrol"><?php echo T_("naturecontrol"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="exchangeable" id="exchangeable"  <?php if(\dash\data::dataRow_exchangeable()) {echo 'checked';}?> >
              <label for="exchangeable"><?php echo T_("exchangeable"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="followup" id="followup"  <?php if(\dash\data::dataRow_followup()) {echo 'checked';}?> >
              <label for="followup"><?php echo T_("followup"); ?></label>
            </div>

            <div class="check1 mT10">
              <input type="checkbox" name="currency" id="currency"  <?php if(\dash\data::dataRow_currency()) {echo 'checked';}?> >
              <label for="currency"><?php echo T_("currency"); ?></label>
            </div>


            <label for="code"><?php echo T_("Code") ?> <small class="fc-red"><?php echo T_("Required") ?></small></label>
            <div class="input">
              <input type="number"  max="9999999999" name="code" id="code" required value="<?php echo \dash\data::dataRow_code(); ?>" <?php if(\dash\data::editMode()) { echo 'disabled'; }?> >
            </div>



          </div>
          <footer class="f">
            <?php $buttonTitle = T_("Add"); if(\dash\data::editMode()) { $buttonTitle = T_("Edit"); ?>
            <div class="cauto">
              <div data-confirm data-data='{"remove": "remove"}' class="btn danger"><?php echo T_("Remove") ?></div>
            </div>
          <?php } //endif ?>
          <div class="c"></div>
          <div class="cauto">
            <button class="btn success"><?php echo $buttonTitle; ?></button>
          </div>
        </footer>

      </div>
    </div>


  </div>

</div>
</form>
