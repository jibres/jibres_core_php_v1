<?php
namespace content_my\ticket\view;

class controller extends \content_business\ticket\view\controller
{
	public static function routing()
	{
		parent::routing();
		\dash\temp::set('ticket_in_content_my', true);
	}
}
?>
