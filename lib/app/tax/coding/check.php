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
			'code'       => 'intstring_2_2',
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
				break;

		}

		unset($data['parent']);

		return $data;

	}

}
?>