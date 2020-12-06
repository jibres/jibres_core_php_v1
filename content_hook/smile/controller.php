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

			$alertyOpt =
			[
				'alerty'            => true,
				'timeout'           => 2000,
				'showConfirmButton' => false
			];

			// show alert as toast
			$alertyOpt['toast']    = true;
			$alertyOpt['position'] = 'top-end';


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
						\dash\notif::info(T_("You have :val new message!", ['val' => \dash\fit::number($myResult['notifCount'])]), $alertyOpt);
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