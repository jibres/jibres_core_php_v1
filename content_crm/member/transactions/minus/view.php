<?php
namespace content_crm\member\transactions\minus;

class view
{

	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_("Reduce account recharge"));
	}
}
?>