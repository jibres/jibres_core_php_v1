<?php
if(\dash\data::dataTable())
{
	if(\dash\data::isFiltered())
	{
		htmlSearchBox();
		htmlTable();
		htmlFilter();
	}
	else
	{
		htmlSearchBox();
		htmlTable();
	}
}
else
{
	if(\dash\data::isFiltered())
	{

		htmlSearchBox();
		htmlFilter();
	}
	else
	{
		htmlStartAddNew();

	}

}
?>
<?php function htmlTable()
{ ?>

	<?php
	$dataTable = \dash\data::dataTable();
	if(!is_array($dataTable))
	{
		$dataTable = [];
	}
	?>
    <nav class="items">
        <ul>
			<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
                <li>
                    <a class="f"
                       href="<?php echo \dash\url::that() . '/edit?' . \dash\request::fix_get(['tid' => a($value, 'id')]); ?>">
                        <div class="key" title='<?php echo a($value, 'full_slug'); ?>'>
							<?php echo a($value, 'title');
							if(a($value, 'autocomment'))
							{
								echo ' 💬 ';
							}

							if(a($value, 'sendsms'))
							{
								echo ' 📱 ';
							}

							?>

                        </div>

                        <div class="value">
							<?php if(a($value, 'isdefault')): ?>
                                <small class="text-gray-400"
                                       title="<?php echo T_("By default, this tag is added to all new answer"); ?>">
									<?php echo T_("Default") ?>
                                </small>

							<?php endif; ?>
                        </div>
                        <div class="value"><?php echo \dash\fit::number(a($value, 'count')); ?>
                            <small><?php echo T_("Answer"); ?></small></div>
                        <div class="go"></div>
                    </a>
                </li>
			<?php } //endfor ?>
        </ul>
    </nav>
	<?php \dash\utility\pagination::html(); ?>
<?php } //endfunction ?>

<?php function htmlSearchBox()
{ ?>
    <form method="get" autocomplete="off" action="<?php echo \dash\url::that(); ?>">
        <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
        <div class="searchBox">
            <div class="f">
                <div class="c pRa10">
                    <div>
                        <div class="input search <?php if(\dash\validate::search_string()) {
							echo 'apply';
						} ?>">
                            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q"
                                   value="<?php echo \dash\validate::search_string() ?>" class="barCode" data-default
                                   data-pass='submit' autocomplete='off'>
                            <button class="addon btn-light3 s0"><i class="sf-search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="cauto">
                    <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) {
						echo 'apply';
					} ?>" data-link>
                        <option value="<?php echo \dash\url::that() . '?' . \dash\request::fix_get(['sort'  => null,
																									'order' => null,
							]); ?>"><?php echo T_("Sort"); ?></option>
                        <option value="<?php echo \dash\url::that() . '?' . \dash\request::fix_get(['sort'  => 'title',
																									'order' => 'asc',
							]); ?>" <?php if(\dash\request::get('sort') === 'title' && \dash\request::get('order') === 'asc') {
							echo 'selected';
						} ?>><?php echo T_("Sort by Title ASC") ?></option>
                        <option value="<?php echo \dash\url::that() . '?' . \dash\request::fix_get(['sort'  => 'title',
																									'order' => 'desc',
							]); ?>" <?php if(\dash\request::get('sort') === 'title' && \dash\request::get('order') === 'desc') {
							echo 'selected';
						} ?>><?php echo T_("Sort by Title DESC") ?></option>
                    </select>
                </div>
            </div>
        </div>
    </form>

<?php } //endfunction ?>

<?php function htmlFilter()
{ ?>
    <p class="f fs14 alert-warning">
        <span class="c"><?php echo \dash\data::filterBox(); ?></span>
        <a class="cauto"
           href="<?php echo \dash\url::that() . '?id=' . \dash\request::get('id'); ?>"><?php echo T_("Clear filters"); ?></a>
    </p>

<?php } //endfunction ?>


<?php function htmlStartAddNew()
{ ?>
    <div class="alert-info p-4 rounded">
        <p><?php echo T_("Hi!"); ?></p>
        <p><?php echo T_("No tag founded."); ?> </p>
        <p>
            <a href="<?php echo \dash\url::that() . '/add?id=' . \dash\request::get('id') ?>"><?php echo T_("Try to start with add new tag!"); ?></a>
        </p>
    </div>
<?php } //endfunction ?>