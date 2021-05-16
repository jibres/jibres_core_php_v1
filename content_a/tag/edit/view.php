<?php
namespace content_a\tag\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit tag'));


		$id = \dash\data::myId();

		\dash\data::back_text(T_('Tags'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnView(\dash\data::dataRow_url());
		\dash\face::btnSave('form1');

		\content_a\tag\property\view::load_property();

	}
}
?>