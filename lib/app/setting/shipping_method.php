<?php
namespace lib\app\setting;


class shipping_method
{


	public static function list()
	{
		$cat   = 'shipping_shipping_method';

		$result = \lib\app\setting\get::load_setting_once($cat);

		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$myValue       = \dash\json::decode($value['value']);
				$myValue['id'] = a($value, 'id');
				$setting[]     = $myValue;
			}
		}

		return $setting;
	}



	public static function remove($_id)
	{
		$load = self::load($_id);

		if(!$load)
		{
			return false;
		}

		\lib\db\setting\delete::record($load['id']);
		return true;

	}


	public static function load($_id)
	{
		$cat   = 'shipping_shipping_method';

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\setting\get::by_id($id);
		if(!$load)
		{
			\dash\notif::error(T_("Record not found"));
			return false;
		}

		if(a($load, 'cat') !== $cat)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$result = \dash\json::decode(a($load, 'value'));
		$result['id'] = $id;

		return $result;
	}




	public static function add($_args)
	{
		$condition =
		[
			'title'  => 'title',
			'desc'   => 'desc',
			'status' => 'bit',
		];

		$require = ['title'];


		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$cat  = 'shipping_shipping_method';

		$key = $data['title'];

		$value = json_encode($data, JSON_UNESCAPED_UNICODE);

		if(\lib\app\setting\tools::get($cat, $key))
		{
			\dash\notif::error(T_("Duplicate shipping method title"));
			return false;
		}

		\lib\app\setting\tools::update($cat, $key, $value);

		return true;
	}



	public static function edit($_args, $_id)
	{
		$condition =
		[
			'title'  => 'title',
			'desc'   => 'desc',
			'status' => 'bit',
		];

		$require = ['title'];


		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$cat  = 'shipping_shipping_method';

		$load = self::load($_id);
		if(!$load)
		{
			return false;
		}

		$key = $data['title'];

		$value = json_encode($data, JSON_UNESCAPED_UNICODE);

		if($check_duplicate = \lib\app\setting\tools::get($cat, $key))
		{
			if(a($check_duplicate, 'id') == $load['id'])
			{
				// ok.
			}
			else
			{
				\dash\notif::error(T_("Duplicate shipping_method title"));
				return false;
			}
		}

		\lib\db\setting\update::record(['key' => $key, 'value' => $value], $load['id']);

		return true;
	}



}
?>