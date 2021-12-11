<?php
namespace content_a\setting\shipping\method;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		$id = \dash\request::get('id');
		if($id)
		{
			$load = \lib\app\setting\shipping_method::load($id);
			if(!$load)
			{
				\dash\header::status(404);
			}

			\dash\data::dataRow($load);
			\dash\data::editMode(true);
		}

	}
}
?>