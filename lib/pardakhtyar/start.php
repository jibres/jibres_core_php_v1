<?php
namespace lib\pardakhtyar;

class start
{
	public static function fire($_requestJson, $_addr = 'write')
	{
		$result = self::run($_requestJson, ['addr' => $_addr]);

		\dash\code::jsonBoom($result, true);
	}


	public static function run($_requestJson, $_args = [])
	{
		$_addr = isset($_args['addr']) ? $_args['addr'] : 'write';
		$table = isset($_args['table']) ? $_args['table'] : null;
		$request_id = isset($_args['request_id']) ? $_args['request_id'] : null;

		// ready detail to save request record
		\lib\pardakhtyar\request::start($_requestJson, $_addr, self::addr($_addr));
		// curl
		$result        = \dash\curl::go(self::addr($_addr), $_requestJson, 'json', [self::authHeader()], true);
		// add raw json
		$result['raw'] = $_requestJson;

		$result['table'] = $table;
		$result['request_id'] = $request_id;

		// get result and save request record in db
		\lib\pardakhtyar\request::save($result);

		return $result;
	}


	public static function transfer($_data)
	{
		$addr = self::addr('transfer');

		$result = \dash\curl::go($addr, $_data, 'json', [self::authHeader()], true);

		return $result;
	}


	public static function request($_data, $_id)
	{

		$addr = self::addr('write');
		\lib\pardakhtyar\app\check::add_new_record($_data, $_id, $addr);
		$_data  = [$_data];
		$result = \dash\curl::go($addr, $_data, 'json', [self::authHeader()], true);
		\lib\pardakhtyar\app\check::save_new_record($result);
		return $result;
	}


	public static function authHeader()
	{
		// if(!defined('shaparak_user') || !defined('shaparak_pass'))
		// {
		// 	\dash\code::jsonBoom('user pass is not defined!');
		// }
		// set header of connection
		$auth = base64_encode('926028'. ':'. '123456');
		$result = 'Authorization: Basic '. $auth;

		return $result;
	}


	public static function addr($_path = null)
	{
		$addr = 'http://192.168.250.100:9095/merchant/';

		if($_path === 'write')
		{
			$addr .= 'webService/writeExternalRequest/';
		}
		elseif($_path === 'read')
		{
			$addr .= 'webService/readRequestCartableWithFilter/';
		}
		elseif($_path === 'transfer')
		{
			$addr .= 'webService/transfer/request';
		}
		else
		{
			$addr .= $_path;
		}
		return $addr;
	}

}
?>