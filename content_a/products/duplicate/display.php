

<form class="f justify-center" method="post" autocomplete="off">
  <div class="c6 s12">
    <div class="cbox">
          <h3><?php echo T_("Make a copy of this product"); ?></h3>
          <label for="title"><?php echo T_("New Title"); ?><span class="fc-red">*</span></label>
          <div class="input">
           <input type="text" name="title" id="title" placeholder='<?php echo T_("Copy of"); ?> <?php echo \dash\data::productDataRow_title(); ?>' value='<?php echo T_("Copy of"); ?> <?php echo \dash\data::productDataRow_title(); ?>' maxlength='200' autofocus>
          </div>
          <div class="txtRa">
            <button class="btn success"><?php echo T_("Copy"); ?></button>
          </div>
    </div>

  </div>


</form>
