<?php
namespace content_a\category\edit;


class model
{
	public static function post()
	{


		// if(\dash\request::post('save_default_property') === 'save_default_property')
		// {
		// 	$post        = [];
		// 	$post['cat'] = \dash\request::post('cat');
		// 	$post['key'] = \dash\request::post('key');
		// 	\lib\app\category\add::property($post, \dash\data::myId());
		// 	if(\dash\engine\process::status())
		// 	{
		// 		\dash\redirect::pwd();
		// 	}
		// 	return;
		// }


		$id = \dash\data::myId();

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
				\dash\notif::ok(T_("Category image removed"));
				\dash\redirect::pwd();
			}
			return;
		}

		$args                  = [];
		$args['title']         = \dash\request::post('title');
		$args['slug']          = \dash\request::post('slug');
		// $args['parent']     = \dash\request::post('parent');
		$args['desc']          = \dash\request::post('desc');
		$args['seotitle']      = \dash\request::post('seotitle');
		$args['seodesc']       = \dash\request::post('seodesc');



		$file = \dash\upload\category::set($id);
		if($file)
		{
			$args['file'] = $file;
		}

		$result = \lib\app\category\edit::edit($args, $id);

		$add_product_id = \dash\request::post('add_product_id');

		if($add_product_id)
		{
			\lib\app\category\add::product_cat_plus(\dash\data::myId(), $add_product_id);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>