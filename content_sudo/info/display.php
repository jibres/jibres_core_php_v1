
 <div class="cbox">
  <h2><?php echo T_("Info"); ?></h2>
   	<a class="btn" target='_blank' href="<?php echo \dash\url::here(); ?>/info/server"><?php echo T_("Show server info"); ?></a>
   	<a class="btn" target='_blank' href="<?php echo \dash\url::here(); ?>/info/php"><?php echo T_("Show PHP info"); ?></a>
 </div>

<pre>apt install php8.0-fpm php8.0-cli php8.0-common</pre>
<pre>apt install php8.0-mbstring php8.0-gd php8.0-intl php8.0-xml php8.0-mysql php8.0-zip php8.0-curl php8.0-bz2 php8.0-soap php8.0-xmlrpc php8.0-gettext</pre>
<pre>apt install php-curl libwebp-dev php-yaml php-ssh2 php-imagick</pre>
<pre>apt install libwebp-dev</pre>

<div class="tblBox fs14">
	<table class="tbl1 v3">
		<?php foreach (\dash\data::phpIniInfo() as $key => $value) {?>

		<tr class="<?php if($value) {echo 'positive2';} else  {echo 'negative';}?>">
			<th><?php echo $key; ?></th>
			<td><code><?php echo $value; ?></code></td>
			<td><span class="<?php if($value) {echo 'sf-check fc-green';} else  {echo 'sf-times fc-red';}?>"></span></td>
		</tr>
	 	<?php } ?>
	</table>
</div>
