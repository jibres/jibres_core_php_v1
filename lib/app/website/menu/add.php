<?php
namespace lib\app\website\menu;

class add
{

	public static function new_menu($_args)
	{
		$condition =
		[
			'title' => 'string_50',
		];

		$require = ['title'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$new_menu_value = ['title' => $data['title'], 'list' => []];

		$new_menu_value = json_encode($new_menu_value, JSON_UNESCAPED_UNICODE);


		$list_all_menu = \lib\app\website\menu\get::list_all_menu();
		if(is_array($list_all_menu))
		{
			$all_title = array_column($list_all_menu, 'title');
			if(in_array($data['title'], $all_title))
			{
				\dash\notif::error(T_("This title was exists in your menu list. Try another"), 'title');
				return false;
			}
		}

		// +1 whit adding current request
		if((count($list_all_menu) + 1) > 10)
		{
			\dash\notif::error(T_("You are using all your menu build capacity and you cannot build a new menu"));
			return false;
		}

		$key = 'menu_';
		$key .= (count($list_all_menu) + 1);
		$key .= '_'. time();
		$key .= '_'. rand(1, 9999);

		$insert =
		[
			'lang'     => \dash\language::current(),
			'platform' => 'website',
			'cat'      => 'menu',
			'key'      => $key,
			'value'    => $new_menu_value,
		];

		$menu_id = \lib\db\setting\insert::new_record($insert);

		if($menu_id)
		{
			\lib\app\website\generator::remove_catch();

			\dash\notif::ok(T_("Your menu was saved"));
			return ['id' => \dash\coding::encode($menu_id)];
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}

	}

	public static function remove_menu($_args)
	{
		$list_all_menu = \lib\app\website\menu\get::list_all_menu();

		if(is_array($list_all_menu))
		{
			$my_menu_ids = array_column($list_all_menu, 'id');
		}
		else
		{
			$my_menu_ids = [];
		}

		$condition =
		[
			'removemenu'    => ['enum' => $my_menu_ids],
			'removealllink' => 'bit',
		];

		$require = ['removemenu'];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		foreach ($list_all_menu as $key => $value)
		{
			if(isset($value['id']) && $value['id'] === $data['removemenu'])
			{
				if(isset($value['key']))
				{
					$usage = \lib\app\website\menu\get::usage_list($value['key']);
					if($usage)
					{
						\dash\notif::error(T_("This menu is usage in somewhere and can not be remove"));
						return false;
					}
				}
			}
		}

		$id = \dash\coding::decode($_args['removemenu']);
		if($id)
		{
			$delete = \lib\db\setting\delete::record($id);
		}


		if($delete)
		{
			\lib\app\website\generator::remove_catch();

			\dash\notif::ok(T_("Your menu was removed"));
			return true;
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}

	}



	public static function menu_item($_args, $_id)
	{
		$condition =
		[
			'title'   => 'string_50',
			'url'     => 'string_200',
			'target'  => 'bit',
			'remove'  => 'bit',
			'itemkey' => 'smallint',
			'sort'    => 'smallint',
		];

		if(isset($_args['itemkey']) && isset($_args['remove']) && $_args['remove'])
		{
			$require = [];
		}
		else
		{
			$require = ['title', 'url'];
		}


		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid menu id"));
			return false;
		}

		$load = \lib\db\setting\get::by_id($id);
		if(!$load || !isset($load['value']) || !isset($load['id']))
		{
			\dash\notif::error(T_("Menu detail not found"));
			return false;
		}

		$load_detail = json_decode($load['value'], true);

		if(!isset($load_detail['list']))
		{
			$load_detail['list'] = [];
		}


		$sort = $data['sort'];
		if(!$sort)
		{
			$sort = count($load_detail['list']) + 1;
		}


		if(isset($data['itemkey']))
		{
			if(!isset($load_detail['list'][$data['itemkey']]))
			{
				\dash\notif::error(T_("This item is not set in your menu list!"));
				return false;
			}

			if($data['remove'])
			{
				unset($load_detail['list'][$data['itemkey']]);
			}
			else
			{
				// add new item
				$load_detail['list'][$data['itemkey']] =
				[
					'title'  => $data['title'],
					'url'    => $data['url'],
					'target' => $data['target'],
					'sort'   => $sort,
				];
			}

		}
		else
		{
			// add new item
			$load_detail['list'][] =
			[
				'title'  => $data['title'],
				'url'    => $data['url'],
				'target' => $data['target'],
				'sort'   => $sort,
			];
		}


		if(count($load_detail['list']) > 20)
		{
			\dash\notif::error(T_("You can not add more than 20 link in one menu!"), ['element' => ['title', 'url', 'sort']]);
			return false;
		}

		$sort_column = array_column($load_detail['list'], 'sort');

		if(count($sort_column) === count($load_detail['list']))
		{
			$my_sorted_list = $load_detail['list'];

			array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			$load_detail['list'] = $my_sorted_list;
		}


		$new_detail = json_encode($load_detail, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\setting\update::value($new_detail, $load['id']);

		if($result)
		{
			\lib\app\website\generator::remove_catch();

			if($data['remove'])
			{
				\dash\notif::ok(T_("Your list removed from your menu"));
			}
			elseif($data['itemkey'])
			{
				\dash\notif::ok(T_("Menu item was updated"));
			}
			else
			{
				\dash\notif::ok(T_("Your item added to your menu"));
			}
			return true;
		}
		else
		{
			\dash\log::oops('db');
			return false;
		}

	}
}
?>