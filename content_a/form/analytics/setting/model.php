<?php
namespace content_a\form\analytics\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('addtagtoall') === 'addtagtoall')
		{
			$post              = [];
			$post['tag']       = \dash\request::post('tag');
			$post['type']      = \dash\request::post('type');
			$post['filter_id'] = \dash\request::get('fid');
			$post['form_id']   = \dash\request::get('id');

			\lib\app\form\tag\add::to_filter($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}


		if(\dash\request::post('removefilter') === 'removefilter')
		{
			\lib\app\form\filter\remove::remove(\dash\request::get('fid'));
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			return;
		}


		$post = \dash\request::post();
		\lib\app\form\filter\edit::fields(\dash\request::get('id'), $post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}


	}

}
?>
