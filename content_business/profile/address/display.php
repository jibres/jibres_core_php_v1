<?php require_once (root. 'content_account/address.php'); ?>
<div class="avand">
	<div class="row">
		<div class="c-xs-12 c-md-4">
			  <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-md-8">

			<?php bAddressList(); ?>


			<form method="post" enctype="multipart/form-data" autocomplete="off">

		    	<?php bAddressAdd(); ?>

			</form>
		</div>
	</div>
</div>








