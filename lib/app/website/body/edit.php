<?php
namespace lib\app\website\body;

class edit
{

	public static function line($_args, $line_id)
	{
		$condition =
		[
			'title'   => 'string_200',
			'sort'    => 'smallint',
			'publish' => 'bit',
		];

		$require   = [];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$line_list = \lib\app\website\body\get::line_list(true);

		$founded_line   = null;
		$foundedline_id = null;

		if(is_array($line_list))
		{
			foreach ($line_list as $key => $value)
			{
				if(isset($value['line_key']) && $value['line_key'] === $line_id)
				{
					$foundedline_id = $key;
					$founded_line = $value;
					break;
				}
			}
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

		$line_list[$foundedline_id] = $edit;

		$new_linse = json_encode($line_list, JSON_UNESCAPED_UNICODE);

		\lib\db\setting\update::overwirte_platform_cat_key($new_linse, 'website', 'body', 'sort_list');

		\dash\notif::ok(T_("Setting Saved"));

		\lib\app\website\generator::remove_catch();

	}
}
?>