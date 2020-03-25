<?php
namespace content\socialresponsibility;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Social Responsibility'));
		\dash\face::desc(T_('Social responsibility refers to our role in maintaining, caring about and helping our society, while having set as its goal a responsibility-centered enterprise along with wealth production.'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>