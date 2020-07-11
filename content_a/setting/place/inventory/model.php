<?php
namespace content_a\setting\place\inventory;


class model
{
	public static function post()
	{
		if(\dash\request::get('type') === 'add')
		{
			$post          = [];
			$post['name'] = \dash\request::post('title');
			$result        = \lib\app\inventory\add::add($post);

			if($result)
			{
				\dash\redirect::to(\dash\url::current());
			}

		}
		elseif(\dash\request::get('type') === 'edit')
		{
			$post         = [];
			$post['name'] = \dash\request::post('title');
			$result       = \lib\app\inventory\edit::edit($post, \dash\request::get('id'));

			if($result)
			{
				\dash\redirect::to(\dash\url::current());
			}

		}
		else
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
		}
	}
}
?>