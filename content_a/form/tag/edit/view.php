<?php
namespace content_a\form\tag\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit tag'));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\data::dataRow_title());
		}

		$id = \dash\request::get('tid');

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::that(). '?'. \dash\request::fix_get());

		\dash\face::btnView(\dash\data::dataRow_url());
		\dash\face::btnSave('form1');

	}
}
?>