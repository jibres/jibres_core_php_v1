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
			'ratio'   => ['enum' => ['16:9','16:10','19:10','32:9','64:27','5:3']],
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

		$get_line = \lib\db\setting\get::lang_platform_cat_id(\dash\language::current(), 'website', 'homepage', $line_id);

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

		\lib\db\setting\update::overwirte_platform_cat_key_lang($sort, 'website', 'body', 'sort_line', \dash\language::current());

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Sort saved"));
		return true;

	}
}
?>