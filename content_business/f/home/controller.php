<?php
namespace content_business\f\home;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		$load_form = \lib\app\form\form\get::get($child);
		if(!$load_form || !isset($load_form['id']))
		{
			\dash\header::status(404);
		}

		$form_id = $load_form['id'];

		$load_items = \lib\app\form\item\get::items($form_id);

		\dash\data::formDetail($load_form);
		\dash\data::formItems($load_items);

		\dash\open::get();
		\dash\open::post();


	}
}
?>