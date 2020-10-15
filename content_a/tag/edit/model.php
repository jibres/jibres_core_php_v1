<?php
namespace content_a\tag\edit;


class model
{
	public static function post()
	{



		$id = \dash\request::get('id');

		if(\dash\request::post('delete') === 'delete')
		{
			\lib\app\tag\remove::remove($id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}


		$args                  = [];
		$args['title']         = \dash\request::post('title');
		$args['slug']          = \dash\request::post('slug');


		$result = \lib\app\tag\edit::edit($args, $id);

		$add_product_id = \dash\request::post('add_product_id');

		if($add_product_id)
		{
			\lib\app\tag\add::product_tag_plus(\dash\request::get('id'), $add_product_id);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>