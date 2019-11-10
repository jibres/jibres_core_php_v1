<?php
namespace content_store\start;


class model
{
	public static function post()
	{
		$title = \dash\request::post('bt');

		if(!$title || !is_string($title))
		{
			\dash\notif::error(T_("Please enter name of your bissiness"), 'bt');
			return false;
		}

		if(mb_strlen($title) >= 100)
		{
			\dash\notif::error(T_("Please fill the store title less than 100 character"), 'title');
			return false;
		}

		// user try to add new process
		// set null the error variable to not load error page again
		\dash\session::set('createNewStore_error', null, 'CreateNewStore');

		\dash\session::set('createNewStore_title', $title, 'CreateNewStore');

		\lib\app\store\timeline::set('start');

		\dash\redirect::to(\dash\url::here(). '/ask');
		return;
	}
}
?>
