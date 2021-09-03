<?php
namespace lib\app\website\body;

class edit
{

	public static function line($_args, $_line_id)
	{
		$condition =
		[
			'title'   => 'string_200',
			'sort'    => 'smallint',
			'publish' => 'bit',
			'ratio'   => \lib\ratio::check_input(),
			'style'   => ['enum' => ['simple','professional']],
			'model'   => ['enum' => ['simple','special']],

		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);


		$line_id = \dash\validate::code($_line_id);
		$line_id = \dash\coding::decode($line_id);
		if(!$line_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$get_line = \lib\db\setting\get::platform_cat_id('website', 'homepage', $line_id);

		$founded_line = [];

		if(isset($get_line['value']))
		{
			$founded_line = json_decode($get_line['value'], true);
		}

		if(!$founded_line)
		{
			\dash\notif::error(T_("Invalid body line key"));
			return false;
		}

		$edit            = $founded_line;
		$edit['title']   = $data['title'];
		$edit['sort']    = $data['sort'];
		$edit['publish'] = $data['publish'];
		$edit['ratio']   = $data['ratio'];
		$edit['style']   = $data['style'];
		$edit['model']   = $data['model'];

		$value = json_encode($edit, JSON_UNESCAPED_UNICODE);

		\lib\db\setting\update::value($value, $line_id);

		\dash\notif::ok(T_("Setting Saved"));

		\lib\app\website\generator::remove_catch();

	}

	public static function set_sort_add_new_line($_id)
	{
		$sort = \lib\db\setting\get::platform_cat_key('website', 'body', 'sort_line');

		if(isset($sort['value']))
		{
			$sort = json_decode($sort['value'], true);
		}
		else
		{
			$sort = [];
		}

		if(!is_array($sort))
		{
			$sort = [];
		}

		$sort = array_map('floatval', $sort);
		$sort = array_filter($sort);
		$sort = array_unique($sort);

		$sort[] = $_id;

		$sort = array_map(['\\dash\\coding', 'encode'], $sort);

		self::set_sort($sort);
	}


	public static function set_sort($_sort_detail)
	{
		if(!is_array($_sort_detail))
		{
			$_sort_detail = [];
		}

		$sort = [];

		foreach ($_sort_detail as $key => $value)
		{
			if(!\dash\coding::is($value))
			{
				\dash\notif::error(T_("Invalid id"));
				return false;
			}

			$sort[] = \dash\coding::decode($value);
		}

		$sort = json_encode($sort, JSON_UNESCAPED_UNICODE);

		\lib\db\setting\update::overwirte_platform_cat_key($sort, 'website', 'body', 'sort_line');

		\lib\app\website\generator::remove_catch();


		return true;

	}
}
?>