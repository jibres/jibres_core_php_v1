<?php
namespace content_business\f\home;

class controller
{
	public static function routing()
	{


		$child = \dash\url::child();

		if(\dash\url::subchild())
		{
			if(\dash\url::subchild() === 'inquiry')
			{
				\dash\data::inquiryForm(true);
			}
			else
			{
				\dash\header::status(404);
			}
		}

		if(\dash\url::subchild() === 'inquiry')
		{
			// not csrf
		}
		else
		{
			if(\dash\server::referer() && \dash\server::referer() !== \dash\url::pwd())
			{
				// not check csrf.
				// form loaded in sitebuilder
			}
			else
			{
				\dash\csrf::set();
			}
			\dash\captcha\recaptcha::set();
		}

		if($child)
		{
			$load_form = \lib\app\form\form\get::public_get($child);
			if(!$load_form || !isset($load_form['id']))
			{
				\dash\header::status(404);
			}

			// redirect to slug
			if(a($load_form, 'url') && $load_form['url'] !== \dash\url::current() && \dash\request::is('get'))
			{
				\dash\redirect::to($load_form['url']);
			}


			$form_id = $load_form['id'];
			\dash\open::get();

			if((isset($load_form['status']) && $load_form['status'] === 'publish'))
			{
				\dash\data::accessLoadItem(true);
				\dash\open::post();
				// ok
			}
			else
			{
				if(\dash\permission::check('_group_form'))
				{
					\dash\data::accessLoadItem(true);
					\dash\open::post();
					// nothing to admin
				}
				else
				{
					// \dash\header::status(403, T_("This form is not publish"));
				}
			}

			if(a($load_form, 'privacy') === 'private')
			{
				\dash\header::status(403, T_("This form is private form!"));
			}


			$load_items = \lib\app\form\item\get::items($form_id);

			\dash\data::formId($form_id);
			\dash\data::formDetail($load_form);
			\dash\data::formItems($load_items);
			\dash\data::contactForm(true);

			if(\dash\data::inquiryForm())
			{
				\lib\app\form\inquiry::check($load_form, $load_items);
			}

		}
		else
		{
			$args = [];
			$args['status'] = 'publish';
			$get_publish_form = \lib\app\form\form\search::public_list(null, $args);
			\dash\data::dataTable($get_publish_form);
		}


		\dash\allow::file();

	}


}
?>