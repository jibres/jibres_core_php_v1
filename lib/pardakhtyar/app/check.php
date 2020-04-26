<?php
namespace lib\pardakhtyar\app;


class check
{

	public static $sort_field = [];

	private static $logdata   = [];

	public static function add_new_record($_data, $_id, $_addr)
	{
		self::$logdata                            = [];
		self::$logdata['request_id']              = $_id;
		self::$logdata['user_id']                 = \dash\user::id();
		self::$logdata['sendmd5']                 = md5(json_encode($_data));
		self::$logdata['trackingNumber']          = isset($_data['trackingNumber']) ? $_data['trackingNumber'] : null;
		self::$logdata['trackingNumberPsp']       = isset($_data['trackingNumberPsp']) ? $_data['trackingNumberPsp'] : null;
		self::$logdata['requestDate']             = isset($_data['requestDate']) ? $_data['requestDate'] : null;
		self::$logdata['description']             = isset($_data['description']) ? $_data['description'] : null;
		self::$logdata['requestType']             = isset($_data['requestType']) ? $_data['requestType'] : null;
		self::$logdata['merchant']                = isset($_data['merchant']) ? json_encode($_data['merchant']) : null;
		self::$logdata['relatedMerchants']        = isset($_data['relatedMerchants']) ? $_data['relatedMerchants'] : null;
		self::$logdata['requestRejectionReasons'] = isset($_data['requestRejectionReasons']) ? $_data['requestRejectionReasons'] : null;
		self::$logdata['requestDetails']          = isset($_data['requestDetails']) ? $_data['requestDetails'] : null;
		self::$logdata['responsemd5']             = null;
		self::$logdata['status']                  = null;
		self::$logdata['send']                    = json_encode([$_data]);
		self::$logdata['response']                = null;
		self::$logdata['url']                     = $_addr;
		self::$logdata['datecreated']             = date("Y-m-d H:i:s");
		self::$logdata['datemodified']            = null;
		self::$logdata['sendtime']                = time();
		self::$logdata['responsetime']            = null;
		self::$logdata['diff']                    = null;

	}

	public static function save_new_record($_data)
	{
		$_data_row = $_data;
		if(isset($_data['response']))
		{
			$_data = $_data['response'];
		}

		self::$logdata['trackingNumber']          = isset($_data['trackingNumber']) ? $_data['trackingNumber'] : null;
		// self::$logdata['trackingNumberPsp']       = isset($_data['trackingNumberPsp']) ? $_data['trackingNumberPsp'] : null;
		// self::$logdata['requestDate']             = isset($_data['requestDate']) ? $_data['requestDate'] : null;
		// self::$logdata['description']             = isset($_data['description']) ? $_data['description'] : null;
		// self::$logdata['requestType']             = isset($_data['requestType']) ? $_data['requestType'] : null;
		// self::$logdata['merchant']                = isset($_data['merchant']) ? $_data['merchant'] : null;
		// self::$logdata['relatedMerchants']        = isset($_data['relatedMerchants']) ? $_data['relatedMerchants'] : null;
		// self::$logdata['requestRejectionReasons'] = isset($_data['requestRejectionReasons']) ? $_data['requestRejectionReasons'] : null;
		// self::$logdata['requestDetails']          = isset($_data['requestDetails']) ? $_data['requestDetails'] : null;
		self::$logdata['responsemd5']             = md5(json_encode($_data));
		self::$logdata['status']                  = isset($_data['status']) ? $_data['status'] : null;;
		// self::$logdata['send']                    = json_encode($_data_row);
		self::$logdata['response']                = json_encode($_data_row);
		self::$logdata['responsetime']            = time();
		self::$logdata['diff']                    = time() - intval(self::$logdata['sendtime']);

		\lib\pardakhtyar\db\check::insert(self::$logdata);

		self::$logdata = [];
	}


	public static function get($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error("error id");
			return false;
		}
		$load = \lib\pardakhtyar\db\check::get_by_id($_id);

		if(isset($load['send']))
		{
			$load['send_array'] = json_decode($load['send'], true);
		}

		if(isset($load['response']))
		{
			$load['response_array'] = json_decode($load['response'], true);
		}

		return $load;
	}

	/**
	 * ready data of classroom to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'response':
					if($value)
					{
						$response_array = json_decode($value, true);
						$result['response_array'] = $response_array;
						if(isset($response_array['response']) && is_string($response_array['response']) && mb_strlen($response_array['response']) < 500)
						{
							$result['response_txt'] = $response_array['response'];
						}
					}
					$result[$key] = $value;
					break;
				case 'send':
					if($value)
					{
						$send_array = json_decode($value, true);
						$result['send_array'] = $send_array;
						if(isset($send_array['send']) && is_string($send_array['send']) && mb_strlen($send_array['send']) < 500)
						{
							$result['send_txt'] = $send_array['send'];
						}
					}
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function list($_string, $_args)
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}


		$result            = \lib\pardakhtyar\db\check::search($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}




}
?>