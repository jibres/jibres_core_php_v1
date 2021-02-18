<?php
namespace content_a\setting\general\remove;


class model
{
	public static function post()
	{
		$post               = [];

		$post['subdomain'] = \dash\request::post('subdomain');

		\lib\app\store\remove::remove($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::sitelang());
		}

	}


}
?>