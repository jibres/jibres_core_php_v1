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

			if($post['status'] === 'draft')
			{
				$get       = \dash\request::get();
				$load_line = \lib\pagebuilder\tools\search::list($get);


				if(a($load_line, 'post_detail', 'ishomepage'))
				{
					\dash\notif::error(T_("Can not draft homepage"));
					return false;
				}
			}
		}

		if(\dash\request::post('runaction_edittitle'))
		{
			$post['title'] = \dash\request::post('title');
		}

		if(\dash\request::post('runaction_edittitle'))
		{
			$post['title'] = \dash\request::post('title');
		}

		if(\dash\request::post('runaction_edittemplate'))
		{
			$post['template'] = \dash\request::post('template');
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