<?php
namespace content_a\form\analytics\remove;


class controller extends \content_a\form\analytics\controller
{
	public static function routing()
	{
		parent::routing();

		\content_a\form\analytics\controller::form_id();
	}

}
?>
