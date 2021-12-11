<?php
namespace content_a\setting\search;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		if(\dash\url::subchild() === 'full' && !\dash\url::dir(3))
		{
			\dash\open::get();
			\lib\app\quickaccess\search::search_in_all();
		}
		else
		{
			\lib\app\quickaccess\search::search_in_setting();
		}

	}
}
?>