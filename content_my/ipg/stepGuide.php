<?php
namespace content_my\ipg;


class stepGuide
{
		private static function check_position($_module)
	{

		$sort =
		[
			'type',
			'profile',
			'upload',
			'iban',
			'gateway',
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

		$type    = self::check_position('type');
		$profile = self::check_position('profile');
		$upload  = self::check_position('upload');
		$iban    = self::check_position('iban');
		$gateway     = self::check_position('gateway');
		$veirfy  = self::check_position('veirfy');
		$review  = self::check_position('review');

		$mySteps =
		[
			[
				'title' => T_('Profile type'),
				'link'  => \dash\url::this(). '/type',
				'class' => $type,
			],
			[
				'title' => T_('Complete profile'),
				'link'  => \dash\url::this(). '/profile',
				'class' => $profile,
			],
			[
				'title' => T_('Upload Document'),
				'link'  => \dash\url::this(). '/upload',
				'class' => $upload,
			],
			[
				'title' => T_('IBAN'),
				'link'  => \dash\url::this(). '/iban',
				'class' => $iban,
			],
			[
				'title' => T_('Gateway detail'),
				'link'  => \dash\url::this(). '/gateway',
				'class' => $gateway,
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