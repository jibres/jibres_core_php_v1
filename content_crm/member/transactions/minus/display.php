<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<div class="avand-sm">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="body">
        <div class="msg danger2 minimal">
          <p class=""><?php echo T_("You try to Reduce account recharge to customer account") ?></p>
        </div>
        <label for="title"><?php echo T_("Title") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="text" name="title" required  maxlength="200">
        </div>

         <label for="date"><?php echo T_("Date"); ?></label>
          <div class="input">
            <label data-kerkere='.showTime' class="addon btn"><?php echo \dash\fit::text(date("H:i")); ?></label>
            <input type="tel" name="date" id="date" placeholder='<?php echo \dash\fit::date(date("Y-m-d")); ?>' value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(date("Y-m-d"))) ?>" data-format='date'>
          </div>
          <div data-kerkere-content='hide' class="showTime">
            <div class="input">
              <input type="tel" name="time" id="time" placeholder='<?php echo \dash\fit::text(date("H:i")); ?>' value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::text(date("H:i"))) ?>" data-format='time'>

            </div>
          </div>


        <label for="amount"><?php echo T_("Amount") ?> <small class="fc-red">* <?php echo T_("Required") ?></small></label>
        <div class="input">
          <input type="tel" name="amount" required data-format='price' maxlength="15">
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn danger"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>