<?php
namespace content_store\start;


class model
{
	public static function post()
	{
		$can = \dash\data::canAddStore();
		if(isset($can['can']) && $can['can'])
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

			\dash\session::set('createNewStore_title', $title, 'CreateNewStore');

			\lib\app\store\timeline::set('start');

			\dash\redirect::to(\dash\url::here(). '/ask');
			return;
		}
		else
		{
			\dash\notif::error(T_("Can not add new store!"));
			return false;
		}
	}
}
?>
