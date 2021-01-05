<?php
namespace content_b1\posts\thumb;


class model
{
	public static function post()
	{
		\dash\temp::set('isApi', false);

		$file_thumb = \dash\upload\cms::set_post_thumb(\dash\coding::decode(\dash\request::get('id')));
		if(!$file_thumb)
		{
			\dash\notif::error(T_("Please upload a photo"));
			return false;
		}

		$post = [];

		$post['thumb'] = $file_thumb;

		$result = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}


	public static function delete()
	{
		$post = [];

		$post['thumb'] = null;

		$result = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		\content_b1\tools::say($result);

	}
}
?>