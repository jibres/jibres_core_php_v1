<?php
namespace dash\app\terms;


class check
{
	public static function variable($_args, $_id = null)
	{

		$condition =
		[
			'title'           => 'title',
			'status'          => ['enum' => ['enable','disable','expired','awaiting','filtered','blocked','spam','violence','pornography','other']],
			'url'             => 'slug',
			'type'            => ['enum' => ['tag', 'cat', 'code', 'other', 'help', 'term', 'support_tag', 'help_tag', 'category']],
			'language'        => 'language',
			'multiple_insert' => 'bit',

		];


		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['language'])
		{
			$data['language'] = \dash\language::current();
		}


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
				if($data['type'] === 'tag')
				{
					\dash\notif::error(T_("Duplicate tag. This tag is already added to your list"), 'title');
				}
				elseif($data['type'] === 'cat')
				{
					\dash\notif::error(T_("Duplicate category. This category is already added to your list"), 'title');
				}
				else
				{
					\dash\notif::error(T_("Duplicate term"), 'title');
				}

				if($data['multiple_insert'])
				{
					return $check_duplicate['id'];
				}
				else
				{
					return false;
				}
			}
		}

		if($data['url'])
		{
			if(!\dash\validate\url::allow_post_url($data['url'], $data['type'], $_id))
			{
				return false;
			}
		}

		unset($data['multiple_insert']);

		return $data;
	}
}
?>