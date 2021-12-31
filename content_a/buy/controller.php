<?php
namespace content_a\buy;


class controller extends \content_a\sale\controller
{

	public static function routing()
	{
		parent::routing();

		\lib\app\order\next_prev::detect_next_prev();
	}


}
?>
