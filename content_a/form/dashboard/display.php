<div class="row">
    <div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root . 'content_a/form/itemLink.php');
		?>
    </div>
    <div class="c-xs-12 c-sm-12 c-md-8">

        <?php require_once(root . 'content_a/form/formTitle.php'); ?>

        <div class="box">
            <div class="pad">
                <?php echo T_("To make duplicate from this form"); ?>
                <a class="btn-link" href="<?php echo \dash\url::this(). '/duplicate?id='. \dash\request::get('id') ?>"><?php echo T_("click here"); ?></a>
            </div>
        </div>

        <form method="post" action="<?php echo \dash\url::this() ?>">
            <div class="box">
                <div class="pad">
                    <input type="hidden" name="findanswerid" value="findanswerid">
                    <label for="aid"><?php echo T_("Find answer detail by id") ?></label>
                    <div class="input">
                        <input type="number" name="aid" placeholder="<?php echo T_("Answer id") ?>" id="aid">
                    </div>
                </div>
                <footer class="">
                    <div class="row">
                        <div class="c-auto">
							<?php if(\lib\app\form\form\get::enterpriseSpecialFormBuilder()) : ?>
                                <a class="btn-primary"
                                   href="<?php echo \dash\url::this() . '/find?id=' . \dash\request::get('id') ?>"><?php echo T_("Find & Print"); ?></a>
							<?php endif; ?>
                        </div>
                        <div class="c"></div>
                        <div class="c-auto">
                            <button class="btn"><?php echo T_("Go") ?></button>
                        </div>
                    </div>

                </footer>
            </div>
        </form>



        <div class="text-gray-500 text-sm">
			<?php if(\dash\data::dataRow_privacy() === 'private') { ?>
                <div>
					<?php
					echo T_("This is a private form. Cannot use independently") . '<br>';

					if(floatval(\dash\request::get('id')) === floatval(\lib\store::detail('shipping_survey')))
					{
						echo T_("This form used in shipping page");
					}
                    elseif(floatval(\dash\request::get('id')) === floatval(\lib\store::detail('satisfaction_survey')))
					{
						echo T_("This form used for satisfaction after register order");
					}
					?>
                </div>
			<?php } else { ?>
                <div class="p-4 bg-white rounded">
                    <div class="mb-2">
						<?php echo T_("Using this short code, you can use this form in the description of the product or post or site builder") ?>
                    </div>
					<?php $short_code = "[form id=" . \dash\request::get('id') . "]" ?>
                    <code data-copy="<?php echo $short_code ?>"><?php echo $short_code ?></code>
                </div>
			<?php } //endif ?>
        </div>
    </div>
</div>

