<?php
namespace content_crm\ticket\subject;


class model
{
	public static function post()
	{
		$id            = \dash\request::get('id');
		$post          = [];
		$post['title'] = \dash\request::post('title');

		\dash\app\ticket\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/view?id='.\dash\request::get('id'));
		}
	}
}
?>
