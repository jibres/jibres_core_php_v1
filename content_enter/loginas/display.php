
  <h1 class='logo'>
  	<div class="f justify-center txtC">
  		<div class="caouto">
			<img src='<?php echo \dash\url::icon(); ?>' alt='<?php echo \dash\face::site(); ?>'>
  		</div>
  		<div class="caouto mT20">
  			<i class="sf-exchange"></i>
  		</div>

  		<div class="caouto">
			<img src='<?php echo \dash\data::joinToStore_logo(); ?>' alt='<?php echo \dash\data::joinToStore_title(); ?>'>
  		</div>
  	</div>
  </h1>


   <h2 class='flex justify-center align-center'><?php echo \dash\data::joinToStore_title(); ?></h2>

<div class="text">
	<p><?php echo T_("You are currently logged in to your account"); ?><br><?php echo T_("Do you want to enter this store with the same account?"); ?></p>

	<form method="post" autocomplete="off" class="mB20">
		 <div class="f fs08">
		 	<div class="c">
				<button class="btn block success" name="myActionLogin" value="login"><?php echo T_("Continue"); ?></button>
		 	</div>
		 	<div class="c mLa5">
				<button class="btn block secondary" name="myActionCancel" value="cancel"><?php echo T_("Cancel"); ?></button>
		 	</div>
		 </div>
	</form>
</div>

<footer class='f'>
	<a href="<?php echo \dash\url::kingdom(); ?>/logout"><?php echo T_("Logout"); ?></a>
</footer>
