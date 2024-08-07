<?php
namespace content_business\orders\view;


class controller
{
	public static function routing()
	{
		if(\dash\data::nosale())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\dash\user::login() && !\dash\user::get_user_guest())
		{
			\dash\redirect::to_login();
		}

		$order_id = \dash\request::get('id');
		if(!$order_id)
		{
			\dash\redirect::to(\dash\url::this());
		}


		$load = \lib\app\factor\get::load_my_order($order_id);
		if($load === null)
		{
			// return null
			\dash\header::status(403, T_("This is not your order"));
		}
		elseif(!$load)
		{
			// return false
			\dash\header::status(404, T_("Order not found"));
		}

		\dash\data::dataRow($load);


		$satisfaction_survey = \lib\store::detail('satisfaction_survey');

		if($satisfaction_survey)
		{
			$is_answered_before = \lib\app\form\answer\get::is_answered_form_factor_id($satisfaction_survey, \dash\request::get('id'));
			if(!$is_answered_before)
			{
				\dash\data::satisfactionSurveyForm($satisfaction_survey);
				\dash\allow::file();
			}
		}


	}
}
?>
