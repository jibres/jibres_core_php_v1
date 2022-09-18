<?php
namespace content\pricing;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Pricing'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-free-1.jpg');
		
		if(\dash\language::current() === 'fa')
		{
			\dash\face::cover(\dash\url::cdn(). '/img/cover/ir/Jibres-cover-free-fa-1.jpg');
		}
		$args =
			[
				'period' => \dash\request::get('p'),
			];

		$planList = \lib\app\plan\planList::listByDetail($args);
		\dash\data::planList($planList);
		\dash\data::tableFeatureList(\lib\app\plan\planList::preparePlanFeacureList($planList));

	}
}
?>