<div class="row">
    <div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root . 'content_a/form/itemLink.php');
		?>
    </div>
    <div class="c-xs-12 c-sm-12 c-md-8">

		<?php require_once(root . 'content_a/form/formTitle.php'); ?>

		<?php if(\dash\data::formItems()) { ?>
            <h3><?php echo T_("Items") ?></h3>
            <nav class="items long">
                <ul>
					<?php foreach (\dash\data::formItems() as $key => $value) { ?>
                        <li>
                            <a class="f"
                               href="<?php echo \dash\url::this() . '/item?id=' . \dash\request::get('id') . '&item=' . a($value, 'id') ?>">
                                <div class="key">
									<?php if(a($value, 'require')) { ?><span class="text-red-800">*</span><?php } ?>
									<?php if(a($value, 'hidden')) { ?>
                                        <span class="text-gray-400">
										<?php echo a($value, 'title'); ?>
									</span>
									<?php } else { ?>
										<?php echo a($value, 'title'); ?>
									<?php } //endif ?>
                                </div>
                                <div class="value">
									<?php echo a($value, 'type_detail', 'title'); ?>
                                </div>
                                <div class="go"></div>
                            </a>
                        </li>

					<?php } //endif ?>
                </ul>
            </nav>
		<?php }// endif ?>


    </div>
