<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<?php require_once(root. 'content_account/address.php'); ?>


<?php if(\dash\data::addNewAddress()) {?>
<form method="post" enctype="multipart/form-data" autocomplete="off">
	<div class="row justify-center">
		<div class="c-xs-12 c-sm-10 c-lg-8 c-xl-6">
			<?php bAddressAdd(); ?>
		</div>
	</div>
</form>
<?php }else{ ?>
	<?php if(\dash\data::dataTable()) {?>
	<nav class="items">
	  <ul>
	    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
	     <li>
	      <a class="f" href="<?php echo \dash\data::myUrlAddress(). '?addressid='. a($value, 'id'); if(\dash\request::get('id')) { echo '&id='. \dash\request::get('id'); }?>">
	        <div class="key">
	          <span class="fc-blue"><?php echo a($value, 'title'); ?></span>
	          <span class="text-gray-400"><?php echo a($value, 'location_string'); ?></span>
	          <span class="font-bold"><?php echo a($value, 'address'); ?></span>
	        </div>
	        <div class="value ltr"><?php echo \dash\fit::mobile($value['postcode']); ?></div>
	        <div class="value username ltr"><?php echo \dash\fit::mobile($value['phone']); ?></div>
	        <div class="value username ltr"><?php \dash\fit::mobile($value['mobile']);  ?></div>
	        <div class="go"></div>
	      </a>
	     </li>
	    <?php } //endfor ?>
	  </ul>
	</nav>
	<?php } //endif ?>
<?php } //endif ?>
