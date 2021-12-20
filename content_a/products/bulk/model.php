<?php
namespace content_a\products\bulk;


class model
{
	public static function post()
	{
		$id   = \dash\request::post('id');

		$post = [];

		foreach (\dash\request::post() as $key => $value)
		{
			if(substr($key, 0, 1) === '_')
			{
				$post[substr($key, 1)] = $value;
			}
		}

		if(!empty($post) && \dash\validate::id($id))
		{
			\lib\app\product\edit::edit($post, $id);

			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
				\dash\notif::complete();
			}
		}

	}
}
?>
