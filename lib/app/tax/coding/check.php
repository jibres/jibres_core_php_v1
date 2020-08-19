<?php
namespace lib\app\tax\coding;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'title'         => 'string_200',
			'detailable'    => 'bit',
			'code'          => 'int',
			'parent1'       => 'int',
			'parent2'       => 'int',
			'parent3'       => 'int',
			'status'        => 'bit',
			// 'status'     => ['enum' => ['enable','disable', 'deleted']],
			'naturegroup'   => ['enum' => ['balance sheet','disciplinary','harmful profit']],
			'balancetype'   => ['enum' => ['debtor','creditor','debtor-creditor']],
			'type'          => ['enum' => ['group','total','assistant','details']],
			'parent'        => 'id',
			'class'         => ['enum' => ['current liabilities','non-current liabilities','current assets','non-current assets','profit and loss','shareholders rights']],
			'topic'         => ['enum' => ['net sales','accumulated profit','orders and prepayments','short term investments','wealth','other non-operating expenses','other operating costs','other operating income','other accounts and documents receivable','other accounts and documents payable','save employee end-of-service benefits','save taxes','tangible fixed assets','accounts receivable and commercial documents','business accounts and documents payable','receivables','prepayments','long-term accounts and documents', 'cash balance','received financial facilities','administrative costs','sales costs','financial costs','general expenses','intangible fixed assets',]],
			'naturecontrol' => 'bit',
			'exchangeable'  => 'bit',
			'followup'      => 'bit',
			'currency'      => 'bit',
		];

		$require = ['title', 'code', 'type'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		// var_dump($data);exit();

		switch ($data['type'])
		{
			case 'group':
				if($data['parent'])
				{
					\dash\notif::error(T_("Can not set parent of group accounting coding"));
					return false;
				}

				if(!in_array($data['naturegroup'], ['balance sheet','disciplinary','harmful profit']))
				{
					\dash\notif::error(T_("Invalid nature of coding"));
					return false;
				}
				break;

			case 'total':
				if(!$data['parent'])
				{
					\dash\notif::error(T_("Please choose the parent"));
					return false;
				}

				$load_parent = \lib\db\tax_coding\get::by_id($data['parent']);
				if(!isset($load_parent['id']))
				{
					\dash\notif::error(T_("Invalid parent"));
					return false;
				}

				if(isset($load_parent['type']) && $load_parent['type'] === 'group')
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Can not set this item as parent"));
					return false;
				}

				if(!in_array($data['balancetype'], ['debtor','creditor','debtor-creditor']))
				{
					\dash\notif::error(T_("Invalid nature of coding"));
					return false;
				}

				$data['naturegroup'] = null;
				$data['parent1'] = $data['parent'];
				break;

			case 'assistant':
				if(!$data['parent'])
				{
					\dash\notif::error(T_("Please choose the parent"));
					return false;
				}

				$load_parent = \lib\db\tax_coding\get::by_id($data['parent']);
				if(!isset($load_parent['id']) || !isset($load_parent['parent1']))
				{
					\dash\notif::error(T_("Invalid parent"));
					return false;
				}

				if(isset($load_parent['type']) && $load_parent['type'] === 'total')
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Can not set this item as parent"));
					return false;
				}

				if(!in_array($data['balancetype'], ['debtor','creditor','debtor-creditor']))
				{
					\dash\notif::error(T_("Invalid nature of coding"));
					return false;
				}
				$data['naturegroup'] = null;
				$data['parent1'] = $load_parent['parent1'];
				$data['parent2'] = $data['parent'];

				if($data['code'] && intval($data['code']) < 10)
				{
					$data['code'] = '0'. $data['code'];
				}
				break;

			case 'details':
				if(!$data['parent'])
				{
					\dash\notif::error(T_("Please choose the parent"));
					return false;
				}

				$load_parent = \lib\db\tax_coding\get::by_id($data['parent']);
				if(!isset($load_parent['id']) || !isset($load_parent['parent1']) || !isset($load_parent['parent2']))
				{
					\dash\notif::error(T_("Invalid parent"));
					return false;
				}

				if(isset($load_parent['type']) && $load_parent['type'] === 'assistant')
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Can not set this item as parent"));
					return false;
				}

				$data['naturegroup'] = null;
				$data['balancetype'] = null;
				$data['detailable'] = null;

				$data['parent1'] = $load_parent['parent1'];
				$data['parent2'] = $load_parent['parent2'];
				$data['parent3'] = $data['parent'];
				break;

		}

		if($_id)
		{
			$load_detail = \lib\app\tax\coding\get::get($_id);
			if(isset($load_detail['type']) && $load_detail['type'] === 'details')
			{
				if($data['code'] && mb_strlen($data['code']) > 4)
				{
					$data['code'] = substr($data['code'], 4);
				}

				if(isset($load_detail['parent3']) && $load_detail['parent3'])
				{
					$load_parent = \lib\app\tax\coding\get::get($load_detail['parent3']);
				}
			}

		}

		if(isset($load_parent['code']) && $data['code'])
		{
			$data['code'] = $load_parent['code']. $data['code'];
		}

		if($data['code'])
		{
			$check_duplicate = \lib\db\tax_coding\get::by_code($data['code']);
			if(isset($check_duplicate['id']))
			{
				if(floatval($check_duplicate['id']) === floatval($_id))
				{
					// nothing
				}
				else
				{
					\dash\notif::error(T_("Duplicate code. Try another code"));
					return false;
				}
			}
		}

		unset($data['parent']);

		$data['status'] = $data['status'] ? 'enable' : "disable";

		return $data;

	}

}
?>