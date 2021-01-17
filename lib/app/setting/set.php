<?php
namespace lib\app\setting;


class set
{
	public static function cms_setting($_args)
	{
		\dash\permission::access('cmsSetting');

		$condition =
		[
			'thumbratiostandard' => \lib\ratio::check_input(),
			'thumbratiogallery'  => \lib\ratio::check_input(),
			'thumbratiovideo'    => \lib\ratio::check_input(),
			'thumbratiopodcast'  => \lib\ratio::check_input(),
			'defaultcomment'     => ['enum' => ['open', 'closed']],
			'defaultshowwriter'  => ['enum' => ['visible', 'hidden']],
			'defaultshowdate'    => ['enum' => ['visible', 'hidden']],
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'cms_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("CMS setting saved"));
		return true;

	}

	public static function product_setting($_args)
	{

		$condition =
		[
			'comment'            => 'bit',
			'default_pirce_list' => 'bit',
			'variant_product'    => 'bit',
			'defaulttracking'    => 'bit',
			'ratio'              => \lib\ratio::check_input(),
			'share_text'         => 'desc',
			'view_text'          => 'desc',
			'preparationtime'    => 'smallint',
			'product_suggestion' => 'bit',
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


	public static function accounting_setting($_args)
	{

		$condition =
		[
			'currency'                                                  => 'currency',
			'assistant_close_harmful_profit'                            => 'id',
			'assistant_close_accumulated' => 'id',
			'assistant_closing'                                         => 'id',
		];


		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'accounting_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Accounting setting saved"));
		return true;

	}



	public static function sms_setting($_args)
	{
		$condition =
		[
			'kavenegar_apikey'            => 'string_100',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'sms_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("SMS setting saved"));
		return true;
	}




	public static function telegram_setting($_args)
	{

		$condition =
		[
			'adminusername' => 'string_100',
			'apikey'        => 'string_100',
			'username'      => 'username',
			'channel'       => 'username',
			'share_text'    => 'desc',
			'start_text'    => 'desc',
			'telegrambtn'   =>
			[
				'instagram' => 'bit',
				'telegram'  => 'bit',
				'youtube'   => 'bit',
				'twitter'   => 'bit',
				'linkedin'  => 'bit',
				'github'    => 'bit',
				'facebook'  => 'bit',
				'aparat'    => 'bit',
				'eitaa'     => 'bit',
			],
		];


		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'telegram_setting';

		foreach ($args as $key => $value)
		{
			if($key === 'telegrambtn')
			{
				$value = $value[0];
				$value = json_encode($value, JSON_UNESCAPED_UNICODE);
			}
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Telegram setting saved"));
		return true;

	}


	public static function order_setting($_args)
	{

		$condition =
		[
			'life_time'     => 'int',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'order_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Telegram setting saved"));
		return true;

	}



	public static function cart_setting($_args)
	{

		$condition =
		[
			'maxproductincart' => 'smallint',
			'page_text'        => 'desc',
			'color'            => ['enum' => ['red', 'green', 'blue', 'yellow']],
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'cart_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Cart setting saved"));
		return true;

	}

	public static function shipping_setting($_args)
	{

		$condition =
		[
			'page_text'            => 'desc',
			'color'                => ['enum' => ['red', 'green', 'blue', 'yellow']],
			'deliverinstoreplace'  => 'bit',
			'shipping_status'      => 'bit',
			'sendbycourier'        => 'bit',
			'sendbycourierprice'   => 'price',
			'sendbypost'           => 'bit',
			'sendbypostprice'      => 'price',
			'sendoutcity'          => 'bit',
			'sendoutcityprice'     => 'price',
			'sendoutprovince'      => 'bit',
			'sendoutprovinceprice' => 'price',
			'sendoutcountry'       => 'bit',
			'sendoutcountryprice'  => 'price',
			'freeshipping'         => 'bit',
			'freeshippingprice'    => 'price',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'shipping_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Shipping setting saved"));
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