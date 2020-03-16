<?php
namespace lib\app\nic_domainaction;

class search
{


	public static function list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$userId = \dash\user::id();

		$condition =
		[
			'domain_id' => 'id',
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!$_args['domain_id'])
		{
			return [];
		}

		$and           = [];
		$meta          = [];
		$or            = [];

		$meta['limit'] = 20;

		$order_sort    = " ORDER BY domainaction.id DESC";

		$and[]         = " domainaction.domain_id = $_args[domain_id] ";
		$and[]         = " domainaction.user_id = $userId ";


		$list = \lib\db\nic_domainaction\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			foreach ($list as $key => $value)
			{
				if(isset($value['action']))
				{
					switch ($value['action'])
					{
						case 'register':
							$list[$key]['taction'] = T_("Register domain");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-cart-plus fc-green"></i>';
							break;

						case 'renew':
							$list[$key]['taction'] = T_("Renew Domain");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-refresh fc-blue"></i>';
							break;

						case 'transfer':
							$list[$key]['taction'] = T_("Transfer Domain");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-exchange fc-green"></i>';
							break;

						case 'unlock':
							$list[$key]['taction'] = T_("Unlock domain");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-unlock fc-red"></i>';
							break;

						case 'lock':
							$list[$key]['taction'] = T_("Lock domain");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-lock fc-green"></i>';
							break;

						case 'changedns':
							$list[$key]['taction'] = T_("Change domain dns");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-cogs fc-red"></i>';
							break;

						case 'updateholder':
							$list[$key]['taction'] = T_("Update domain holder");
							$list[$key]['class']   = '';
							$list[$key]['icon']    = '<i class="sf-cogs fc-blue"></i>';
							break;

						case 'delete':
						case 'expire':
						default:
							$list[$key]['taction'] = $value['action'];
							break;
					}
				}
			}
		}
		else
		{
			$list = [];
		}


		return $list;
	}
}
?>