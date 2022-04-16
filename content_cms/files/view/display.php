<?php $dataRow = \dash\data::dataRow(); ?>
<div class="avand-md">

<?php if(a($dataRow, 'type') === 'video') { ?>
	  <video class="block mb-2" controls>
	    <source src="<?php echo a($dataRow, 'path'); ?>" type="<?php echo a($dataRow, 'mime'); ?>">
	  </video>
<?php } else if(a($dataRow, 'type') === 'audio') { ?>
  <audio class="block mb-2" controls>
    <source src="<?php echo a($dataRow, 'path'); ?>" type="<?php echo a($dataRow, 'mime'); ?>">
  </audio>
<?php } else if(a($dataRow, 'type') === 'image') { ?>
			<img class="block mb-2" src="<?php echo a($dataRow, 'thumb_raw'); ?>" alt="<?php echo a($dataRow, 'title') ?>">
<?php } else { ?>
<?php } ?>
	<nav class="items long">
		<ul>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Title") ?></div>
					<div class="value"><?php echo a($dataRow, 'filename') ?></div>
				</a>
			</li>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Type") ?></div>
					<div class="value"><?php echo a($dataRow, 't_type') ?></div>
<?php


$fType = 'file-earmark';
switch (a($dataRow, 'type'))
{
  case 'image':
    $fType = 'file-earmark-image';
    break;

  case 'audio':
    $fType = 'file-earmark-music';
    break;

  case 'video':
    $fType = 'file-earmark-play';
    break;

  case 'pdf':
    $fType = 'file-earmark-pdf';
    break;

  case 'zip':
    $fType = 'file-earmark-zip';
    break;

  default:
    $fType = 'file-earmark';
    break;
}
echo \dash\utility\icon::svg($fType, 'bootstrap');

?>
				</a>
			</li>
			<li>
				<div class="f item" data-copy="<?php echo a($dataRow, 'path') ?>">
					<div class="key"><?php echo T_("Path") ?></div>
					<div class="value ltr text-xs"><?php echo a($dataRow, 'path') ?> <a class="font-18 mL10" target="_blank" href="<?php echo a($dataRow, 'path') ?>"><i class="sf-link-external"></i></a></div>
					<i class="sf-link"></i>
				</div>
			</li>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("size") ?></div>
					<div class="value ltr"><?php echo \dash\fit::file_size(a($dataRow, 'size'), true); ?></div>
					<div class="go detail"></div>
				</a>
			</li>
			<?php if(a($dataRow, 'totalsize') && a($dataRow, 'size') !== a($dataRow, 'totalsize')) {?>
			<li>
				<a class="f item" href="<?php echo \dash\url::this(). '/images'. \dash\request::full_get() ?>">
					<div class="key"><?php echo T_("Total size") ?></div>
					<div class="value ltr"><?php echo \dash\fit::file_size(a($dataRow, 'totalsize'), true); ?></div>
					<div class="go"></div>
				</a>
			</li>
			<?php } //endif ?>

			<?php if(a($dataRow, 'ratio')) {?>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Ratio") ?></div>
					<div class="value"><?php $ratioTitle = \lib\ratio::ratio_title(a($dataRow, 'ratio')); if(!$ratioTitle) {$ratioTitle = round(a($dataRow, 'ratio'), 2);} echo \dash\fit::text($ratioTitle); ?></div>
				</a>
			</li>
			<?php } //endif ?>

			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Date created") ?></div>
					<div class="value ltr"><?php echo \dash\fit::date_time(a($dataRow, 'datecreated')) ?></div>
					<div class="go detail"></div>
				</a>
			</li>
			<?php if(\dash\data::usageCount()) {?>
			<li>
				<a class="f item">
					<div class="key"><?php echo T_("Usage count") ?></div>
					<div class="value"><?php echo \dash\fit::number(\dash\data::usageCount()) ?></div>
				</a>
			</li>

			<?php } //endif ?>
		</ul>
	</nav>
	<nav class="items long">
		<ul>
			<li>
				<a data-confirm data-data='{"remove": "remove"}' class="f item">
					<div class="key"><?php echo T_("Remove file") ?></div>
					<i class="sf-trash text-red-800"></i>
				</a>
			</li>
		</ul>
	</nav>

</div>
