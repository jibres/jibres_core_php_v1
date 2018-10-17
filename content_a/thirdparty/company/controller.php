<?php
namespace content_a\thirdparty\company;

class controller
{

	public static function routing()
	{
		\dash\permission::access('thirdpartyCompanyDetailView');
		\content_a\thirdparty\load::check_access();
	}
}
?>