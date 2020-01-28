<?php
namespace content_a\products\import;


class model
{
	public static function post()
	{

		\lib\app\import\add::product();
		\dash\redirect::pwd();
	}
}
?>
