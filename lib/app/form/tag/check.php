<?php
namespace lib\app\form\tag;


class check
{

	public static function variable($_args, $_id = null, $_properties = [])
	{
		$condition =
		[
			'title'         => 'title',
			'desc'          => 'html',
			'slug'          => 'slug',

		];

		$require = ['title'];

		$meta =
		[

		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}


		// check unique slug
		$check_unique_slug = \lib\db\form_tag\get::check_unique_slug($data['slug']);
		if(isset($check_unique_slug['id']))
		{
			if(floatval($check_unique_slug['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate slug founded"), 'slug');
				return false;
			}
		}

		return $data;

	}

}
?>