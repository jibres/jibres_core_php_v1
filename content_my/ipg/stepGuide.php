<?php
namespace content_my\ipg;


class stepGuide
{
		private static function check_position($_module)
	{

		$sort =
		[
			'profile',
			'iban',
			'api',
			'upload',
			'veirfy',

		];

		$child = \dash\url::child();



		$class = '';

		if($child == $_module)
		{
			$class = 'current';
		}
		else
		{
			if(array_search($_module, $sort) < array_search($child, $sort))
			{
				$class = 'complete';
			}
			else
			{
				$class = '';
			}
		}


		if($child === $_module)
		{
			$class = 'current';
		}

		return $class;

	}

	public static function set()
	{

		$profile     = self::check_position('profile');
		$iban   = self::check_position('iban');
		$upload   = self::check_position('upload');
		$api    = self::check_position('api');
		$veirfy = self::check_position('veirfy');
		$review  = self::check_position('review');

		$mySteps =
		[
			[
				'title' => T_('Complete profile'),
				'link'  => \dash\url::this(). '/profile',
				'class' => $profile,
			],
			[
				'title' => T_('Add Iban'),
				'link'  => \dash\url::this(). '/iban',
				'class' => $iban,
			],
			[
				'title' => T_('Upload Document'),
				'link'  => \dash\url::this(). '/upload',
				'class' => $upload,
			],
			[
				'title' => T_('Create your IPG'),
				'link'  => \dash\url::this(). '/api',
				'class' => $api,
			],
			[
				'title' => T_('Upgrade your plan'),
				'link'  => \dash\url::this(). '/verify',
				'class' => $veirfy,
			],
		];


		\dash\data::stepGuide($mySteps);
	}
}
?>