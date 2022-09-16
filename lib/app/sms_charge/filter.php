<?php
namespace lib\app\sms_charge;

class filter
{

	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site
		$sort_list = [];

		$sort_list[] = ['title' => T_("ID ASC"), 'query' => ['sort' => 'id', 'order' => 'asc']];
		$sort_list[] = ['title' => T_("ID DESC"), 'query' => ['sort' => 'id', 'order' => 'desc']];


		$sort_list[] = ['title' => T_("Date ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc']];
		$sort_list[] = ['title' => T_("Date DESC"), 'query' => ['sort' => 'datecreated', 'order' => 'desc']];

		$sort_list[] = ['title' => T_("Count SMS, ASC"), 'query' => ['sort' => 'smscount', 'order' => 'asc']];
		$sort_list[] = ['title' => T_("Count SMS, DESC"), 'query' => ['sort' => 'smscount', 'order' => 'desc']];

		$sort_list[] = ['title' => T_("Final cost, ASC"), 'query' => ['sort' => 'final_cost', 'order' => 'asc']];
		$sort_list[] = ['title' => T_("Final cost, DESC"), 'query' => ['sort' => 'final_cost', 'order' => 'desc']];

		return $sort_list;
	}


	private static function list_of_filter()
	{

		$list = [];

		$list['pending']  = [
			'key'   => 'pending', 'group' => T_("Status"), 'title' => T_('Pending'),
			'query' => ['status' => 'pending'], 'public' => true,
		];
		$list['sending']  = [
			'key'   => 'sending', 'group' => T_("Status"), 'title' => T_('Sending'),
			'query' => ['status' => 'sending'], 'public' => true,
		];
		$list['send']     = [
			'key'    => 'send', 'group' => T_("Status"), 'title' => T_('Send'), 'query' => ['status' => 'send'],
			'public' => true,
		];
		$list['moneylow'] = [
			'key'   => 'moneylow', 'group' => T_("Status"), 'title' => T_('Money low'),
			'query' => ['status' => 'moneylow'], 'public' => true,
		];
		$list['failed']   = [
			'key'    => 'failed', 'group' => T_("Status"), 'title' => T_('Failed'), 'query' => ['status' => 'failed'],
			'public' => true,
		];
		$list['other']    = [
			'key'    => 'other', 'group' => T_("Status"), 'title' => T_('Other'), 'query' => ['status' => 'other'],
			'public' => true,
		];


		$list['calculatecost']    = [
			'key'    => 'calculatecost', 'group' => T_("Cost"), 'title' => T_('Calculate cost'), 'query' => ['calculate_cost' => 'y'],
			'public' => true,
		];

		$list['notcalculatecost']    = [
			'key'    => 'notcalculatecost', 'group' => T_("Cost"), 'title' => T_('None-Calculate cost'), 'query' => ['calculate_cost' => 'n'],
			'public' => true,
		];

		return $list;

	}

}

?>