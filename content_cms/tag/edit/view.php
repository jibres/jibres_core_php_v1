<?php
namespace content_cms\tag\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit tag'));

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnView(\dash\data::dataRow_link());


	}
}
?>