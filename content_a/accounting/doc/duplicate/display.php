

<form class="f justify-center" method="post" autocomplete="off">
  <div class="c6 s12">
    <div class="cbox">
          <h3><?php echo T_("Make a copy of this accounting document"); ?></h3>
          <label for="date" ><?php echo T_("Date"); ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
          <div class="input mB0-f">
          <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="date" id="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())); ?>" autocomplete='off' required>
          </div>
          <label for="number"><?php echo T_("New Accounting document number"); ?><span class="fc-red">*</span></label>
          <div class="input">
           <input type="tel" name="number" id="number" placeholder='<?php echo \dash\data::productDataRow_title(); ?>' value='<?php echo \dash\data::newNumber(); ?>' <?php \dash\layout\autofocus::html(); ?> data-format>
          </div>
          <div class="txtRa">
            <button class="btn success"><?php echo T_("Copy"); ?></button>
          </div>
    </div>

  </div>


</form>
