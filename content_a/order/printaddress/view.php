<?php
namespace content_a\order\printaddress;


class view
{
	public static function config()
	{

		\content_a\order\view::master_order_view();

		$id = \dash\request::get('id');
		$myFactor = \lib\app\factor\get::full($id);
		\dash\data::factorInfo($myFactor);


		if(isset($myFactor['address']) && is_array($myFactor['address']))
		{
			\dash\data::address($myFactor['address']);
		}

		if(isset($myFactor['factor']['customer_detail']) && is_array($myFactor['factor']['customer_detail']))
		{
			\dash\data::customer($myFactor['factor']['customer_detail']);
		}


	}
}
?>
