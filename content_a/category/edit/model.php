<?php
namespace content_a\category\edit;


class model
{
	public static function post()
	{

		$id = \dash\request::get('id');

		if(\dash\request::post('delete') === 'delete')
		{
			\lib\app\category\remove::remove($id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}

		if(\dash\request::post('deletefile'))
		{
			\lib\app\category\remove::remove_file($id);

			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Category file deleted"));
				\dash\redirect::pwd();
			}
			return;
		}

		$args                   = [];
		$args['title']          = \dash\request::post('title');
		$args['slug']           = \dash\request::post('slug');
		$args['parent']         = \dash\request::post('parent');
		$args['desc']           = \dash\request::post('desc');
		$args['seotitle']       = \dash\request::post('seotitle');
		$args['seodesc']        = \dash\request::post('seodesc');
		// $args['property_group'] = \dash\request::post('property_group');
		// $args['property_key']   = \dash\request::post('property_key');

		$property = [];

		$post = \dash\request::post();
		foreach ($post as $key => $value)
		{
			if(substr($key, 0, 15) === 'property_group_')
			{
				if(\dash\request::post('property_key_'. substr($key, 15)))
				{
					$property[$value] = \dash\request::post('property_key_'. substr($key, 15));
				}
			}
		}


		$file = \dash\upload\category::set($id);
		if($file)
		{
			$args['file'] = $file;
		}

		$result = \lib\app\category\edit::edit($args, $id, $property);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>