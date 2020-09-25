<?php
namespace content_a\setting\domain2\manage;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. \dash\data::domainDetail_domain());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


		$dnsList = \lib\app\business_domain\dns::list(\dash\data::domainID());
		\dash\data::dnsList($dnsList);
		// var_dump($dnsList);exit();



	}
}
?>