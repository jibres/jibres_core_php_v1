<?php
namespace lib\app\setting;


class set
{
	public static function product_setting($_args)
	{

		$condition =
		[
			'default_pirce_list' => 'bit',
			'variant_product'    => 'bit',
			'ratio' => ['enum' => ['16:9','16:10','19:10','32:9','64:27','5:3']],
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'product_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Product setting saved"));
		return true;

	}


	public static function telegram_setting($_args)
	{

		$condition =
		[
			'apikey'  => 'string_100',
			'channel' => 'string_100',
			'share_text'    => 'desc',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'telegram_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Telegram setting saved"));
		return true;

	}


	public static function bank_payment_setting($_args)
	{

		$zarinpal =
		[
			'status'      => 'bit',
			'MerchantID'  => 'string_100',
			'Description' => 'string_100',
		];

		$asanpardakht =
		[
			'status'           => 'bit',
			'MerchantID'       => 'string_100',
			'MerchantConfigID' => 'string_100',
			'Username'         => 'string_100',
			'Password'         => 'string_100',
			'EncryptionKey'    => 'string_100',
			'EncryptionVector' => 'string_100',
			'MerchantName'     => 'string_100',
		];

		$irkish =
		[
			'status'      => 'bit',
			'merchantId'  => 'string_100',
			'sha1'        => 'string_100',
			'description' => 'string_100',
		];

		$parsian =
		[
			'status'       => 'bit',
			'LoginAccount' => 'string_100',
		];

		$payir =
		[
			'status' => 'bit',
			'api'    => 'string_100',
		];

		$mellat =
		[
			'status'       => 'bit',
			'TerminalId'   => 'string_100',
			'UserName'     => 'string_100',
			'UserPassword' => 'string_100',
		];


		$data = [];

		if(!is_array($_args))
		{
			\dash\notif::error(T_("Invalid input"));
			return false;
		}

		foreach ($_args as $key => $value)
		{
			if(in_array($key, ['zarinpal','asanpardakht','irkish','parsian','payir','mellat']))
			{
				$data[$key] = \dash\cleanse::input($value, $$key, [], []);
			}
		}

		$cat  = 'bank_payment_setting';

		foreach ($data as $key => $value)
		{
			$value = json_encode($value, JSON_UNESCAPED_UNICODE);
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Bank gateway config was saved"));
		return true;

	}

}
?>