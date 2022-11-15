<?php
$image = a(\dash\data::formDetail_resultpagesetting(), 'image');
if ($image)
{
	$image = \lib\filepath::fix($image);
}

?>
<?php if (a(\dash\data::formDetail_resultpagesetting(), 'status')) : ?>
    <div class="avand mb-4">
		<?php if (\dash\data::formDetail_resultpagetext() || $image) : ?>
            <div class="box">
                <div class="pad">
					<?php if ($image) : ?>
                        <img class="mb-2" src="<?php echo $image ?>" alt="<?php echo \dash\face::pageTitle(); ?>">
					<?php endif; ?>
					<?php if (\dash\data::formDetail_resultpagetext()): ?>
                        <div class="mb-4">
							<?php echo \dash\data::formDetail_resultpagetext(); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
		<?php endif; ?>
        <form method="get" class="mb-4 mt-4" action='<?php echo \dash\url::current(); ?>'>
            <div class="input">
                <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q"
                       value="<?php echo \dash\validate::search_string(); ?>" autocomplete='off'>
                <button class="addon btn "><?php echo T_("Search"); ?></button>
            </div>
        </form>
        <?php if(\dash\data::dataTable()) :?>
        <div class="tblBox">

            <table class="tbl1 v1">
                <thead>
                <tr>
					<?php foreach (\dash\data::col() as $item) : ?>
                        <th class><?php echo a($item, 'title'); ?></th>
					<?php endforeach; ?>
                    <?php if(a(\dash\data::formDetail_resultpagesetting(), 'showtotalamount')): ?>
                        <th class><?php echo T_("Total amount"); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) { ?>

                    <tr title="<?php echo $key ?>">
						<?php foreach (\dash\data::col() as $item => $item_title) : ?>
                            <td><?php if (a($value, $item))
								{
									echo a($value, $item);
								}
								else
								{
									echo '-';
								} ?></td>
						<?php endforeach; ?>
						<?php if(a(\dash\data::formDetail_resultpagesetting(), 'showtotalamount')): ?>

                            <td class><?php echo \dash\fit::number(a($value, 'totalamount')) ?> <smsll><?php echo \lib\store::currency() ?></smsll></td>
						<?php endif; ?>
                    </tr>
				<?php } //endif ?>
                </tbody>
            </table>
        </div>
		<?php \dash\utility\pagination::html(); ?>
        <?php else: ?>
            <div class="alert-warning text-center font-bold"><?php echo T_("No result found"); ?></div>
        <?php endif; ?>

    </div>
<?php else: ?>
    <div class="avand">
        <div class="alert-warning text-center font-bold"><?php echo T_("Result page for this form is blocked"); ?></div>
    </div>
<?php endif; ?>

