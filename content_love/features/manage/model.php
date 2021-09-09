<?php
namespace content_love\features\manage;


class model
{
	public static function post()
	{
		if(\dash\request::post('addfeatures'))
		{
			$feature     = \dash\request::post('features');
			$business_id = \dash\request::get('id');

			\lib\features\add::add($business_id, $feature);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}



	}
}
?>
