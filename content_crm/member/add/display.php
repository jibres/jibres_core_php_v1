<form method="post" autocomplete="off">
<div class="avand-sm">
	<div class="box">
		<div class="body">
			<label for="displayname"><?php echo T_("Display name"); ?></label>
			<div class="input">
			  <input type="text" name="displayname" id="displayname"  maxlength='90' required>
			</div>
	        <label for="mobile"><?php echo T_("Mobile"); ?></label>
			<div class="input">
			  <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Like 09120123456"); ?>'  maxlength='30'>
			</div>
		</div>
		<footer class="txtRa">
			<button class="btn master"><?php echo T_("Add") ?></button>
		</footer>
	</div>
</div>
</form>