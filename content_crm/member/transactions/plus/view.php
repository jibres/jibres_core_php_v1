<?php
namespace content_crm\member\transactions\plus;

class view
{

	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_("Increase account recharge"));
	}
}
?>