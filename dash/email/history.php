<?php
namespace dash\email;

class history
{
	/**
	 * Save email history before send
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function set($_args)
	{
		// 'from' => string 'verify@jibres.store' (length=19)
		// 'to' => string 'Mr.Javad.Adib@gmail.com' (length=23)
		//
		// 'fromTitle' => string 'جیبرس' (length=10)
		// 'toTitle' => string 'Javad Adib' (length=10)
		//
		// 'subject' => string '[ جیبرس ] لطفا ایمیل خودتون رو تایید کنید' (length=72)
		// 'body' => string ''

		$insert                 = [];
		$insert['provider']     = null;
		$insert['from']         = a($_args, 'from');
		$insert['to']           = a($_args, 'to');
		$insert['subject']      = a($_args, 'subject');
		$insert['design']       = null;
		$insert['body']         = a($_args, 'body');
		$insert['template']     = null;
		$insert['status']       = 'send';
		$insert['user_id']      = \dash\user::id();
		$insert['ip_id']        = \dash\utility\ip::id();
		$insert['agent_id']     = \dash\agent::get(true);
		$insert['response']     = null;
		$insert['datesend']     = date("Y-m-d H:i:s");
		$insert['dateresponse'] = null;
		$insert['datecreated']  = date("Y-m-d H:i:s");
		$insert['datemodified'] = null;

		$log_id = \dash\db\crm_email\insert::new_record($insert);

	}
}
?>