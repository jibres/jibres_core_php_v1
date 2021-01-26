<?php
namespace content_crm\member\business;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_('Edit jibres business user detail'));

		\dash\data::defaultBusinessCount(\dash\app\user\business::businesscount());

	}
}
?>