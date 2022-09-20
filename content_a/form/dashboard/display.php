

<div class="row">
    <div class="c-xs-12 c-sm-12 c-md-4 c-lg-4 c-xl-3">
		<?php require_once(root . 'content_a/form/itemLink.php');
		?>
    </div>
    <div class="c-xs-12 c-sm-12 c-md-8 c-lg-8 c-xl-9">



        <div class="bg-white p-4 rounded mb-2">

            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900"><?php echo \dash\data::dataRow_title(); ?></h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500"><?php echo T_("Form Dashboard"); ?></p>
            </div>
			<?php foreach (\dash\data::dashboardDetail() as $item) : ?>

                <div class="mt-2 border-t border-gray-200">
                    <dl class="divide-y divide-gray-200">
                        <div class="py-2 sm:grid sm:grid-cols-3 sm:gap-4 sm:py-5">
                            <dt class="text-sm font-medium text-gray-500"><?php echo $item['title'] ?></dt>
                            <dd class="mt-1 flex text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <span class="flex-grow">
                                    <?php echo $item['value'] ?>
                                </span>
                                <span class="flex-grow">
                                    <?php echo a($item, 'value2') ?>
                                </span>
                                <?php if($item['link']): ?>
                                <span class="mx-2 flex-shrink-0">
                                    <a  href="<?php echo $item['url'] ?>"
                                            class="rounded-md bg-white font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        <?php echo $item['linkTitle'] ?>
                                    </a>
                                </span>
                                <?php endif; ?>
                            </dd>
                        </div>
                    </dl>
                </div>
			<?php endforeach; ?>

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

