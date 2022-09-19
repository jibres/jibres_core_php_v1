<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">

		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
		<?php
		$dataTable = \dash\data::formItems();

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}
		?>

        <div class="alert2-info font-bold font-14"><?php echo T_("Drag the item and move it where you want to change the question sort. Items is sorted from left to right") ?></div>

        <form method="post" data-sortable data-willy class="ltr row">
			<?php foreach ($dataTable as $key => $value) { ?>
                <div class="c-xs-6 c-sm-6 c-md-4 c-xl-3 c-xxl-2">
                    <input type="hidden" name="sort[]" value="<?php echo a($value, 'id'); ?>">
                    <div class="m-1 relative bg-gray-200 border-gray-900 h-28 rounded-lg text-sm leading-8	p-1 overflow-ellipsis text-ellipsis overflow-hidden	cursor-move	transition sortHandle"
                         data-handle><?php echo \dash\fit::number($key + 1) . '. ' . a($value, 'title'); ?></div>
                </div>
			<?php } //endfor ?>
        </form>
    </div>