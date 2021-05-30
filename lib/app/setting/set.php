<?php
namespace lib\app\setting;


class set
{
	public static function cms_setting($_args)
	{
		\dash\permission::access('cmsConfig');

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
			'ratio'              => \lib\ratio::check_input(),
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

		$idpay =
		[
			'status' => 'bit',
			'apikey' => 'string_100',
		];


		$data = [];

		if(!is_array($_args))
		{
			\dash\notif::error(T_("Invalid input"));
			return false;
		}

		foreach ($_args as $key => $value)
		{
			if(in_array($key, ['zarinpal','asanpardakht','irkish','parsian','payir','mellat', 'idpay']))
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



	public static function upload_provider($_args)
	{
		$condition =
		[
			'type'      => ['enum' => ['s3']],
			'provider'  => ['enum' => ['digitalocean', 'aws', 'arvancloud']],
			'status'    => 'bit',
			'accesskey' => 'string_300',
			'secretkey' => 'string_300',
			'endpoint'  => 'url',
			'bucket'    => 'string_100',
		];

		$required = [];

		if(a($_args, 'accesskey') || a($_args, 'secretkey') || a($_args, 'endpoint') || a($_args, 'bucket'))
		{
			$required = ['accesskey', 'secretkey', 'endpoint', 'bucket'];
		}
		else
		{
			$_args['status'] = 0;
		}

		$data = \dash\cleanse::input($_args, $condition, $required, []);

		$args =
		[
			'status'    => $data['status'],
			'accesskey' => $data['accesskey'],
			'secretkey' => $data['secretkey'],
			'endpoint'  => $data['endpoint'],
			'bucket'    => $data['bucket'],
		];

		$cat   = 'upload_provider';
		$key   = $data['provider'];

		$load       = \lib\app\setting\get::upload_provider();
		$any_active = false;

		$test_connection = false;

		if($data['status'])
		{
			$any_active = true;

			foreach ($load as $k => $v)
			{
				if(isset($v['status']) && $v['status'] && $key != $k)
				{
					\dash\notif::error(T_("You already use from another s3 platform. To active this service please disable all other S3 service first"));
					return false;
				}
			}

			$test_connection = true;
			\dash\db::transaction();
		}
		else
		{

			foreach ($load as $k => $v)
			{
				if(isset($v['status']) && $v['status'] && $key != $k)
				{
					$any_active = true;
				}
			}
		}

		$value = \dash\json::encode($args);
		\lib\app\setting\tools::update($cat, $key, $value);

		if($any_active)
		{
			if(!\lib\store::detail('special_upload_provider'))
			{
				\lib\app\store\edit::selfedit(['special_upload_provider' => 1], ['silent' => true]);
				\lib\store::refresh();
			}
		}
		else
		{
			if(\lib\store::detail('special_upload_provider'))
			{
				\lib\app\store\edit::selfedit(['special_upload_provider' => 0], ['silent' => true]);
				\lib\store::refresh();
			}
		}

		if($test_connection)
		{
			\lib\app\setting\get::reset_setting_cache($cat);
			$test_connection = \dash\utility\s3aws\s3::test_connection();

			if(!$test_connection)
			{
				$clean_message = true;
				\dash\notif::error(' ', ['alerty' => true, 'html' => T_("We can not connect to S3 service by this variable. This setting automatically disabled")]);
				$args['status'] = null;
				$value = \dash\json::encode($args);
				\lib\app\setting\tools::update($cat, $key, $value);
			}
			else
			{
				$args['status'] = 1;
				$value = \dash\json::encode($args);
				\lib\app\setting\tools::update($cat, $key, $value);
				$clean_message = true;
				\dash\notif::ok(' ', ['alerty' => true, 'html' => T_("The connection was successfully tested <br> From now on, all files uploaded to your service will be stored in this cloud service provider")]);
			}

			\dash\db::commit();
		}

		if(isset($clean_message) && $clean_message)
		{
			// not show this mesage
		}
		else
		{
			\dash\notif::ok(T_("Upload provider setting saved"));
		}
		return true;

	}



	public static function set_units($_args)
	{
		$condition =
		[
			'currency'    => ['enum' => array_keys(\lib\currency::list())],
			'length_unit' => ['enum' => array_keys(\lib\units::length())],
			'mass_unit'   => ['enum' => array_keys(\lib\units::mass())],
		];

		$require = [];

		$meta =	['field_title' => ['length_unit' => T_("Length unit"), 'mass_unit' => T_("Mass unit")]];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'store_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		return true;
	}


	public static function save_vat($_args)
	{
		$condition =
		[
			'tax_status'         => 'bit',
			'tax_calc'           => 'bit',
			'tax_calc_all_price' => 'bit',
			'tax_shipping'       => 'bit',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'store_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		return true;
	}


	public static function save_payment($_args)
	{
		$condition =
		[
			'payment_online'     => 'bit',
			'payment_check'      => 'bit',
			'payment_bank'       => 'bit',
			'payment_on_deliver' => 'bit',
		];


		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'store_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		return true;
	}



}
?>