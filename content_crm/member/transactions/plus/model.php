<?php
namespace content_crm\member\transactions\plus;

class model
{

	public static function post()
	{
		if(!\dash\user::login())
		{
			\dash\notif::error(T_("You must login to add new transaction"));
			return false;
		}

		$condition =
		[
			'title'  => 'string_50',
			'amount' => 'price',
		];

		$args =
		[
			'title'  => \dash\request::post('title'),
			'amount' => \dash\request::post('amount'),
		];

		$require = ['title',  'amount'];

		$meta = [];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id = \dash\coding::decode(\dash\request::get('id'));

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

		if(\dash\url::subchild() === 'plus')
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
			\dash\redirect::to(\dash\url::this(). '/transactions'. \dash\request::full_get());
		}
	}
}
?>