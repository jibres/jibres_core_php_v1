<?php
namespace lib\app\form\generate;


trait transactionMessage
{


	private static function generateFinalMessageFromTransaction()
	{
		$html = '';


		if(\dash\request::get('jftoken'))
		{
			$get_msg = \dash\utility\pay\setting::final_msg(\dash\request::get('jftoken'));
			if($get_msg)
			{
				if(isset($get_msg['condition']) && $get_msg['condition'] === 'ok' && isset($get_msg['plus']))
				{
					$type  = 'success';
					$title = T_("Thanks for your payment");
					$desc  = T_("The amount of :val :currency was received", [
						'val'      => \dash\fit::number($get_msg['plus']),
						'currency' => \lib\currency::name(a($get_msg, 'currency')),
					]);
				}
				else
				{
					$type  = 'error';
					$title = T_("Payment unsuccessfull");
					$desc  = null;
				}

				$html .= '<div data-notif="' . $desc . '" data-notif-title="' . $title . '" data-notif-type="' . $type . '" data-notif-icon="person" data-notif-autorun data-alerty></div>';
			}

		}

		return $html;

	}



}
