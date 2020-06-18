<?php
namespace content_my\domain\setting\holder;


class controller
{
	public static function routing()
	{
		\content_my\domain\setting\controller::routing();
		if(\dash\data::internationalDomain())
		{
			\dash\header::status(404);
		}
	}
}
?>