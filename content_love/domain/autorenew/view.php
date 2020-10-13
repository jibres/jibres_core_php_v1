<?php
namespace content_love\domain\autorenew;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$list = [];
		$list['today'] = \lib\app\nic_domain\autorenew::run(true, null, true);


		$time = 1;

		for ($i=0; $i < 24 ; $i++)
		{
			$new_time = $time + $i;
			if($new_time < 24)
			{
				$new_time = $new_time < 10 ? '0'. $new_time : $new_time;
				$list[$new_time] = \lib\app\nic_domain\autorenew::run(true, $new_time);
			}
		}

		\dash\data::autorenewList($list);
	}
}
?>
