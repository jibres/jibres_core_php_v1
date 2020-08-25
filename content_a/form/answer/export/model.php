<?php
namespace content_a\products\export;


class model
{
	public static function post()
	{
		\lib\app\product\export::queue();
		\dash\redirect::pwd();
	}
}
?>
