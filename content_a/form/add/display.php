<form method="post" autocomplete="off" id="form1">

<div class="avand-md">
	<div class="box">
		<div class="body">
			<label for="ititle"><?php echo T_("Form title") ?> <small class="text-red-800">* <?php echo T_("Required") ?></small></label>
			<div class="input">
				<input type="text" name="title" required id="ititle" <?php \dash\layout\autofocus::html() ?>>
			</div>

		</div>
      <footer class="txtRa">
          <button class="btn-primary"><?php echo T_("Add"); ?></button>
      </footer>
	</div>
</div>
</form>