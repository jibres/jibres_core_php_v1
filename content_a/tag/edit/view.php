<?php
namespace content_a\tag\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit tag'));

		if(\dash\data::dataRow_title())
		{
			\dash\face::title(\dash\data::dataRow_title());
		}

		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnView(\dash\data::dataRow_link());
		\dash\face::btnSave('form1');

	}
}
?>