<?php
namespace content_cms\posts\setting;

class model
{
	public static function post()
	{

		if(\dash\request::post('remove') === 'remove')
		{
			\dash\app\posts\remove::remove(\dash\request::get('id'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}


		$post = [];

		if(\dash\request::post('runaction_theme'))
		{
			$post['subtype'] = \dash\request::post('subtype');
		}

		if(\dash\request::post('runaction_comment'))
		{
			$post['comment'] = \dash\request::post('comment');
		}

		if(\dash\request::post('runaction_editstatus'))
		{
			$post['status'] = \dash\request::post_raw('status');
		}

		if(\dash\request::post('icon'))
		{
			$post['icon'] = \dash\request::post('icon');
		}

		if(!$post || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
