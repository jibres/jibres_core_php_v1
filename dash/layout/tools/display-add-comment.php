<form  method="post" data-clear autocomplete="off" action="<?php echo \dash\url::kingdom(); ?>/api/comment/add">
  <input type="hidden" name="post_id" class="hide" value="<?php echo \dash\data::dataRow_id(); ?>">
  <?php
  if(!\dash\user::id())
  {
  ?>
      <div class="f">
        <div class="c pRa5">
          <div class="input">
           <label class="addon" for="name"><?php echo T_("Name"); ?></label>
           <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40' value="<?php echo \dash\user::detail('displayname'); ?>">
          </div>
        </div>
        <div class="c">
          <div class="input">
           <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
           <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Mobile"); ?>' maxlength="13" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>' value="<?php echo \dash\user::detail('mobile'); ?>">
          </div>
        </div>
        <input type="text" name="username" class="hide" value="">
      </div>
  <?php
  } // endif
  ?>
  <label><?php echo T_("Your rate"); ?></label>
  <div class="radioRating togglable">
    <div class="rateBox">
      <input type="radio" name="star" id="star-1" value="1">
      <label for="star-1"></label>
      <input type="radio" name="star" id="star-2" value="2">
      <label for="star-2"></label>
      <input type="radio" name="star" id="star-3" value="3">
      <label for="star-3"></label>
      <input type="radio" name="star" id="star-4" value="4">
      <label for="star-4"></label>
      <input type="radio" name="star" id="star-5" value="5">
      <label for="star-5"></label>
    </div>
  </div>
  <div class="input">
    <textarea name="content" class="txt" rows="5" placeholder='<?php echo T_("Write your comment..."); ?>'></textarea>
  </div>
  <button class="btn primary block mT20"><?php echo T_("Send"); ?></button>
</form>