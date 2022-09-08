<?php if(\dash\data::dataTable()) : ?>
    <div class="tblBox">

        <table class="tbl1 v1">
            <thead>
            <tr>
				<?php foreach (\dash\data::col() as $item) : ?>
                    <th class><?php echo a($item, 'title'); ?></th>
				<?php endforeach; ?>
                <th class="collapsing"><?php echo T_("Print"); ?></th>
            </tr>
            </thead>
            <tbody>
			<?php foreach (\dash\data::dataTable() as $answer_id => $value) { ?>
                <tr>
					<?php foreach (\dash\data::col() as $item => $item_title) : ?>
                        <td><?php if(a($value, $item))
							{
								echo a($value, $item);
							}
							else
							{
								echo '-';
							} ?></td>
					<?php endforeach; ?>
                    <td class="collapsing">
                        <a class="btn-primary"
                           href="<?php echo \dash\url::that(). '/print' . \dash\request::full_get(['aid' => $answer_id]); ?>">
                            <?php echo T_("Print"); ?>
                        </a>
                    </td>
                </tr>
			<?php } //endif ?>
            </tbody>
        </table>
    </div>
	<?php \dash\utility\pagination::html(); ?>
<?php else: ?>
    <div class="alert-warning text-center font-bold"><?php echo T_("No result found"); ?></div>
<?php endif; ?>


