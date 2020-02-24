<?php if(\dash\data::dataRow()) {?>

	<?php if(\dash\data::dataRow_status() === 'enable') {?>

		<div class="msg success fs14 txtC">
			<b><?php echo \dash\data::dataRow_name(); ?></b>
			<br>
			<?php echo T_("Your domain was registered"); ?>
			<a href="<?php echo \dash\url::this() ?>" class="btn xs secondary" ><?php echo T_("OK"); ?></a>
		</div>

	<?php }elseif(\dash\data::dataRow_status() === 'failed' || true) {?>

		<div class="msg danger fs14 txtC">
			<b><?php echo \dash\data::dataRow_name(); ?></b>
			<br>
			<?php echo T_("Domain register failed"); ?>
			<br>
			<?php echo T_("If you have paid, your money back to your account"); ?>
			<a href="<?php echo \dash\url::this() ?>" class="btn xs secondary" ><?php echo T_("OK"); ?></a>
		</div>

	<?php } //endif ?>

<?php } //endif ?>



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
	if(\dash\data::isFiltered())
	{
		htmlSearchBox();
		htmlTable();
		htmlFilter();
	}
	else
	{
		htmlSearchBox();
		htmlTable();
	}

}
else
{
	if(\dash\data::isFiltered())
	{
		htmlSearchBox();

		htmlFilter();
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
<?php $sortLink = \dash\data::sortLink(); ?>

<div class="fs12">
	<table class="tbl1 v1 responsive">
		<thead>
			<tr>
				<th data-sort="<?php echo \dash\get::index($sortLink, 'name', 'order'); ?>" ><a href="<?php echo \dash\get::index($sortLink, 'name', 'link'); ?>"><?php echo T_("Domain"); ?></a></th>
				<th data-sort="<?php echo \dash\get::index($sortLink, 'dateexpire', 'order'); ?>"  class=""><a href="<?php echo \dash\get::index($sortLink, 'dateexpire', 'link'); ?>"><?php echo T_("Expire date"); ?></a></th>
				<th class="collapsing"><?php echo T_("DNS"); ?></th>
				<th class="collapsing" colspan="2"></th>
			</tr>
		</thead>
		<tbody>

			<?php foreach (\dash\data::dataTable() as $key => $value) {?>

			<tr>
				<td>
					<!-- <a target="_blank" href="http://<?php echo \dash\get::index($value, 'name'); ?>"><i class="sf-link"></i></a> -->
					<a href="<?php echo \dash\url::that(); ?>/setting/<?php echo \dash\get::index($value, 'name'); ?>" class="link"><code><?php echo \dash\get::index($value, 'name'); ?></code></a>
				</td>
				<td class=""><?php echo \dash\fit::date(\dash\get::index($value, 'dateexpire')); ?></td>
				<td class="collapsing">
					<code><?php echo \dash\get::index($value, 'ns1'); ?></code>
					<br>
					<code><?php echo \dash\get::index($value, 'ns2'); ?></code>
				</td>

				<td class="collapsing">
					<div class="ibtn wide"><?php echo '<span>'.T_("Lock"). '</span>'; if(isset($value['lock']) && $value['lock']) { echo '<i class="sf-lock fc-green"></i>'; } else{ echo '<i class="sf-unlock fc-red"></i>'; }?></div>
				</td>

				<td class="collapsing">
					<div class="ibtn wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(isset($value['autorenew']) && $value['autorenew']) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div>
				</td>

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

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><a href="<?php echo \dash\url::this(); ?>/buy"><?php echo T_("Buy your first winning domain!"); ?></a></p>

</div>

<?php } //endfunction ?>

