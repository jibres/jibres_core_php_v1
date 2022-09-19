<?php
namespace content_a\form\condition;


class controller
{

	public static function routing()
	{
		$load = \content_a\form\tag\controller::loadForm();

		\dash\data::formDetail($load);



	}

}
