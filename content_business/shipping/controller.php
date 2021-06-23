<?php
namespace content_business\shipping;


class controller
{
	public static function routing()
	{
		if(\dash\data::nosale())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\lib\website::cart_count())
		{
			\dash\redirect::to(\dash\url::kingdom(). '/cart');
		}

		$shipping_survey = \lib\store::detail('shipping_survey');

		if($shipping_survey && \dash\user::id())
		{
			$is_answered_before = \lib\app\form\answer\get::is_answered_form_user_factor_id($shipping_survey, \dash\user::id(), \dash\request::get('id'));
			if(!$is_answered_before)
			{
				\dash\data::shippingSurveyForm($shipping_survey);
				\dash\allow::file();
			}
		}
	}
}
?>
