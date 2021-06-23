<?php
namespace content_a\order\comment;


class view
{
	public static function config()
	{
		\content_a\order\view::master_order_view();

		$orderDetail = \dash\data::orderDetail();
		if(a($orderDetail, 'factor', 'customer'))
		{
			$user_id = \dash\coding::decode(a($orderDetail, 'factor', 'customer'));
			if($user_id)
			{
				$load_have_form_answer = \lib\app\form\answer\get::is_answered_user_factor_id($user_id, \dash\request::get('id'));

				if($load_have_form_answer)
				{
					\dash\data::orderHaveFormAnswer($load_have_form_answer);
				}
			}
		}
	}
}
?>
