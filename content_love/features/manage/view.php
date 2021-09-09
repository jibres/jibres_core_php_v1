<?php
namespace content_love\features\manage;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Manage Business features"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/business');

		$features_list = \lib\features\business::admin_list(\dash\request::get('id'));

		\dash\data::featuresList($features_list);


	}
}
?>
