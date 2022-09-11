<?php
namespace dash\app\transaction;

class add
{
	public static function test_payment_link($_payment = null)
	{
		$query =
		[
			'amount'   => 1000,
			'autosend' => 1,
			'tp'       => 1,
			'mobile'   => \dash\user::detail('mobile'),
		];

		if($_payment)
		{
			$query['payment'] = $_payment;
		}

		$html = '';
		$html .= '<a target="_blank" class="btn-link" href="';

		if(\dash\engine\store::inStore())
		{
			$html .= \lib\store::url();
		}
		else
		{
			$html .= \dash\url::kingdom();
		}

		$html .= '/pay?'. \dash\request::build_query($query);
		$html .= '">';
		$html .= '<i class="sf-link-external"></i> ';
		$html .= T_("Test payment");
		$html .= '</a>';

		return $html;

	}


	public static function donate($_args)
	{
		$condition =
		[
			'amount'  => 'price',
			'mobile'  => 'mobile',
			'tp'      => 'bit',
			'payment' => 'string_200',
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
			'bank'      => $data['payment'],
		];

		// tp = test peyment
		if($data['tp'])
		{
			if(\dash\engine\store::inStore())
			{
				$meta['turn_back'] = \lib\store::admin_url(). '/a/setting/thirdparty';
			}
			else
			{
				$meta['turn_back'] = \dash\url::kingdom();
			}
		}

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

		if(!\dash\engine\store::inStore())
		{
			$condition['store_id'] = 'id';
		}

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
		$insert['caller']   = $data['caller'];
		$insert['verify']   = $data['verify'] ? 1 : 0;


		if(isset($data['store_id']) && $data['store_id'])
		{
			$insert['store_id'] = $data['store_id'];
		}


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