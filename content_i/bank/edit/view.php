<?php
namespace content_i\bank\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit bank account detail"));
		\dash\data::page_desc(' ');
		\dash\data::page_pictogram('edit');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back'));

		$id     = \dash\request::get('id');
		$result = \lib\app\bank::get($id);
		if(!$result)
		{
			\dash\header::status(403, T_("Invalid bank id"));
		}

		if(isset($result['user_id']))
		{
			if(intval($result['user_id']) !== intval(\dash\user::id()))
			{
				\dash\header::status(403);
			}
		}

		\dash\data::dataRow($result);

		if(\dash\data::dataRow_bank())
		{
			\dash\data::dataRow_pos(\dash\data::dataRow_bank());
		}


		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

	}
}
?>