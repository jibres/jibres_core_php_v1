<?php
namespace content_a\order\status;


class view
{
	public static function config()
	{
		\content_a\order\view::master_order_view();

		$orderDetail  = \dash\data::orderDetail();
		$action       = \dash\get::index($orderDetail, 'action');
		if(!is_array($action))
		{
			$action = [];
		}

		$myActionList = [];
		foreach ($action as $key => $value)
		{
			if(isset($value['action']) && $value['action'] !== 'notes')
			{
				$myActionList[] = $value;
			}
			if(isset($value['action']) && $value['action'] === 'tracking')
			{
				\dash\data::myTrackingNumber($value['desc']);
			}
		}

		\dash\data::myActionList($myActionList);

	}
}
?>
