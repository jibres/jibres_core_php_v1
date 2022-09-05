<?php if (a(\dash\data::formDetail_resultpagesetting(), 'status')) : ?>
    <div class="avand">
		<?php if (\dash\data::formDetail_resultpagetext()) : ?>
            <div class="msg">
				<?php echo \dash\data::formDetail_resultpagetext(); ?>
            </div>
		<?php endif; ?>
        <form method="get" class="mb-4 mt-4" action='<?php echo \dash\url::current(); ?>'>

            <div class="input">
                <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q"
                       value="<?php echo \dash\validate::search_string(); ?>" autocomplete='off'>
                <button class="addon btn "><?php echo T_("Search"); ?></button>
            </div>
        </form>

        <div class="tblBox">

            <table class="tbl1 v1">
                <thead>
                <tr>
					<?php foreach (\dash\data::col() as $item) : ?>
                        <th class><?php echo a($item, 'title'); ?></th>
					<?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
                    <tr>
						<?php foreach (\dash\data::col() as $item => $item_title) : ?>
                            <td><?php if (a($value, $item)) {
									echo a($value, $item);
								} else {
									echo '-';
								} ?></td>
						<?php endforeach; ?>
                    </tr>
				<?php } //endif ?>
                </tbody>
            </table>
        </div>
		<?php \dash\utility\pagination::html(); ?>

    </div>
<?php else: ?>
    <div class="avand">
        <div class="alert-warning text-center font-bold"><?php echo T_("Result page for this form is blocked"); ?></div>
    </div>
<?php endif; ?>

