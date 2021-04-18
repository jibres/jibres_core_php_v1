<?php
namespace content_a\pagebuilder\add;


class controller
{
	public static function routing()
	{
		$subchild = \dash\url::subchild();

		if(!$subchild)
		{
			$subchild = 'body';
		}

		if(!in_array($subchild, ['header', 'footer', 'body']))
		{
			\dash\header::status(404);
		}

		if(\dash\url::dir(3))
		{
			\dash\header::status(404);
		}

		\dash\open::get();
		\dash\open::post();

	}
}
?>
