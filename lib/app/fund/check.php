<?php
namespace lib\app\fund;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'title' => 'title',
			'desc'  => 'desc',
			'slug'  => 'slug',
			'pos'   => 'tag',
		];

		$require = ['title'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}

		if($data['pos'])
		{
			$pos = array_filter($data['pos']);
			$pos = array_unique($pos);
			if(!$pos)
			{
				\dash\notif::error(T_("Invalid pos detail"));
				return false;
			}

			foreach ($pos as $key => $value)
			{
				if(!\dash\validate::id($value, false))
				{
					\dash\notif::error(T_("Invalid pos detail"));
					return false;
				}
			}

			$load_multi_pos = \lib\db\pos\get::multi_id(implode(',', $pos));
			if(is_array($load_multi_pos) && count($load_multi_pos) === count($pos))
			{
				// ok
			}
			else
			{
				\dash\notif::error(T_("Invalid pos detail"));
				return false;
			}

			$data['pos'] = json_encode($pos, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			unset($data['pos']);
		}

		return $data;

	}

}
?>