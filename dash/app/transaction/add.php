<?php
namespace dash\app\transaction;

class add
{
	public static function donate($_args)
	{
		$condition =
		[
			'amount' => 'price',
			'mobile' => 'mobile',
		];

		$require = ['amount'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$user_id = null;

		if($data['mobile'])
		{
			$user_id   = \dash\app\user::quick_add(['mobile' => $data['mobile']]);
		}


		$meta =
		[
			'turn_back' => \dash\url::kingdom(),
			'user_id'   => $user_id,
			'amount'    => $data['amount'],
		];

		\dash\utility\pay\start::site($meta);



	}



	public static function add($_args)
	{
		$condition =
		[
			'debug'      => 'bit',
			'user_id'    => 'id',
			'caller'     => 'string_200',
			'title'      => 'string_200',
			'status'     => ['enum' => ['enable','disable','deleted','expired','awaiting','filtered','blocked','spam']],
			'verify'     => 'bit',
			'currency'   => 'string_200',
			'unit'       => 'string_200',
			'minus'      => 'price',
			'plus'       => 'price',
			'type'       => ['enum' => ['gift','prize','transfer','promo','money']],
			'payment'    => 'string_200',
			'factor_id'  => 'id',
			'date'       => 'datetime',
			'dateverify' => 'int',
		];

		$require = ['title',  'type'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$debug = true;

		if(!$data['debug'])
		{
			$debug = false;
		}

		$insert             = [];
		$insert['ip_id']    = \dash\utility\ip::id();
		$insert['agent_id'] = \dash\agent::get(true);
		$insert['payment']  = $data['payment'];
		$insert['code']     = 251;
		$insert['user_id']  = $data['user_id'];
		$insert['title']    = $data['title'];
		$insert['type']     = $data['type'];
		$insert['status']   = $data['status'];
		$insert['verify']   = $data['verify'] ? 1 : 0;

		$currency = $data['currency'];

		if(!$currency && $data['unit'])
		{
			$currency = $data['unit'];
		}

		if(!$currency)
		{
			$currency = \lib\currency::default();
		}

		if(!$currency)
		{
			\dash\notif::error(T_("We need transaction currency! Please contact to administrator"));
			return false;
		}

		$insert['currency'] = $currency;

		$insert['factor_id'] = $data['factor_id'];

		// only business have this field
		if(!\dash\engine\store::inStore())
		{
			unset($insert['factor_id']);
		}

		$minus = null;
		if($data['minus'])
		{
			$minus = floatval($data['minus']);
		}

		$plus = null;
		if($data['plus'])
		{
			$plus = floatval($data['plus']);
		}

		$insert['minus']         = $minus;
		$insert['plus']          = $plus;

		if(!$minus && !$plus)
		{
			\dash\notif::error(T_("Amount is required"));
			return false;
		}

		if(intval($insert['verify']) === 1)
		{
			if(!isset($data['dateverify']))
			{
				$insert['dateverify'] = time();
			}
			else
			{
				$insert['dateverify'] = intval($data['dateverify']);
			}
		}


		if(!a($data, 'date'))
		{
			$insert['date'] = date("Y-m-d H:i:s");
		}
		else
		{
			$insert['date'] = $data['date'];
		}

		$insert['datecreated'] = date("Y-m-d H:i:s");

		$insert_id = \dash\db\transactions\insert::new_record($insert);

		return $insert_id;
	}
}
?>