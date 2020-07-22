<?php
namespace content_a\category\property;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');
		if(\dash\request::post('save_default_property') === 'save_default_property')
		{
			$post        = [];
			$post['cat'] = \dash\request::post('cat');
			$post['key'] = \dash\request::post('key');
			\lib\app\category\add::property($post, $id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}



		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\category\add::remove_property(\dash\request::post('index'), $id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

	}
}
?>