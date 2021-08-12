<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
	$dataTable = [];
}
?>

<div class="tblBox">

  <table class="tbl1 v4 fs12">
    <thead>
      <tr class="fs08">
		<th><?php echo T_("Customer"); ?></th>
		<th class="txtC"><?php echo T_("Credit"); ?></th>
		<th><?php echo T_("Status"); ?></th>
		<th><?php echo T_("Last login date"); ?></th>
		<th><?php echo T_("Pricing"); ?></th>
		<th class="collapsing"><?php echo T_("Action"); ?></th>
      </tr>
    </thead>

    <tbody>
    	<?php foreach ($dataTable as $key => $value) {?>


      <tr
      		<?php if(isset($value['status']) && $value['status'] === 'Removed') {?> class='negative'
      		<?php }elseif(isset($value['status']) && $value['status'] === 'Disabled') {?> class="warning"
      		<?php }else{ ?>  class="active" <?php } ?>>
		<td>
			<div class="txtB fs14"><?php echo a($value, 'fullname'); ?></div>
			<div class="badge light"><?php echo a($value, 'username'); ?></div>
			<div class="badge light"><?php echo \dash\fit::mobile(a($value, 'mobile')); ?></div>
		</td>

		<td class="txtB txtC">
			<div><?php echo \dash\fit::number(a($value, 'remaincredit')); ?></div>
			<div class="badge light"> <?php echo T_("Minimum allow credit"); ?> <?php echo \dash\fit::number(a($value, 'mininumallowedcredit')); ?></div>
		</td>

		<td><?php echo T_(a($value, 'status')); ?></td>
		<td><?php echo \dash\fit::date(a($value, 'lastlogindate')); ?></td>

		<td>
			<span class="badge light"><?php echo T_("Pricing name"); ?> <?php echo a($value, 'pricingname'); ?></span>
			<span class="badge light"><?php echo T_("Sms Farsi cost"); ?> <?php echo \dash\fit::number(a($value, 'smsfarsicost')); ?></span>
			<span class="badge light"><?php echo T_("Sms English cost"); ?> <?php echo \dash\fit::number(a($value, 'smsenglishcost')); ?></span>
			<span class="badge light"><?php echo T_("Call local cost"); ?> <?php echo \dash\fit::number(a($value, 'calllocalcost')); ?></span>
		</td>
		<td class="collapsing">
			<a class="btn xs" href="<?php echo \dash\url::this(); ?>/edit?apikey=<?php echo a($value, 'apikey'); ?>"><?php echo T_("Detail"); ?></a>

      	</td>
      </tr>

  	<?php } //endif ?>
    </tbody>
  </table>
 <?php \dash\utility\pagination::html(); ?>
 </div>

