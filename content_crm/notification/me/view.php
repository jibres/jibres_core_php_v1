<?php
namespace content_crm\notification\me;

class view extends \content_account\notification\view
{

	public static function config()
	{
		parent::config();

		\dash\face::title(T_("My Notifications"));

		// back
		\dash\data::back_text(T_('Notifications'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>