<?php
namespace content_a\factor\prev;


class controller
{
	public static function routing()
	{
		$subchild = \dash\url::subchild();
		if(!$subchild || !is_numeric($subchild))
		{
			\dash\redirect::to(\dash\url::here());
		}

		\dash\redirect::to(\lib\app\factor\get::prev($subchild));
	}
}
?>
