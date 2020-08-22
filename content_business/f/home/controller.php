<?php
namespace content_business\f\home;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		if($child)
		{
			$load_form = \lib\app\form\form\get::get($child);
			if(!$load_form || !isset($load_form['id']))
			{
				\dash\header::status(404);
			}

			$form_id = $load_form['id'];

			if((isset($load_form['status']) && $load_form['status'] === 'publish'))
			{
				// ok
			}
			else
			{
				if(\dash\permission::check('showAllContactForm'))
				{
					// nothing to admin
				}
				else
				{
					\dash\header::status(403, T_("This form is not publish"));
				}
			}

			$load_items = \lib\app\form\item\get::items($form_id);

			\dash\data::formId($form_id);
			\dash\data::formDetail($load_form);
			\dash\data::formItems($load_items);
			\dash\data::contactForm(true);

			\dash\open::get();
			\dash\open::post();
		}
		else
		{
			$args = [];
			$args['status'] = 'publish';
			$get_publish_form = \lib\app\form\form\search::list(null, $args);
			\dash\data::dataTable($get_publish_form);
		}



	}
}
?>