<?php
namespace content_b1\posts\gallery;


class model
{
	public static function post()
	{
		\dash\temp::set('isApi', false);

		$result = \content_cms\posts\edit\model::upload_gallery(\dash\request::get('id'), 'add_auto');

		\content_b1\tools::say($result);
	}


	public static function delete()
	{
		\dash\temp::set('isApi', false);

		$result = \content_cms\posts\edit\model::remove_gallery(\dash\request::get('id'), \dash\request::get('file_id'));

		\content_b1\tools::say($result);
	}
}
?>