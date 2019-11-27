<?php
namespace content_i\checkbook\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit checkbook"));
		\dash\data::page_desc(' ');
		\dash\data::page_pictogram('edit');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		$id     = \dash\request::get('id');
		$result = \lib\app\checkbook::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid checkbook id"));
		}

		if(isset($result['user_id']))
		{
			if(intval($result['user_id']) !== intval(\dash\user::id()))
			{
				\dash\header::status(403);
			}
		}

		\dash\data::dataRow($result);

		\dash\data::bankList(\lib\app\bank::list(null, ['pagenation' => false]));


	}
}
?>