

<form class="f justify-center" method="post" autocomplete="off">
  <div class="c6 s12">
    <div class="cbox">
          <h3><?php echo T_("Make a copy of this accounting document"); ?></h3>
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
