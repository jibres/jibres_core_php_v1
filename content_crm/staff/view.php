<?php
namespace content_crm\staff;

class view extends \content_crm\member\home\view
{

	public static function config()
	{
		parent::config();

		\dash\face::title(T_("Staff List"));

		\dash\data::action_link(null);
		\dash\data::action_text(null);
	}



}
?>