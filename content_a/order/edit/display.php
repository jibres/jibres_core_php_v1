<?php $orderDetail = \dash\data::orderDetail(); ?>
<div class="avand-md">
  <form method="post" autocomplete="off">

    <div class="box">
      <div class="body">
        <label for='idesc'><?php echo T_("Description") ?></label>
        <textarea name="desc" class="txt" id="idesc" rows="3"><?php echo \dash\get::index($orderDetail, 'factor', 'desc'); ?></textarea>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>
