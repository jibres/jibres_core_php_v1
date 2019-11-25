<?php
namespace content_a\customer\company;

class controller
{

	public static function routing()
	{
		\dash\permission::access('customerCompanyDetailView');
		\content_a\customer\load::check_access();
	}
}
?>