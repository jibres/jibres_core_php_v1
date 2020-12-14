<?php
namespace content_cms\category\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit category'));

		\dash\data::back_text(T_('Categories'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnView(\dash\data::dataRow_link());


	}
}
?>