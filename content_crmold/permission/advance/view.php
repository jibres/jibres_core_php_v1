<?php
namespace content_crm\permission\advance;


class view
{
	public static function config()
	{
		\dash\permission::access('cpPermissionAdd');

		\dash\face::title(T_("Edit permissions"));

		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));
		\dash\data::back_text(T_('Back'));

		$savedPerm = \dash\data::dataRow_value();
		if(!is_array($savedPerm))
		{
			$savedPerm = [];
		}


		\dash\data::savedPerm($savedPerm);



	}
}
?>