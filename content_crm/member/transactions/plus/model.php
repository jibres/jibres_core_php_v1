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

		\dash\db\transactions::set($insert);

		if(\dash\engine\process::status())
		{
			\dash\log::set('addTransactionManualy', ['title' => $data['title'], 'plus' => $data['amount'], 'user_id' => $user_id]);
			\dash\notif::ok(T_("Transaction inserted"));
			\dash\redirect::to(\dash\url::this(). '/transactions'. \dash\request::full_get());
		}
	}
}
?>