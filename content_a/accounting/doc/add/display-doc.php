<?php
$docIsLock = \dash\data::dataRow_status() === 'lock';
$docIsDel = \dash\data::dataRow_status() === 'deleted';

$disableInput = ($docIsLock || $docIsDel) ? 'disabled' : null;

?>
 <div class="box hidden print:block">
  <div class="pad">
    <div class="row align-center mb-2">
      <div class="c font-bold"><?php echo \lib\store::title(); ?></div>
      <div class="c-auto"><?php echo \dash\data::dataRow_tstatus() ?></div>
      <div class="c-auto"><?php echo T_("Date"); ?> <b><?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())); ?></b></div>
    </div>
    <div class="alert2"><b><?php echo T_("Document Description") ?></b> <?php echo \dash\data::dataRow_desc() ?></div>
  </div>
 </div>


 <form method="post" autocomplete="off" class="box print:hidden">
  <div class="pad">

    <?php if(\dash\data::openingMode()) {?>
      <div class="p-0">
        <?php if(\dash\data::openingDoc()) {?>
          <div class="alert-warning font-bold text-center"><?php echo T_("You already add Opening Document in this year!"); ?> <a class="btn-link" href="<?php echo \dash\url::that().'/edit?id='. \dash\data::openingDoc_id() ?>"><?php echo T_("View Document"); ?></a></div>
        <?php }else{ ?>
          <div class="alert-success font-bold text-center"><?php echo T_("Opening Document"); ?></div>
        <?php } //endif ?>


      </div>
    <?php } //endif ?>
    <div class="row">
      <div class="c-xs-12 c-sm-6 c-md-3 c-lg-3 c-xl-2 p-0">
        <?php $defaultYear = null; ?>

        <?php if(\dash\data::accountingYear()) {?>
          <label for="parent"><?php echo T_("Accounting year") ?></label>
          <select class="select22" name="year_id" <?php foreach (\dash\data::accountingYear() as $key => $value) { if((!\dash\data::dataRow_id() && a($value, 'isdefault')) || (a($value, 'id') === \dash\data::dataRow_year_id())) { $defaultYear = a($value, 'id'); echo 'disabled';} }?>>
            <option value=""><?php echo T_("Please choose year") ?></option>
            <?php foreach (\dash\data::accountingYear() as $key => $value) {?>
              <option value="<?php echo a($value, 'id') ?>" <?php if((!\dash\data::dataRow_id() && a($value, 'isdefault')) || (a($value, 'id') === \dash\data::dataRow_year_id())) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
            <?php } // endfor ?>
          </select>
        <?php }else{ ?>
          <div class="alert-warning"><a class="btn-link" href="<?php echo \dash\url::this(). '/year/add' ?>"><?php echo T_("Add new accounting year") ?></a></div>
        <?php } // endif ?>

        <?php if($defaultYear) {?>
          <input type="hidden" name="year_id" value="<?php echo $defaultYear; ?>">
        <?php } //endif ?>
      </div>

      <div class="c-xs-6 c-sm-6 c-md-3 c-lg-3 c-xl-2 p-0">
        <label for="number"><?php echo T_("Document Number") ?> <small class="text-red-800">* <?php echo T_("Automatic") ?></small></label>
        <div class="input mB0-f disabled">
          <input type="number" min="1" max="9999999999" name="number" id="number" readonly value="<?php echo \dash\data::dataRow_number() ?>" data-format=int <?php echo $disableInput; ?>>
        </div>
      </div>
      <div class="c-xs-6 c-sm-6 c-md-3 c-lg-3 c-xl-1 p-0">
        <label for="subnumber"><?php echo T_("Sub-Number") ?></label>
        <div class="input mB0-f">
          <input type="number" min="1" max="9999999999" name="subnumber" id="subnumber" value="<?php echo \dash\data::dataRow_subnumber() ?>" data-format=int <?php echo $disableInput; ?>>
        </div>
      </div>

      <div class="c-xs-12 c-sm-6 c-md-3 c-lg-3 c-xl-2 c-print-2">
        <label for="date" ><?php echo T_("Date"); ?> <small class="text-red-800">* <?php echo T_("Required") ?></small></label>
    		<div class="input mB0-f">
    		<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="date" id="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())); ?>" autocomplete='off' required <?php echo $disableInput; ?>>
    		</div>
      </div>
      <div class="c-xs-12 c-sm c-md c-lg c-xl c-print-10">
        <label for="desc"><?php echo T_("Document Description") ?></label>
        <div class="input mB0-f">
          <input type="text" name="desc" id="desc" value="<?php echo \dash\data::dataRow_desc() ?>" <?php echo $disableInput; ?>>
        </div>
      </div>

      <?php if(\dash\data::editMode()) {?>
        <?php if($docIsLock) {}else{?>
          <?php if(!\dash\request::get('did')) {?>
            <?php if($docIsDel) {?>
              <div class="c-xs c-auto p-0">
                <div class="btn mt-2 secondary" data-confirm data-data='{"newlockstatus": "temp"}'><?php echo T_("Restore") ?></div>
              </div>
              <div class="c-xs c-auto p-0">
                <div class="btn mt-2 danger" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove") ?></div>
              </div>
            <?php }else{ ?>
              <div class="c-xs c-auto p-0">
                <div class="btn-link-danger mt-2" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove") ?></div>
              </div>
              <div class="c-xs-auto c-auto p-0">
                <button class="btn-outline-secondary mt-2"><?php echo T_("Edit") ?></button>
              </div>
            <?php }//endif ?>
        <?php } //endif ?>
        <?php } //endif ?>
      <?php }else{ ?>
      <div class="c-xs-12 c-auto p-0">
        <button class="btn mt-2 master"><?php echo T_("Add") ?></button>
      </div>
      <?php } //endif ?>
    </div>

      <?php if(\dash\data::dataRow_template()) {?>
       <nav class="items long mt-2">
          <ul>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/factor/edit?id='. \dash\request::get('id'); ?>">
                <i class="sf-receipt-shopping-streamline"></i>
                <div class="key"><?php echo T_("Open factor page") ?></div>
                <div class="go"></div>
              </a>
            </li>
          </ul>
        </nav>
      <?php } //endif ?>
  </div>

 </form>