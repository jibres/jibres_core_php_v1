<?php
namespace content_business\orders\track;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Tracking Order"));

		$action = \dash\data::dataRow_action();
		if(!is_array($action))
		{
			$action = [];
		}

		foreach ($action as $key => $value)
		{
			if(a($value, 'action') === 'tracking')
			{
				\dash\data::trackingDetail($value);
			}
		}

	}
}
?>
