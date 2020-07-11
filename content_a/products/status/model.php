<?php
namespace content_a\products\status;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('delete') === 'product')
		{
			$result = \lib\app\product\remove::product($id);
			if($result)
			{
				\dash\redirect::to(\lib\backlink::products());
			}
			return true;
		}


		$post                = [];

		$post['status']     = \dash\request::post('status');

		\lib\app\product\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}




}
?>