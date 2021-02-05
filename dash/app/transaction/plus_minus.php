<?php
namespace dash\app\transaction;

class plus_minus
{

	public static function set($_args)
	{

		$condition =
		[
			'title'   => 'string_50',
			'amount'  => 'price',
			'user_id' => 'code',
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


		$insert =
		[
			'caller'    => 'manually',
			'title'     => $data['title'],
			'user_id'   => $user_id,
			'payment'   => null,
			'type'      => 'money',
			'unit'      => $currency,
			'date'      => date("Y-m-d H:i:s"),
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

			return true;
			// \dash\redirect::to(\dash\url::this(). '/transactions'. \dash\request::full_get());
		}

		return false;
	}
}
?>