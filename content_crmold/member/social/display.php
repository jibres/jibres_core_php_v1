

<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>
<div class="f">
 <div class="cauto s12 pA5">
<?php require_once(root. 'content_crm/member/psidebar.php'); ?>
 </div>
 <div class="c s12 pA5">

  <form class="cbox" method="post" autocomplete="off">


        <h3 class="txtC"><?php echo T_("Email and Social Networks"); ?></h3>

<label for="website"><?php echo T_("Website"); ?></label>
<div class="input ltr">
  <input type="url" name="website" id="website" placeholder='<?php echo T_("Website"); ?> <?php echo T_("like"); ?> https://ermile.com' value="<?php echo \dash\data::dataRowMember_website(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" title='<?php echo T_("Enter a valid website from 3 to 40 character"); ?>' >
</div>


<label for="email"><?php echo T_("Email"); ?></label>
<div class="input">
  <input type="email" name="email" id="email" placeholder='<?php echo T_("Like"); ?> abc@example.com' value="<?php $mail = \dash\data::dataRowMember_detail(); echo \dash\get::index($mail, 'email'); ?>" maxlength='50'>
</div>


<label for="instagram"><?php echo T_("Instagram"); ?></label>
<div class="input ltr">
  <span class="addon"><i class="sf-instagram"></i> instagram.com/</span>
  <input type="text" name="instagram" id="instagram" placeholder='<?php echo T_("Instagram"); ?>' value="<?php echo \dash\data::dataRowMember_instagram(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" title='<?php echo T_("Enter a valid instagram from 3 to 40 character"); ?>' >
</div>


<label for="facebook"><?php echo T_("Facebook"); ?></label>
<div class="input ltr">
  <span class="addon"><i class="sf-facebook-official"></i> facebook.com/</span>
  <input type="text" name="facebook" id="facebook" placeholder='<?php echo T_("Facebook"); ?>' value="<?php echo \dash\data::dataRowMember_facebook(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" title='<?php echo T_("Enter a valid facebook from 3 to 40 character"); ?>' >
</div>

<label for="twitter"><?php echo T_("Twitter"); ?></label>
<div class="input ltr">
  <span class="addon"><i class="sf-twitter"></i> twitter.com/</span>
  <input type="text" name="twitter" id="twitter" placeholder='<?php echo T_("Twitter"); ?>' value="<?php echo \dash\data::dataRowMember_twitter(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" title='<?php echo T_("Enter a valid twitter from 3 to 40 character"); ?>' >
</div>

<label for="linkedin"><?php echo T_("Linkedin"); ?></label>
<div class="input ltr">
  <span class="addon"><i class="sf-linkedin"></i> linkedin.com/</span>
  <input type="text" name="linkedin" id="linkedin" placeholder='<?php echo T_("Linkedin"); ?>' value="<?php echo \dash\data::dataRowMember_linkedin(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" title='<?php echo T_("Enter a valid linkedin from 3 to 40 character"); ?>' >
</div>

<label for="bio"><?php echo T_("Bio"); ?></label>
<textarea class="txt mB20 pB25" name="bio" placeholder='<?php echo T_("Bio"); ?>' maxlength='300' rows="3"><?php echo \dash\data::dataRowMember_bio(); ?></textarea>




<button class="btn block primary"><?php echo T_("Save"); ?></button>


  </form>
 </div>
</div>




