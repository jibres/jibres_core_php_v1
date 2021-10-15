<?php
namespace lib\app\setting;


class package
{


	public static function list()
	{
		$cat   = 'shipping_package';

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
				$setting[] = \dash\json::decode($value['value']);
			}
		}

		return $setting;
	}



	public static function remove($_title)
	{
		$cat   = 'shipping_package';


		$key = \dash\validate::title($_title);

		if(!$key)
		{
			\dash\notif::error(T_("Invalid title"));
			return false;
		}

		if($setting = \lib\app\setting\tools::get($cat, $key))
		{
			\lib\db\setting\delete::record($setting['id']);
			return true;
		}
		else
		{
			\dash\notif::error(T_("Package not found"));
			return false;
		}

	}




	public static function add($_args)
	{
		$condition =
		[
			'title'  => 'title',
			'length' => 'float',
			'width'  => 'float',
			'height' => 'float',
			'weight' => 'float',
		];

		$require = ['title'];


		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$cat  = 'shipping_package';

		$key = $data['title'];

		$value = json_encode($data, JSON_UNESCAPED_UNICODE);

		if(\lib\app\setting\tools::get($cat, $key))
		{
			\dash\notif::error(T_("Duplicate package title"));
			return false;
		}

		\lib\app\setting\tools::update($cat, $key, $value);

		return true;
	}


}
?>