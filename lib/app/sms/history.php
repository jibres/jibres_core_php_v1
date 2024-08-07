<?php
namespace lib\app\sms;

class history
{

	/**
	 * Insert sms log from kavenegar
	 *
	 * @param      array  $_args  The arguments
	 */
	public static function add($_args)
	{
		if(!is_array($_args))
		{
			$_args = [];
		}

		$defalt =
		[
			'mode'         => null,
			'mobile'       => null,
			'message'      => null,
			'urlmd5'       => null,
			'url'          => null,
			'type'         => null,
			'user_id'      => null,
			'ip'           => null,
			'ip_id'        => null,
			// 'ip_md5'       => null,
			'agent_id'     => null,
			'line'         => null,
			'apikey'       => null,
			'response'     => null,
			'send'         => null,
			'datecreated'  => null,
			'datesend'     => null,
			'dateresponse' => null,

			'provider' => null,
			'len'      => null,
			'cost'     => null,
			'amount'   => null,
			'status'   => null,
		];




		$_args = array_merge($defalt, $_args);

		$myIp   = \dash\server::ip();
		$ip_id  = \dash\utility\ip::id($myIp);
		$type   = \dash\temp::get('kavenegar_sms_type'); //enum('signup', 'login','twostep', 'recovermobile', 'callback_signup', 'notif', 'other') NULL,

		if(!$_args['mode'])
		{
			$_args['mode'] = 'sms';
		}

		$response = \dash\temp::get('rawKavenegrarResult');

		$decode_response = \dash\json::decode($response);

		if(isset($decode_response['entries'][0]['cost']) && is_numeric($decode_response['entries'][0]['cost']))
		{
			$_args['cost'] = $decode_response['entries'][0]['cost'];
		}

		if(!a($_args, 'message') && isset($decode_response['entries'][0]['message']))
		{
			$_args['message'] = $decode_response['entries'][0]['message'];
		}

		if(isset($_args['message']) && is_string($_args['message']))
		{
			$_args['len'] = mb_strlen($_args['message']);
			$_args['smscount'] = ceil($_args['len'] / 70);
		}

		if(!a($_args['status']))
		{
			$_args['status'] = 'sended';
		}

		$_args['provider']    = 'kavenegar';
		$_args['urlmd5']      = md5(\dash\url::pwd());
		$_args['url']         = \dash\url::pwd();
		$_args['type']        = $type; //  enum('signup', 'login','twostep', 'recovermobile', 'callback_signup', 'notif', 'other') NULL;
		$_args['user_id']     = \dash\user::id();
		$_args['ip']          = $myIp;
		$_args['ip_id']       = $ip_id;

		$_args['response']    = $response;
		$_args['send']        = \dash\temp::get('rawKavenegrarSendParam');
		$_args['agent_id']    = \dash\agent::get(true);
		$_args['datecreated'] = date("Y-m-d H:i:s");


		\lib\db\sms_log\insert::new_record($_args);
	}


	public static function update($_args, $_id)
	{

		unset($_args['mobile']);

		$response = \dash\temp::get('rawKavenegrarResult');

		$decode_response = \dash\json::decode($response);

		if(isset($decode_response['entries'][0]['cost']) && is_numeric($decode_response['entries'][0]['cost']))
		{
			$_args['cost'] = $decode_response['entries'][0]['cost'];
		}

		if(!a($_args, 'message') && isset($decode_response['entries'][0]['message']))
		{
			$_args['message'] = $decode_response['entries'][0]['message'];
		}

		if(isset($_args['message']) && is_string($_args['message']))
		{
			$_args['len'] = mb_strlen($_args['message']);
			$_args['smscount'] = ceil($_args['len'] / 70);
		}

		$_args['status']   = 'sended';
		$_args['provider'] = 'kavenegar';
		$_args['response'] = $response;
		$_args['send']     = \dash\temp::get('rawKavenegrarSendParam');


		\lib\db\sms_log\update::record($_args, $_id);
	}

}
?>