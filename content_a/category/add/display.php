<div class="avand-sm">
	<form method="post" autocomplete="off">
		<div class="box">
			<div class="body">
				<label for="icategoryname"><?php echo T_("Title"); ?></label>
				<div class="input">
					<input type="text" name="category" id="icategoryname" placeholder='<?php echo T_("Category name"); ?>'  <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
				</div>
			</div>
			<footer class="txtRa">
				<button class="btn-primary"><?php echo T_("Add"); ?></button>
			</footer>
		</div>
	</form>
</div>