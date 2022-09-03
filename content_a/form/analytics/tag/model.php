<?php
namespace content_a\form\analytics\tag;


class model
{

	public static function post()
	{
		if (\dash\request::post('addtagtoall') === 'addtagtoall')
		{
			$post                  = [];
			$post['tag']           = \dash\request::post('tag');
			$post['type']          = \dash\request::post('type');
			$post['taglimitcount'] = \dash\request::post('taglimitcount');
			$post['randomtag']     = \dash\request::post('randomtag');
			$post['filter_id']     = \dash\request::get('fid');
			$post['form_id']       = \dash\request::get('id');

			\lib\app\form\tag\add::to_filter($post);

			if (\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}


	}

}

?>
