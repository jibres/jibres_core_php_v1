<?php
namespace content_hook\smile;


class controller
{

	public static function routing()
	{

		$myResult = [];

		if(\dash\user::id())
		{
			$myResult = \dash\app\smile::get();

			$msg = T_("You have :val new message!", ['val' => \dash\fit::number($myResult['notifCount'])]);

			$alertyOpt =
			[
				'alerty'            => true,
				'timeout'           => 5000,
				'showConfirmButton' => false,
				'priority'          => false,
				'html'              => '<a href="'. \dash\url::sitelang(). '/account/notification">'. $msg. '</a>',
			];

			// show alert as toast
			$alertyOpt['toast']    = true;
			$alertyOpt['position'] = 'bottom-end';

			if(\dash\detect\device::detectPWA())
			{
				// $alertyOpt['position'] = 'top-end';
				$alertyOpt['timeout']  = 3000;
			}


			// if before this notif icon is off
			if(\dash\request::post('notifOn') === 'true')
			{
				// notification icon is pulsing before this
			}
			else
			{
				// it new message for the first time
				if($myResult['notifNew'])
				{
					if(isset($myResult['orderCount']) && $myResult['orderCount'])
					{
						/*nothing*/
					}
					else
					{
						\dash\notif::info("1", $alertyOpt);
					}

				}
			}
		}
		else
		{
			// logout sample
			// $myResult =
			// [
			// 	'logout' =>
			// 	[
			// 		'txt' => T_("Goodbye"),
			// 		'url' => \dash\url::kingdom(). '/logout'
			// 	]
			// ];
		}

		// set result into notif
		\dash\notif::result($myResult);
		\dash\header::set(207);
		// get result of notif and send it
		$notifResult = \dash\notif::get();
		\dash\code::jsonBoom($notifResult);
	}
}
?>