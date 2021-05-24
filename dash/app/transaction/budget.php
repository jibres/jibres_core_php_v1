<?php
namespace dash\app\transaction;

class budget
{
	public static function user($_user_id)
	{
		$user_id = \dash\validate::id($_user_id);

		$budget = \dash\db\transactions::budget($_user_id);

		$budget = floatval($budget);

		return $budget;
	}



	public static function minus($_args)
	{


	}

	public static function plus($_args)
	{


	}

	public static function plus_minus($_args)
	{
		$condition =
		[
			'title'   => 'string_200',
			'amount'  => 'price',
			'date'    => 'date',
			'time'    => 'time',
			'user_id' => 'code',
			'dblm'    => 'bit',
			'type'    => ['enum' => ['minus', 'plus']],
		];

		$require = ['title',  'amount', 'type', 'user_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$user_id = \dash\coding::decode($data['user_id']);

		if(!$user_id)
		{
			\dash\notif::error(T_("User not founded"));
			return false;
		}

		if(\dash\engine\store::inStore())
		{
			if(!\lib\store::currency())
			{
				\dash\notif::error(T_("Please set your store currency first"));
				return false;
			}

			$currency = \lib\store::currency();
		}
		else
		{
			$currency = \lib\currency::default();
		}

		if(!$data['date'])
		{
			$data['date'] = date("Y-m-d");
		}

		if(!$data['time'])
		{
			$data['time'] = date("H:i:s");
		}


		$date = $data['date']. ' '. $data['time'];



		$insert =
		[
			'caller'    => 'manually',
			'title'     => $data['title'],
			'user_id'   => $user_id,
			'payment'   => null,
			'type'      => 'money',
			'unit'      => $currency,
			'date'      => $date,
			'verify'    => 1,
			'dateverify' => time(),
		];

		if($data['type'] === 'plus')
		{
			$insert['plus'] = $data['amount'];
		}
		else
		{
			$insert['minus'] = $data['amount'];
		}

		$transaction_id = \dash\db\transactions::set($insert);

		if(\dash\engine\process::status())
		{
			$log =
			[
				'my_title'           => $data['title'],
				'my_amount'          => $data['amount'],
				'my_type'            => \dash\url::subchild(),
				'my_for_user'        => $user_id,
				'my_oprator'         => \dash\user::id(),
				'my_currency'        => $currency,
				'my_transaction_id'  => $transaction_id,
				'my_for_user_name'   => \dash\data::dataRowMember_displayname(),
				'my_for_user_mobile' => \dash\data::dataRowMember_mobile(),
			];

			\dash\log::set('transaction_addTransactionManualy', $log);

			\dash\notif::ok(T_("Transaction inserted"));

			if($data['type'] === 'plus' && $data['dblm'])
			{
				$new_data = $data;
				$new_data['type'] = 'minus';
				$new_data['dblm'] = null;
				return self::set($new_data);
			}

			return true;
			// \dash\redirect::to(\dash\url::this(). '/transactions'. \dash\request::full_get());
		}

		return false;
	}
}
?>