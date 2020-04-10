<div class="jibresBanner">
 <div class="fit zero love">
 	<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-bug-1.jpg" alt='<?php echo \dash\face::title();?>'>
 </div>

 <div class="fit">
 		<h2><?php echo T_("Submit Vulnerability Report"); ?></h2>
 		<p class="mB25"><?php echo T_('The proof of concept is the most important part of your report submission. Clear, reproducible steps will help us validate this issue as quickly as possible.') ?></p>

     <form method="post" data-clear autocomplete="off">
<?php
      \dash\utility\hive::html();
      if(!\dash\user::login())
      {
?>
        <label for="title"><?php echo T_("Title"); ?> *</label>
        <div class="input">
         <input type="text" name="title" id="title" placeholder='<?php echo T_("A clear and concise title includes the type of vulnerability and the impacted asset."); ?>' maxlength='40'>
        </div>

        <label for="name"><?php echo T_("Name"); ?></label>
        <div class="input">
         <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40'>
        </div>

        <label for="mobile"><?php echo T_("Mobile"); ?></label>
        <div class="input">
         <input type="tel" name="mobile" id="mobile" placeholder='98 912 333 4444' maxlength="17" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>'>
        </div>

        <label for="email"><?php echo T_("Email"); ?></label>
        <div class="input">
         <input type="email" name="email" id="email" placeholder='' maxlength='40'>
        </div>
<?php
      } // endif
?>
      <div>
       <label for="content"><?php echo T_("Description"); ?> *</label>
       <textarea class="txt" name="content" id="contenct" placeholder='<?php echo T_("What is the vulnerability? In clear steps, how do you reproduce it?"); ?>' rows=4 minlength="5" maxlength="1000" data-resizable></textarea>
      </div>

      <button type="submit" name="submit-contact" class="btn block success mT25"><?php echo T_("Send"); ?></button>
     </form>



 </div>

</div>
<canvas id="matrix"/>
<script src='<?php echo \dash\url::cdn(); ?>/js/page/matrix.js'></script>