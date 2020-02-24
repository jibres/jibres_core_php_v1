


<div class="f">


  <div class="c s12">

  	<a class="dcard x1" href='<?php echo \dash\url::this(); ?>/buy'>
	 <div class="statistic blue">
	  <div class="value"><i class="sf-cart-plus"></i></div>
	  <div class="label"><?php echo T_("Buy domain"); ?></div>
	 </div>
	</a>

  </div>


  <div class="c s12">

  	<a class="dcard x1" href='<?php echo \dash\url::this(); ?>/renew'>
	 <div class="statistic blue">
	  <div class="value"><i class="sf-retweet"></i></div>
	  <div class="label"><?php echo T_("Renew domain"); ?></div>
	 </div>
	</a>

  </div>


  <div class="c s12">

	<a class="dcard x1" href='<?php echo \dash\url::this(); ?>/transfer'>
	 <div class="statistic green">
	  <div class="value"><i class="sf-exchange"></i></div>
	  <div class="label"><?php echo T_("Transfer domain"); ?></div>
	 </div>
	</a>

  </div>

   <div class="c s12">

  	<a class="dcard x1" href='<?php echo \dash\url::this(); ?>/irnic'>
	 <div class="statistic blue">
	  <div class="value"><i class="sf-vcard"></i></div>
	  <div class="label"><?php echo T_("IRNIC Handle"); ?></div>
	 </div>
	</a>

  </div>
</div>

<?php
if(\dash\data::dataTable())
{
	htmlSearchBox();
	htmlTable();
}
else
{
	if(\dash\data::isFiltered())
	{
		htmlSearchBox();
		htmlTable();
	}
	else
	{
		htmlStartAddNew();
	}
}
?>







<?php function htmlSearchBox() {?>
<div class="fs12">
	<form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
		<div class="input search">
			<input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
			<button class="btn addon success"><?php echo T_("Search"); ?></button>
		</div>
	</form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
<div class="tblBox">
	<table class="tbl1 v4">
		<thead>
			<tr>
				<th><?php echo T_("Domain"); ?></th>
				<th class=""><?php echo T_("Expire date"); ?></th>
				<th class="collapsing"><?php echo T_("Setting"); ?></th>
				<th class="collapsing"><?php echo T_("Last change"); ?></th>
				<th class="collapsing"><?php echo T_("DNS"); ?></th>
				<th class="collapsing"><?php echo T_("Action"); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (\dash\data::dataTable() as $key => $value) {?>

			<tr>
				<td><a target="_blank" href="http://<?php echo \dash\get::index($value, 'name'); ?>"><i class="sf-link"></i></a> <span><?php echo \dash\get::index($value, 'name'); ?></span></td>
				<td class=""><?php echo \dash\fit::date(\dash\get::index($value, 'dateexpire')); ?></td>
				<td class="collapsing">
					<?php if(isset($value['lock']) && $value['lock']) {?><i class="sf-lock fc-green"></i> <?php }else{ ?> <i class="sf-unlock fc-red"></i> <?php } ?>
					<?php if(isset($value['autorenew']) && $value['autorenew']) {?><i class="sf-refresh fc-blue" title='<?php echo T_("Auto renew enabled"); ?>'></i> <?php } ?>
				</td>
				<td class="collapsing">
					<?php if(isset($value['datemodified']) && $value['datemodified']) {?>

						<?php echo \dash\fit::date_human(\dash\get::index($value, 'datemodified')); ?>

					<?php }else{ ?>

						<span class="sf-mute fs09"><?php echo T_("Without change"); ?></span>

					<?php } ?>

				</td>
				<td class="collapsing">
					<code><?php echo \dash\get::index($value, 'ns1'); ?></code>
					<br>
					<code><?php echo \dash\get::index($value, 'ns2'); ?></code>
				</td>
				<td class="collapsing"><a href="<?php echo \dash\url::that(); ?>/setting/<?php echo \dash\get::index($value, 'name'); ?>" class="btn info2"><?php echo T_("Manage domain"); ?></a></td>
			</tr>
			<?php } //endfor ?>
		</tbody>
	</table>
</div>
<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php if(\dash\data::checkResult()) {?>

<div class="cbox">

	<?php if(\dash\data::checkResult_available()) {?>

	<div class="msg success2"><?php echo T_("Domain is available"); ?>
		<b><?php echo \dash\data::myDomain(); ?></b>
		<span class="floatL">
			<a class="btn success" href="<?php echo \dash\url::this(); ?>/buy/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Buy"); ?></a>
		</span>
	</div>

	<?php }else{ ?>

	<div class="msg warn2"><?php echo T_("Domain is occupied"); ?>
		<span class="floatL">
			<a class="btn warn" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Whois"); ?></a>
		</span>
	</div>

	<?php }//endif ?>

<?php } //endif ?>
</div>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><a href="<?php echo \dash\url::this(); ?>/buy"><?php echo T_("Buy your first winning domain!"); ?></a></p>

</div>

<?php } //endfunction ?>

