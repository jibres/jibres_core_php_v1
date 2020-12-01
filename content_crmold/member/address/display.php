

<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>


<div class="f">
 <div class="cauto s12 pA5">
<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">
	<?php require_once(root. 'content_account/address.php'); ?>

		<?php bAddressList(); ?>

	<form method="post" enctype="multipart/form-data" autocomplete="off">
	  <div class="f justify-center">
	    <div class="x5 c6 m8 s10">
		<?php bAddressAdd(); ?>
	    </div>
	  </div>
	</form>

 </div>
</div>
