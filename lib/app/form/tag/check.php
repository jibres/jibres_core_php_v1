<?php
namespace lib\app\form\tag;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'title'   => 'title',
			'desc'    => 'html',
			'slug'    => 'slug',
			'form_id' => 'id',
			'privacy' => ['enum' => ['public', 'private']],

		];

		$require = ['title', 'form_id'];

		$meta =
		[

		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}


		if($_id)
		{
			$load_tag = \lib\app\form\tag\get::inline_get($_id);
			if(isset($load_tag['form_id']))
			{
				$data['form_id'] = $load_tag['form_id'];
			}
		}

		if($data['form_id'])
		{
			// check unique slug
			$check_unique_slug = \lib\db\form_tag\get::check_unique_slug($data['slug'], $data['form_id']);
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

		}

		return $data;

	}

}
?>