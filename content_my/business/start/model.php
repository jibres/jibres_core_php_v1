<?php
namespace content_my\business\start;


class model
{
	public static function post()
	{
		$can = \dash\data::canAddStore();

		if(isset($can['can']) && $can['can'])
		{
			$title = \dash\validate::title(\dash\request::post('bt'));

			if(!$title)
			{
				\dash\notif::error(T_("Please enter name of your business"), 'bt');
				return false;
			}

			if(mb_strlen($title) >= 100)
			{
				\dash\notif::error(T_("Please fill the business title less than 100 character"), 'title');
				return false;
			}

			// \dash\session::set('createNewStore_title', $title, 'CreateNewStore');

			// \lib\app\store\timeline::clean();

			// \lib\app\store\timeline::set('start');

			\dash\redirect::to(\dash\url::this(). '/ask?'. \dash\request::fix_get(['title' => $title]));
			return;
		}
		else
		{

			\dash\log::oops('userCanNotAddNewStoreLimit', T_("Can not add new business!"));
			return false;
		}
	}
}
?>
