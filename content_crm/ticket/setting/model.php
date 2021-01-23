<?php
namespace content_crm\ticket\setting;


class model
{
	public static function post()
	{
		$id   = \dash\request::get('id');
		$post = [];

		if(\dash\request::post('runaction_editstatus'))
		{
			$post['status'] = \dash\request::post('status');
		}

		if(\dash\request::post('runaction_editsolved'))
		{
			$post['solved'] = \dash\request::post('solved');
		}

		if(!empty($post))
		{
			\dash\app\ticket\edit::edit($post, $id);
		}

		if(\dash\engine\process::status())
		{
			if(isset($post['status']) && in_array($post['status'], ['deleted', 'spam']))
			{
				\dash\redirect::to(\dash\url::this());
			}

			\dash\redirect::pwd();
		}
	}
}
?>
