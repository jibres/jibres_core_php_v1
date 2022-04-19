<?php
namespace content_a\form\analytics\create;


class controller extends \content_a\form\analytics\controller
{
	public static function routing()
	{
		parent::routing();

		$form_id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($form_id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::formDetail($load);

	}

}
?>
