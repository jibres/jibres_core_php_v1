<?php
namespace content_a\products\next;


class controller
{
	public static function routing()
	{
		$subchild = \dash\url::subchild();
		if(!$subchild || !is_numeric($subchild))
		{
			\dash\redirect::to(\dash\url::this());
		}

		\dash\redirect::to(\lib\app\product\get::next($subchild));
	}
}
?>
