<?php
namespace content_a\tag\property;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('itemsort') === 'itemsort')
		{
			\lib\app\tag\edit::set_sort_property(\dash\request::post('sortgroup'), \dash\request::post('sortkey'), $id);
			return;
		}

		if(\dash\request::post('save_default_property') === 'save_default_property')
		{
			$post        = [];
			$post['cat'] = \dash\request::post('cat');

			\dash\session::set('fill_category_property', $post['cat'], null, 60);

			$post['key'] = \dash\request::post('key');
			\lib\app\tag\add::property($post, $id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}



		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\tag\add::remove_property(\dash\request::post('index'), $id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

	}
}
?>