<?php
namespace content\socialresponsibility;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Social Responsibility'));
		\dash\face::desc(T_('Social responsibility refers to our role in maintaining, caring about and helping our society, while having set as its goal a responsibility-centered enterprise along with wealth production.'));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-socialresponsibility-1.jpg');

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>