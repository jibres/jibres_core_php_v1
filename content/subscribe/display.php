<div class="jibresBanner">
 <div class="avand impact">

 <div class="f content">
  <div class="c6 s12">
   <p><?php echo T_("Subscribe to Jibres world"); ?></p>
   <form method="post" data-clear>
    <?php \dash\csrf::html(); ?>

    <div class="input pA5">
     <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
     <input type="tel" name="mobile" id="mobile" placeholder='98 912 333 4444' maxlength="17" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>'>
    </div>
    <div class="input pA5">
     <label class="addon" for="name"><?php echo T_("Name"); ?></label>
     <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40'>
    </div>
    <div class="input pA5">
     <label class="addon" for="email"><?php echo T_("Email"); ?></label>
     <input type="email" name="email" id="email" placeholder='mail@example.com' maxlength='40'>
    </div>

    <div class="input pA5 mTB25">
     <button type="submit" name="submit-contact" class="btn block success"><?php echo T_("Send"); ?></button>
    </div>

   </form>
  </div>
 </div>

 </div>
</div>