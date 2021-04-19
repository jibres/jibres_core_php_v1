<?php
namespace content_a\pagebuilder\choose;


class controller
{
	public static function routing()
	{
		$subchild = \dash\url::subchild();

		if(!$subchild)
		{
			\dash\header::status(404);
		}

		if(!in_array($subchild, ['header', 'footer']))
		{
			\dash\header::status(404);
		}

		if(\dash\url::dir(3))
		{
			\dash\header::status(404);
		}

		\dash\data::pagebuilderMode($subchild);

		\dash\open::get();
		\dash\open::post();

	}
}
?>