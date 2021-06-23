<?php
namespace content_business\orders\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("My orders"));


		if(\dash\request::get('jftoken'))
		{
			$get_msg = \dash\utility\pay\setting::final_msg(\dash\request::get('jftoken'));
			if($get_msg)
			{
				if(isset($get_msg['condition']) && $get_msg['condition'] === 'ok' && isset($get_msg['plus']))
				{
					\dash\data::paymentVerifyMsg(T_("Thanks for your shopping"));
					\dash\data::paymentVerifyMsgTrue(true);
				}
				else
				{
					\dash\data::paymentVerifyMsg(T_("Payment unsuccessfull"));
				}
			}
			else
			{
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
		}


		$satisfaction_survey = \lib\store::detail('satisfaction_survey');

		if($satisfaction_survey && \dash\user::id())
		{
			$is_answered_before = \lib\app\form\answer\get::is_answered_form_user_factor_id($satisfaction_survey, \dash\user::id(), \dash\request::get('id'));
			if(!$is_answered_before)
			{
				\dash\data::satisfactionSurveyForm($satisfaction_survey);
			}
		}

	}
}
?>
