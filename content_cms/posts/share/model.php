<?php
namespace content_cms\posts\share;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$post         = [];

		$post['sharetext'] = \dash\request::post('sharetext');

		\dash\app\telegram\post::send($id, $post);
	}

}
?>