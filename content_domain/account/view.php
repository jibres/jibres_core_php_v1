<?php
namespace content_domain\account;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add account"));

		\dash\data::page_special(true);


		// btn
		\dash\data::page_btnText(T_('Add account'));
		\dash\data::page_btnLink(\dash\url::this(). '/add');
	}
}
?>