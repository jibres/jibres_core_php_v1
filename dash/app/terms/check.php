<?php
namespace dash\app\terms;


class check
{
	public static function variable($_args, $_id = null)
	{

		$condition =
		[
			'title'    => 'title',
			// 'parent'   => 'code',
			// 'desc'     => 'desc',
			'status'   => ['enum' => ['enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other']],
			// 'slug'     => 'slug',
			'url'      => 'slug',
			'type'     => ['enum' => ['tag', 'cat', 'code', 'other', 'help', 'term', 'support_tag', 'help_tag', 'category']],
			'language' => 'language',

		];


		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!$data['url'])
		{
			$data['url'] = \dash\validate::slug($data['title'], false);
		}

		if($data['type'] === 'category')
		{
			$data['type'] = 'cat';
		}


		$check_duplicate_args = ['type' => $data['type'], 'url' => $data['url'], 'language' => $data['language'], 'limit' => 1];


		// check duplicate
		// type+lang+slug
		$check_duplicate = \dash\db\terms::get($check_duplicate_args);

		if(isset($check_duplicate['id']))
		{
			if(floatval($check_duplicate['id']) === floatval($_id))
			{
				// no problem to edit it
			}
			else
			{
				\dash\notif::error(T_("Duplicate term"), ['type', 'slug', 'language', 'title']);
				return false;
			}
		}

		if($data['url'])
		{
			if(!\dash\app\url::check($data['url']))
			{
				return false;
			}
		}

		return $data;
	}
}
?>