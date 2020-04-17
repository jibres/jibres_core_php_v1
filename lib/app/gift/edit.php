<?php
namespace lib\app\gift;


class edit
{
	public static function edit($_args, $_id)
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\gift\get::by_id($id);
		if(!$load)
		{
			\dash\notif::error(T_("Gift detail not found"));
			return false;
		}

		// check lock


		$condition =
		[
			'giftpercent'   => 'percent',
			'giftamount'    => 'price',
			'giftmax'       => 'price',
			'pricefloor'    => 'price',
			'desc'          => 'desc',
			'usagetotal'    => 'int',
			'usageperuser'  => 'smallint',
			'code'          => 'username',
			'category'      => 'string_100',
			'dateexpire'    => 'datetime',
			'status'        => ['enum' => ['draft', 'enable', 'disable', 'deleted', 'expire', 'blocked']],
			'usagestatus'   => ['enum' => ['used', 'full']],
			'forusein'      => ['enum' => ['any', 'domain', 'store', 'sms', 'ipg']],
			'emailto'       => 'desc',
			'emailtemplate' => 'string_100',
			'msgsuccess'    => 'desc',
			'forfirstorder' => 'bit',
			'dedicated'     => 'desc',
			'physical'      => 'bit',
			'chap'          => 'bit',

		];

		$require = [];
		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$args = \dash\cleanse::patch_mode($_args, $data);

		if(!empty($args))
		{
			\lib\db\gift\update::update($args, $id);
			\dash\notif::ok(T_("Gift setting saved"));
			return true;
		}
		else
		{
			\dash\notif::info(T_("Gift card saved without change"));
			return true;
		}

	}
}
?>