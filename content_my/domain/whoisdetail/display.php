<div class="avand-lg">
	<form method="post" autocomplete="off">
		<div class="box impact ltr">
			<header <?php if(\dash\language::current() == 'fa') {echo ' class="rtl" ';}?>><h2><?php echo T_("Manage International whois detail") ?></h2></header>
			<div class="body">
				<?php require_once('whoisDetailForm.php'); ?>
			</div>
			<footer class="txtLa">
				<button class="btn success"><?php echo "Save"; ?></button>
			</footer>
		</div>
	</form>
</div>