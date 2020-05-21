<div class="avand-sm">

    <form method="post" class="box" autocomplete="off" >

      <div class="body">

        <textarea class="txt" rows="5" name="text" placeholder="<?php echo T_("Type here...") ?>" id="text"><?php echo \dash\data::dataRow_text(); ?></textarea>

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