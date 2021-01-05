<?php
namespace content_b1\posts\cover;


class model
{
	public static function post()
	{
		\dash\temp::set('isApi', false);

		$file_cover = \dash\upload\cms::set_post_cover(\dash\coding::decode(\dash\request::get('id')));
		if(!$file_cover)
		{
			\dash\notif::error(T_("Please upload a photo"));
			return false;
		}

		$post = [];

		$post['cover'] = $file_cover;

		$result = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}


	public static function delete()
	{
		$post = [];

		$post['cover'] = null;

		$result = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		\content_b1\tools::say($result);

	}
}
?>