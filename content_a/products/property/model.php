<?php
namespace content_a\products\property;


class model
{

	public static function post()
	{

		$id = \dash\request::get('id');

		// if(\dash\request::post('remove') === 'remove')
		// {
		// 	\lib\app\product\property::remove(\dash\request::post('pid'), $id);
		// 	if(\dash\engine\process::status())
		// 	{
		// 		\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
		// 	}
		// 	return;
		// }

		if(\dash\request::post('outstanding') === 'outstanding')
		{
			\lib\app\product\property::outstanding(\dash\request::post('pid'), $id, \dash\request::post('type'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		$post = \dash\request::post();
		$multiproperty = [];
		foreach ($post as $key => $value)
		{
			if($value)
			{
				if(substr($key, 0, 4) === 'cat_' || substr($key, 0, 4) === 'key_' || substr($key, 0, 6) === 'value_')
				{
					$myKey = substr($key, 4);
					$myIndex = substr($key, 0, 3);
					if(substr($key, 0, 6) === 'value_')
					{
						$myKey = substr($key, 6);
						$myIndex = substr($key, 0, 5);
					}

					if(!isset($multiproperty[$myKey]))
					{
						$multiproperty[$myKey] = [];
					}

					$multiproperty[$myKey][$myIndex] = $value;
				}
			}
		}

		$multiproperty = array_values($multiproperty);
		\lib\app\product\property::add_multi($multiproperty, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}



	}
}
?>