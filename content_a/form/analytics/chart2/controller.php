<?php
namespace content_a\form\analytics\chart2;


class controller extends \content_a\form\analytics\controller
{
	public static function routing()
	{
		parent::routing();

		\content_a\form\analytics\controller::form_filter_id();
	}

}
?>
