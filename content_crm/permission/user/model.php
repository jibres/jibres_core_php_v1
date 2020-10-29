<?php
namespace content_crm\permission\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\dash\app\permission\remove::remove(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
		}

		$post          = [];
		$post['title'] = \dash\request::post('title');

		$result = \dash\app\permission\edit::edit_title($post, \dash\request::get('id'));

		if(isset($result['id']))
		{
			\dash\redirect::pwd();
		}


	}
}
?>