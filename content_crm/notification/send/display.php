<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <label for="user"><?php echo T_("Customer") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div>
          <select name="user" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'></select>
        </div>
        <textarea name="text" class="txt mB10" rows="3" placeholder="<?php echo T_("Message text ...") ?>"></textarea>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Send") ?></button>
      </footer>
    </div>
  </form>
</div>