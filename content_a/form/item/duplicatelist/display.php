<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
        <div class="avand-md">
            <div class="box">
                <div class="body">
					<?php $itemDetail = \dash\data::itemDetail(); ?>
                    <label for="item_uniquelist_<?php echo a($itemDetail, 'id') ?>">
						<?php
						switch ($itemDetail['type'])
						{
							case 'nationalcode':
								$title        = T_("Prohibition of registration for the following nationalcode");
								$input        =
									'<input type="tel" name="duplicateitem" id="duplicateitem" placeholder="' . T_("Enter nationalcode") . '" data-format="nationalCode" >';
								$input_search =
									'<input type="tel" name="q" id="q" value="' . \dash\validate::search_string() . '" placeholder="' . T_("Search in nationalcode") . '" data-format="nationalCode" >';
								break;

							case 'mobile':
								$title        = T_("Prohibition of registration for the following mobile phone number");
								$input        =
									'<input type="tel" name="duplicateitem" id="duplicateitem" placeholder="' . T_("Enter mobile") . '" data-format="mobile">';
								$input_search =
									'<input type="tel" name="q" id="q" value="' . \dash\validate::search_string() . '" placeholder="' . T_("Search in mobile") . '" data-format="mobile" >';
								break;

							case 'email':
								$title        = T_("Prohibition of registration for the following email address");
								$input        =
									'<input type="email" name="duplicateitem" id="duplicateitem" placeholder="' . T_("Enter email") . '">';
								$input_search =
									'<input type="email" name="q" id="q" value="' . \dash\validate::search_string() . '" placeholder="' . T_("Search in email") . '">';
								break;

							default:
								$title        = T_("Prohibition of registration for the following answer");
								$input        =
									'<input type="text" name="duplicateitem" id="duplicateitem" placeholder="' . T_("Enter answer") . '">';
								$input_search =
									'<input type="text" name="q" id="q" value="' . \dash\validate::search_string() . '" placeholder="' . T_("Search") . '">';
								break;
						}
						echo $title;
						?>
                    </label>
                    <form method="post" autocomplete="off">
                        <div class="input">
							<?php echo $input ?>
                            <button class="btn-primary addon"><?php echo T_("Add") ?></button>
                        </div>
                    </form>
                    <p class="text-gray-400"><?php echo T_('In addition to checking the non-duplication of this item in the list of previous answers, you can manually enter the list of items that you think are duplicate so that they are not registered.') ?></p>
                    <hr class="mt-6">
                    <p class="">
						<?php echo T_('Import data from file') ?>
                        <br>
                    <form method="post" autocomplete="off">
                        <input type="hidden" name="import" value="file">
                        <input type="file" name="duplicatelist">
                        <button class="btn-primary"><?php echo T_("Import") ?></button>
                    </form>
                    </p>

                    <hr class="mt-6 mb-2">
                    <form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>">
						<?php foreach (\dash\request::get() as $key => $value)
						{
							if($key === 'q')
							{
								continue;
							}
							echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
						}
						?>
                        <div class="input">
							<?php echo $input_search ?>
                            <button class="addon btn-primary"><?php echo T_("Search") ?></button>
                        </div>
                    </form>

                </div>
            </div>

			<?php if(a($itemDetail, 'uniquelist'))
			{
				$uniqueList = explode(',', $itemDetail['uniquelist']);
				?>
                <form method="post" autocomplete="off">
                    <input type="hidden" name="sortable" value="sortable">
                    <div class="tblBox font-14">
                        <table class="tbl1 v4">
                            <tbody data-sortable>
							<?php
							$find_anything = false;
							$i             = 0;
							foreach ($uniqueList as $key => $value)
							{
								$i++;

								if(\dash\request::get('q'))
								{
									if(
										$value == \dash\request::get('q') ||
										$value == \dash\validate::nationalcode(\dash\request::get('q'), false) ||
										$value == \dash\validate::mobile(\dash\request::get('q'), false)
									)
									{
										$find_anything = true;
										echo '<tr>';
										echo '<td>';
										echo $value;
										echo '</td>';
										echo '<td class="collapsing">';
										echo '<div class="btn-link-danger" data-confirm data-data=\'{"remove": "remove", "value" : "' . $value . '"}\'>' . \dash\utility\icon::svg_delete() . '</div>';
										echo '</td>';
										echo '</tr>';
									}
								}
								else
								{
									if($i >= 10)
									{
										echo '<tr>';
										echo '<td>';
										echo '<small><i>' . T_("+:count items", ['count' => \dash\fit::number(count($uniqueList) - $i + 1)]) . '</i></small>';
										echo '</td>';
										echo '<td class="collapsing"> ... </td>';
										echo '</tr>';
										break;
									}
									echo '<tr>';
									echo '<td>';
									echo $value;
									echo '</td>';
									echo '<td class="collapsing">';
									echo '<div class="btn-link-danger" data-confirm data-data=\'{"remove": "remove", "value" : "' . $value . '"}\'>' . \dash\utility\icon::svg_delete() . '</div>';
									echo '</td>';
									echo '</tr>';

								}

							}

							if(\dash\request::get('q') && !$find_anything)
							{
								echo '<tr>';
								echo '<td>';
								echo '<small><i>' . T_("No results found") . '</i></small>';
								echo '</td>';
								echo '<td class="collapsing"> </td>';
								echo '</tr>';
							}
							//endfor ?>
                            </tbody>
                        </table>
                    </div>
                </form>
			<?php } //endif ?>
        </div>
    </div>