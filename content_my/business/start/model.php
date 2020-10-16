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
				\dash\log::set('business_creatingNew', ['my_step' => 'start', 'my_title' => null, 'my_message' => T_("Please enter name of your business")]);
				\dash\notif::error(T_("Please enter name of your business"), 'bt');
				return false;
			}

			if(mb_strlen($title) >= 100)
			{
				\dash\log::set('business_creatingNew', ['my_step' => 'start', 'my_title' => null, 'my_message' => T_("Please fill the business title less than 100 character")]);
				\dash\notif::error(T_("Please fill the business title less than 100 character"), 'title');
				return false;
			}

			\dash\log::set('business_creatingNew', ['my_step' => 'start', 'my_title' => $title]);

			\dash\redirect::to(\dash\url::this(). '/ask?'. \dash\request::fix_get(['title' => $title, 'st1' => time()]));
			return;
		}
		else
		{

			$title = \dash\validate::title(\dash\request::post('bt'), false);
			\dash\log::set('business_creatingNew', ['my_step' => 'start', 'my_title' => $title, 'my_message' => T_("Can not add new business!"), 'my_business_limit' => true]);
			\dash\log::oops('userCanNotAddNewStoreLimit', T_("Can not add new business!"));
			return false;
		}
	}
}
?>
