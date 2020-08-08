<?php require_once (root. 'content_account/address.php'); ?>
<div class="avand">
	<div class="row">
		<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block c-xl-3">
			  <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">

			<?php bAddressList(); ?>


			<form method="post" enctype="multipart/form-data" autocomplete="off">

		    	<?php bAddressAdd(); ?>

			</form>
		</div>
	</div>
</div>








