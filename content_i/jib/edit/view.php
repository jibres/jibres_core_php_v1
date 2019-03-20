<?php
namespace content_i\jib\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit jib"));
		\dash\data::page_desc(T_("Edit jib detail"));
		\dash\data::page_pictogram('edit');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		$id     = \dash\request::get('id');
		$result = \lib\app\jib::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid jib id"));
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