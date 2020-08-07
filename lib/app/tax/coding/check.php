<?php
namespace lib\app\tax\coding;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'title'      => 'string_200',
			'detailable' => 'bit',
			'code'       => 'intstring_4_2',
			'parent1'    => 'int',
			'parent2'    => 'int',
			'parent3'    => 'int',
			'status'     => ['enum' => ['enable','disable', 'deleted']],
			'nature'     => ['enum' => ['debtor','creditor','debtor-creditor','balance sheet','disciplinary','harmful profit']],
			'type'       => ['enum' => ['group','total','assistant','details']],
			'parent'     => 'id',
		];

		$require = ['title', 'code', 'type'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		switch ($data['type'])
		{
			case 'group':
				if($data['parent'])
				{
					\dash\notif::error(T_("Can not set parent of group accounting coding"));
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

				$data['parent1'] = $load_parent['parent1'];
				$data['parent2'] = $data['parent'];
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

				$data['parent1'] = $load_parent['parent1'];
				$data['parent2'] = $load_parent['parent2'];
				$data['parent3'] = $data['parent'];
				break;

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
				\dash\notif::error(T_("Duplicate code. Try another code"));
				return false;
			}
		}

		unset($data['parent']);

		return $data;

	}

}
?>