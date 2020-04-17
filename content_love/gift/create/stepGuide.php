<?php
namespace content_love\gift\create;


class stepGuide
{
		private static function check_position($_module)
	{

		$sort =
		[
			'add',
			'price',
			'usage',
			'code',
			'setting',
			'message',
			'review',
		];

		$subchild = \dash\url::subchild();



		$class = '';

		if($subchild == $_module)
		{
			$class = 'current';
		}
		else
		{
			if(array_search($_module, $sort) < array_search($subchild, $sort))
			{
				$class = 'complete';
			}
			else
			{
				$class = '';
			}
		}


		if($subchild === $_module)
		{
			$class = 'current';
		}

		return $class;

	}

	public static function set()
	{

		$add     = self::check_position('add');
		$price   = self::check_position('price');
		$usage   = self::check_position('usage');
		$code    = self::check_position('code');
		$setting = self::check_position('setting');
		$message = self::check_position('message');
		$review  = self::check_position('review');

		$id = \dash\request::get('id');
		if($id)
		{
			$id = '?id='. $id;
		}

		$mySteps =
		[
			[
				'title' => T_('Choose type'),
				// 'link'  => \dash\url::that(). '/add',
				'class' => $add,
			],
			[
				'title' => T_('Percent / amount'),
				'link'  => \dash\url::that(). '/price'. $id,
				'class' => $price,
			],
			[
				'title' => T_('Usage setting'),
				'link'  => \dash\url::that(). '/usage'. $id,
				'class' => $usage,
			],
			[
				'title' => T_('Generate code'),
				'link'  => \dash\url::that(). '/code'. $id,
				'class' => $code,
			],
			[
				'title' => T_('Setting'),
				'link'  => \dash\url::that(). '/setting'. $id,
				'class' => $setting,
			],
			[
				'title' => T_('Messages'),
				'link'  => \dash\url::that(). '/message'. $id,
				'class' => $message,
			],
			[
				'title' => T_('Review'),
				'link'  => \dash\url::that(). '/review'. $id,
				'class' => $review,
			],
		];


		\dash\data::stepGuide($mySteps);
	}
}
?>