<div id='content' class='scr'>
<?php
	require_once ('admin-titlebox.php');
	if(\dash\data::listEngine())
	{
		if(\dash\data::listEngine_before() && is_string(\dash\data::listEngine_before()) && is_file(\dash\data::listEngine_before()))
		{
			require_once \dash\data::listEngine_before();
		}

		if(\dash\data::dataTable())
		{
		    require_once(core. 'layout/search/search-bar.php');
		    require_once \dash\layout\func::display();
		}
		else
		{
		  if(\dash\data::isFiltered() || \dash\request::get('q'))
		  {
		    require_once(core. 'layout/search/search-bar.php');
		    require_once(core. 'layout/search/search-empty.php');
		  }
		  else
		  {
		    require_once(core. 'layout/tools/display-start.php');
		  }
		}
	}
	else
	{
		require_once \dash\layout\func::display();
	}
?>
</div>