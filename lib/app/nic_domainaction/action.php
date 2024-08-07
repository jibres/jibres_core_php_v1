<?php
namespace lib\app\nic_domainaction;

class action
{

	public static function set($_caller, $_args = [])
	{

		$insert =
		[
			'action'         => $_caller,
			'datecreated'    => date("Y-m-d H:i:s"),
			'user_id'        => \dash\user::id(),

			'status'         => isset($_args['status']) 			? $_args['status'] 			: 'enable',
			'mode'           => isset($_args['mode']) 				? $_args['mode'] 			: 'manual',
			'category'       => isset($_args['category']) 			? $_args['category'] 		: null,
			'period'         => isset($_args['period']) 			? $_args['period'] 			: null,
			'domain_id'      => isset($_args['domain_id']) 			? $_args['domain_id'] 		: null,
			'domainname'     => isset($_args['domain']) 			? $_args['domain'] 			: null,
			'detail'         => isset($_args['detail']) 			? $_args['detail'] 			: null,
			'date'           => isset($_args['date']) 				? $_args['date'] 			: null,
			'price'          => isset($_args['price']) 				? $_args['price'] 			: null,
			'discount'       => isset($_args['discount']) 			? $_args['discount'] 		: null,
			'transaction_id' => isset($_args['transaction_id']) 	? $_args['transaction_id'] 	: null,
			'finalprice'     => isset($_args['finalprice']) 		? $_args['finalprice'] 		: null,
			'giftusage_id'   => isset($_args['giftusage_id']) 		? $_args['giftusage_id'] 	: null,
		];

		if(\dash\temp::get('run:by:system'))
		{
			$insert['mode'] = 'auto';
		}

		$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert);

	}

}
?>