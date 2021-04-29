<?php
namespace content_a\pagebuilder\manage;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\pagebuilder\tools\remove::remove_page(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}

			return;
		}


		if(\dash\request::post('setas') === 'homepage')
		{
			\lib\pagebuilder\tools\homepage::set_as_homepage(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

			return;
		}

		$post = [];

		if(\dash\request::post('runaction_editstatus'))
		{
			$post['status'] = \dash\request::post('status');
		}

		if(\dash\request::post('runaction_edittitle'))
		{
			$post['title'] = \dash\request::post('title');
		}

		if(!empty($post))
		{
			$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

		}


	}
}
?>