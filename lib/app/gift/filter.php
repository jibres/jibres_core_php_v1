<?php
namespace lib\app\gift;

class filter
{
	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Date created, ASC"), 'query' => 	['sort' => 'datecreated',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date created, DESC"), 'query' => ['sort' => 'datecreated',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date expire, ASC"), 'query' => 	['sort' => 'dateexpire',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date expire, DESC"), 'query' => ['sort' => 'dateexpire',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Capacity, ASC"), 'query' => 	['sort' => 'usagetotal',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Capacity, DESC"), 'query' => ['sort' => 'usagetotal',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Capacity per user, ASC"), 'query' => 	['sort' => 'usageperuser',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Capacity per user, DESC"), 'query' => ['sort' => 'usageperuser',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Category, ASC"), 'query' => 	['sort' => 'category',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Category, DESC"), 'query' => ['sort' => 'category',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Maximum amount, ASC"), 'query' => 	['sort' => 'giftmax',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Maximum amount, DESC"), 'query' => ['sort' => 'giftmax',		 'order' => 'desc'], 	'public' => false];


		$sort_list[] = ['title' => T_("Price floor, ASC"), 'query' => 	['sort' => 'pricefloor',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Price floor, DESC"), 'query' => ['sort' => 'pricefloor',		 'order' => 'desc'], 	'public' => false];


		return $sort_list;
	}


	private static function list_of_filter()
	{
		$list                     = [];

		$list['active']            = ['key' => 'active', 	'group' => T_("Status"), 'title' => T_('Active'), 	'query' => ['status' => 'active'], 	'public' => true];
		$list['enable']            = ['key' => 'enable', 	'group' => T_("Status"), 'title' => T_('Enable'), 	'query' => ['status' => 'enable'], 	'public' => true];
		$list['draft']             = ['key' => 'draft', 	'group' => T_("Status"), 'title' => T_('Draft'), 	'query' => ['status' => 'draft'], 	'public' => true];
		$list['expired']           = ['key' => 'expired', 	'group' => T_("Status"), 'title' => T_('Expired'), 	'query' => ['status' => 'expired'], 	'public' => true];

		$list['specialuser']       = ['key' => 'specialuser', 	'group' => T_("User"), 'title' => T_('Special user'), 	'query' => ['user' => 'special'], 	'public' => true];
		$list['havelimitperuser']  = ['key' => 'havelimitperuser', 	'group' => T_("User"), 'title' => T_('Have limit per user'), 	'query' => ['user' => 'havelimit'], 	'public' => true];

		$list['giftamount']        = ['key' => 'giftamount', 	'group' => T_("Type"), 'title' => T_('By amount'), 	'query' => ['type' => 'amount'], 	'public' => true];
		$list['giftpercent']       = ['key' => 'giftpercent', 	'group' => T_("Type"), 'title' => T_('By percent'), 	'query' => ['type' => 'percent'], 	'public' => true];

		$list['foruseinany']       = ['key' => 'foruseinany', 	'group' => T_("For use in"), 'title' => T_('Any'), 	'query' => ['forusein' => 'any'], 	'public' => true];
		$list['foruseindomain']    = ['key' => 'foruseindomain', 	'group' => T_("For use in"), 'title' => T_('Domain'), 	'query' => ['forusein' => 'domain'], 	'public' => true];
		$list['foruseinstore']     = ['key' => 'foruseinstore', 	'group' => T_("For use in"), 'title' => T_('Store'), 	'query' => ['forusein' => 'store'], 	'public' => true];
		$list['foruseinsms']       = ['key' => 'foruseinsms', 	'group' => T_("For use in"), 'title' => T_('SMS'), 	'query' => ['forusein' => 'sms'], 	'public' => true];

		$list['foruseinir_domain'] = ['key' => 'foruseinir_domain', 	'group' => T_("For use in"), 'title' => T_('IR domain'), 	'query' => ['forusein' => 'ir_domain'], 	'public' => true];
		$list['foruseinir1']       = ['key' => 'foruseinir1', 	'group' => T_("For use in"), 'title' => T_('IR domain 1 year'), 	'query' => ['forusein' => 'ir_domain_1'], 	'public' => true];
		$list['foruseinir5']       = ['key' => 'foruseinir5', 	'group' => T_("For use in"), 'title' => T_('IR domain 5 year'), 	'query' => ['forusein' => 'ir_domain_5'], 	'public' => true];


		return $list;

	}

}
?>