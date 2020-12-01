<?php
namespace content_crm\transactions\add;


class model
{

	/**
	 * add a new record of transaction
	 */
	public static function post()
	{

		if(!\dash\user::login())
		{
			\dash\notif::error(T_("You must login to add new transaction"));
			return false;
		}

		$condition =
		[
			'id'     => 'id',
			'title'  => 'string_50',
			'unit'   => ['enum' => ['toman', 'dollar']],
			'mobile' => 'mobile',
			'amount' => 'price',
			'desc'   => 'desc',
			'type'   => ['enum' => ['money', 'gift', 'prize', 'transfer']],
		];

		$args =
		[
			'title'  => \dash\request::post('title'),
			'unit'   => \dash\request::post('unit'),
			'mobile' => \dash\request::post('mobile'),
			'amount' => \dash\request::post('amount'),
			'desc'   => \dash\request::post('desc'),
			'type'   => \dash\request::post('type'),
		];

		$require = ['title', 'unit', 'mobile', 'type', 'amount'];

		$meta =
		[
			'field_title' =>
			[
			],
		];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		$user_id = \dash\db\users::get_by_mobile($data['mobile']);
		if(isset($user_id['id']))
		{
			$user_id = $user_id['id'];
		}
		else
		{
			\dash\notif::error(T_("Mobile not exist"));
			return false;
		}

		if(!$user_id)
		{
			\dash\notif::error(T_("User id not set"));
			return false;
		}


		$insert =
		[
			'caller'    => 'manually',
			'title'     => $data['title'],
			'user_id'   => $user_id,
			'plus'      => $data['amount'],
			'minus'     => null,
			'payment'   => null,
			'type'      => $data['type'],
			'unit'      => $data['unit'],
			'date'      => date("Y-m-d H:i:s"),
			'parent_id' => $data['id'],
			'verify'    => 1,
			'dateverify' => time(),
		];

		\dash\db\transactions::set($insert);

		if(\dash\engine\process::status())
		{
			\dash\log::set('addTransactionManualy', ['title' => $data['title'], 'plus' => $data['amount'], 'user_id' => $user_id]);
			\dash\notif::ok(T_("Transaction inserted"));
			\dash\redirect::to(\dash\url::here(). '/transactions');
		}
	}
}
?>
