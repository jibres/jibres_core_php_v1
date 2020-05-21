<div class="avand-sm">

    <form method="post" class="box" autocomplete="off" >

      <div class="body">

        <label for="limit"><?php echo T_("Limit"); ?></label>
        <div class="input">
          <input type="number" name="limit" id="limit" value="<?php echo \dash\data::dataRow_limit() ?>"  >
        </div>



      </div>

      <footer class="txtRa">
        <?php if(\dash\data::dataRow()) {?>
          <button class="btn primary"><?php echo T_("Save"); ?></button>
        <?php }else{ ?>
          <button class="btn success"><?php echo T_("Save"); ?></button>
        <?php } //endif ?>
      </footer>

    </form>

</div>