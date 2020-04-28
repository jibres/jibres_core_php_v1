<?php
namespace content_my\ipg\setup;


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
				'link'  => \dash\url::that(). '/type',
				'class' => $type,
			],
			[
				'title' => T_('Complete profile'),
				'link'  => \dash\url::that(). '/profile',
				'class' => $profile,
			],
			[
				'title' => T_('Upload Document'),
				'link'  => \dash\url::that(). '/upload',
				'class' => $upload,
			],
			[
				'title' => T_('IBAN'),
				'link'  => \dash\url::that(). '/iban',
				'class' => $iban,
			],
			[
				'title' => T_('Gateway detail'),
				'link'  => \dash\url::that(). '/gateway',
				'class' => $gateway,
			],
			[
				'title' => T_('Verify'),
				'link'  => \dash\url::that(). '/verify',
				'class' => $veirfy,
			],
		];


		\dash\data::stepGuide($mySteps);
	}
}
?>