<?php
namespace content_my\domain;


class stepGuide
{

	public static function set()
	{

		$search  = 'current';
		$choose  = null;
		$setting = null;
		$review  = null;

		$choose_link = null;

		if(\dash\request::get('q'))
		{
			$search = 'complete';
			$choose = 'current';
		}

		if(\dash\data::haveBuyDomain())
		{
			$search      = 'complete';
			$choose      = 'complete';
			$setting     = 'current';
			$choose_link = \dash\url::that(). '?q='. \dash\data::myDomain();
		}

		if(\dash\url::child() === 'review')
		{
			$search      = 'complete';
			$choose      = 'complete';
			$setting     = 'complete';
			$review      = 'current';
			$choose_link = \dash\url::that(). '?q='. \dash\data::myDomain();
		}



		$mySteps =
		[
			[
				'title' => T_('Search domain'),
				'link'  => \dash\url::that(),
				'class' => $search,
			],
			[
				'title' => T_('Choose domain'),
				'link'  => $choose_link,
				'class' => $choose,
			],
			[
				'title' => T_('Setting'),
				'class' => $setting,
			],
			[
				'title' => T_('Review'),
				'class' => $review,
			],
			[
				'title' => T_('Pay'),
			],

		];


		\dash\data::stepGuide($mySteps);
	}
}
?>