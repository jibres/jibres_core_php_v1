<?php

$html = '';

$html .= '<div class="alert-info fs14">';
{
	$html .= T_("You can export your form answer to a CSV file to help with several tasks.");;
}
$html .= '</div>';

if(!\dash\data::countAll())
{
	$html .= '<p class="alert-warning fs14">'. T_("You have not any answer to export!"). '</p>';
}
else
{
	$html .= '<div class="msg f fs14">';
	{
		$html .= '<div class="cauto mLa5 s12">'. T_("Answer count"). ' <b>'. \dash\fit::number(\dash\data::countAll()). '</b></div>';

		$html .= '<div class="c mLa5">';
		{
			if(\dash\data::countAll() < 50)
			{
				$html .= '<a href="'. \dash\url::current(). '?id='. \dash\request::get('id'). '&download=now" data-direct class="mLa10 btn-link">'. T_("Download Now"). '</a>';
			}
			elseif(\dash\data::countAll() >= 50)
			{
				$html .= '<div class="btn-link" data-confirm data-data=\'{"export":"answer"}\' class="mLa10">'. T_("Send export request"). '</div>';
			}
		}
		$html .= '</div>';
	}
	$html .= '</div>';
}


$html .= '<div class="justify-center flex w-48">';
{
	$html .= '<img class="banner w300" src="'. \dash\url::cdn(). '/img/product/export1.png" align="'. T_("import answers"). '">';
}
$html .= '</div>';


echo $html;
?>


<?php if(\dash\data::exportList()) {?>

<h5><?php echo T_("Answer exported list"); ?></h5>
<div class="f fs12">

	<?php foreach (\dash\data::exportList() as $key => $value) {?>


		<div class="mLa10 c5 m12 s12">
			<div class="f msg align-center">
				<div class="cauto mRa10"><i class="sf-database fs14 text-green-700"></i></div>
				<div class="c sauto"><?php echo \dash\fit::date($value['datecreated']); ?></div>
				<div class="c s12"><?php echo \dash\fit::date_human($value['datecreated']); ?></div>
				<?php if(isset($value['status']) && $value['status'] == 'request') {?>

				<div class="c s12"><?php echo T_("Waiting to complete process..."); ?></div>

				<?php }else{ ?>

				<div class="cauto mRa10" data-confirm data-data='{"remove": "remove", "id": "<?php echo a($value, 'id') ?>"}'><i class="sf-trash fs14 text-red-800"></i></div>
				<div class="c s12"><small><?php echo T_("Status"); ?></small> <b><?php echo $value['tstatus']; ?></b></div>

				<?php }//endif ?>

				<div class="cauto mLa5">
					<?php if(isset($value['status']) && $value['status'] == 'done') {?>

					<a download class="btn-link" href="<?php echo a($value, 'download_link'); ?>"><?php echo T_("Download"); ?></a>

					<?php } //endif ?>
				</div>
			</div>


		</div>
	<?php } //endfor ?>
</div>

<?php } //endif ?>



