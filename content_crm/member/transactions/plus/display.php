<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<div class="avand-sm">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <p><?php echo T_("You try to Increase account recharge to customer account") ?></p>
        <label for="title"><?php echo T_("Title") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="text" name="title" required  maxlength="50">
        </div>

        <label for="amount"><?php echo T_("Amount") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="tel" name="amount" required data-format='price' maxlength="15">
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>