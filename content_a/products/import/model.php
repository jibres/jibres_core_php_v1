<?php
namespace content_a\products\import;


class model
{
	public static function post()
	{
		if(\dash\request::post('import') === 'ok')
		{
			\lib\app\import\product::import_last_file();
		}
		else
		{
			\lib\app\import\add::product();
			\dash\redirect::pwd();
		}
	}
}
?>
