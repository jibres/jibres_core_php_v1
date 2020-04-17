<?php
namespace lib\app\gift;


class create
{
	public static function new_gift_card($_args)
	{
		$condition =
		[
			'type'        => ['enum' => ['amount', 'percent']],
			'giftpercent' => 'percent',
			'giftmax'     => 'price',
			'giftamount'  => 'price',
			'pricefloor'  => 'price',

		];

		if(isset($_args['type']) && $_args['type'] === 'percent')
		{
			$require = ['giftpercent', 'giftmax', 'pricefloor'];
		}
		else
		{
			$require = ['giftamount', 'pricefloor'];
		}

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data['type'] === 'percent')
		{
			$data['giftamount'] = null;
		}
		elseif($data['type'] === 'amount')
		{
			$data['giftpercent'] = null;
			$data['giftmax']     = null;
		}

		$insert =
		[
			'giftpercent' => $data['giftpercent'],
			'giftamount'  => $data['giftamount'],
			'giftmax'     => $data['giftmax'],
			'pricefloor'  => $data['pricefloor'],
			'creator'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s"),
			'status'      => 'draft',
		];

		$gift_id = \lib\db\gift\insert::new_record($insert);

		if(!$gift_id)
		{
			\dash\log::oops('db', 'gitf_card');
			return false;
		}

		$result = [];
		$result['id'] = \dash\coding::encode($gift_id);

		\dash\notif::ok(T_("Your gift card was created"));

		return $result;



	}
}
?>