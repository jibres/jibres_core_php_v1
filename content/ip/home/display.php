<div class="jibresBanner" data-back='475'>
<?php if(\dash\data::ip_flag() && \dash\data::ip_flag() !== 'zz') { ?>
 <div class="avand-sm zero mB50">
	<img class="block" src="<?php echo \dash\url::cdn(); ?>\img\flags\svg\<?php echo \dash\data::ip_flag(); ?>.svg" alt='<?php echo \dash\data::ip_country(); ?>'>
 </div>
<?php } ?>

 <div class="avand-md impact zero txtC">
 	<table class="tbl1 v3 mB0">
 		<tr>
 			<th><?php echo T_("IP"); ?></th>
 			<td class="txtB" data-copy='<?php echo T_(\dash\data::ip_ip()); ?>'><?php echo T_(\dash\data::ip_ip()); ?></td>
 		</tr>
<?php if(\dash\data::ip_country()) { ?>
 		<tr>
 			<th><?php echo T_("Country"); ?></th>
 			<td><?php echo T_(\dash\data::ip_country()); ?></td>
 		</tr>
<?php } ?>
<?php if(\dash\data::ip_state()) { ?>
 		<tr>
 			<th><?php echo T_("Province"); ?></th>
 			<td><?php echo T_(ucwords(\dash\data::ip_state())); ?></td>
 		</tr>
<?php } ?>
<?php if(\dash\data::ip_city()) { ?>
 		<tr>
 			<th><?php echo T_("City"); ?></th>
 			<td><?php echo T_(ucfirst(\dash\data::ip_city())); ?></td>
 		</tr>
<?php } ?>
<?php if(\dash\data::ip_isp()) { ?>
 		<tr>
 			<th><?php echo T_("ISP"); ?></th>
 			<td class="ltr"><?php echo T_(ucfirst(\dash\data::ip_isp())); ?></td>
 		</tr>
<?php } ?>
<?php if(\dash\data::ip_latitude()) { ?>
 		<tr>
 			<th><?php echo T_("latitude"); ?></th>
 			<td class="ltr"><?php echo \dash\data::ip_latitude(); ?></td>
 		</tr>
<?php } ?>
<?php if(\dash\data::ip_longitude()) { ?>
 		<tr>
 			<th><?php echo T_("longitude"); ?></th>
 			<td class="ltr"><?php echo \dash\data::ip_longitude(); ?></td>
 		</tr>
<?php } ?>
 	</table>
 </div>

<?php if(\dash\data::ip_latitude() && \dash\data::ip_longitude()) {?>
 <div class="avand-md impact zero">
 	<iframe class="block" src="https://www.google.com/maps?q=<?php echo \dash\data::ip_latitude(); ?>,<?php echo \dash\data::ip_longitude(); ?>&hl=en;z=16&amp;output=embed" width="100%" height="300" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
 </div>
<?php }?>

 <div class="avand-md zero">
 	<div class="txtC">

 	<?php if(\dash\data::ipDetail_block() === 'block') {?>
 		<p class="alert-danger">IP is blocked! <?php if(\dash\data::ipDetail_countblock()) {?> <span> (Count block: <?php echo \dash\data::ipDetail_countblock(); ?> ) </span><?php } //endif ?></p>
 	<?php }elseif(\dash\data::ipDetail_block() === 'unblock'){?>
 		<p class="alert-success">IP is not blocked</p>
 	<?php }elseif(\dash\data::ipDetail_block() === 'unknown'){?>
 		<p class="msg secondary">Unknown ip status</p>
 	<?php }elseif(\dash\data::ipDetail_block() === 'new'){?>
 		<p class="msg primary">New ip</p>
 	<?php } //endif ?>
 	</div>
 </div>

<?php if(\dash\data::ip_dbip()) {?>
 <div class="avand-md impact zero">
 	<pre class="mB0"><?php \dash\code::jsonPretty(\dash\data::ip_dbip()) ?></pre>
 </div>
<?php }?>


<?php if(\dash\data::ip_ipgeolocation()) {?>
 <div class="avand-md impact zero">
 	<pre class="mB0"><?php \dash\code::jsonPretty(\dash\data::ip_ipgeolocation()) ?></pre>
 </div>
<?php }?>


<?php if(\dash\data::ipStatus()) {?>
 <div class="avand-md impact zero">
 	<pre class="mB0"><?php \dash\code::jsonPretty(\dash\data::ipStatus()) ?></pre>
 </div>
<?php }?>
