<div class="jibresBanner" data-back='475'>
 <div class="avand-sm zero mB50">
	<img class="block" src="<?php echo \dash\url::cdn(); ?>\img\flags\svg\<?php echo \dash\data::ip_flag(); ?>.svg" alt='<?php echo \dash\data::ip_country(); ?>'>
 </div>

 <div class="avand-md impact zero txtC">
 	<table class="tbl1 v3 mB0">
 		<tr>
 			<th><?php echo T_("IP"); ?></th>
 			<td data-copy='<?php echo T_(\dash\data::ip_ip()); ?>'><?php echo T_(\dash\data::ip_ip()); ?></td>
 		</tr>
 		<tr>
 			<th><?php echo T_("Country"); ?></th>
 			<td><?php echo T_(\dash\data::ip_country()); ?></td>
 		</tr>
 		<tr>
 			<th><?php echo T_("Province"); ?></th>
 			<td><?php echo T_(ucwords(\dash\data::ip_state())); ?></td>
 		</tr>
 		<tr>
 			<th><?php echo T_("City"); ?></th>
 			<td><?php echo T_(ucfirst(\dash\data::ip_city())); ?></td>
 		</tr>
 		<tr>
 			<th><?php echo T_("ISP"); ?></th>
 			<td class="ltr"><?php echo T_(ucfirst(\dash\data::ip_isp())); ?></td>
 		</tr>
 		<tr>
 			<th><?php echo T_("latitude"); ?></th>
 			<td class="ltr"><?php echo \dash\data::ip_latitude(); ?></td>
 		</tr>
 		<tr>
 			<th><?php echo T_("longitude"); ?></th>
 			<td class="ltr"><?php echo \dash\data::ip_longitude(); ?></td>
 		</tr>
 	</table>
 </div>

 <div class="avand-md impact zero">
 	<iframe class="block" src="https://www.google.com/maps?q=<?php echo \dash\data::ip_latitude(); ?>,<?php echo \dash\data::ip_longitude(); ?>" width="100%" height="300" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
 </div>

 <div class="avand-md impact zero">
 	<pre class="mB0"><?php \dash\code::jsonPretty(\dash\data::ip_dbip()) ?></pre>
 </div>


 <div class="avand-md impact zero">
 	<pre class="mB0"><?php \dash\code::jsonPretty(\dash\data::ip_ipgeolocation()) ?></pre>
 </div>
