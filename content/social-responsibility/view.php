<?php
namespace content\social_responsibility;


class view
{
	public static function config()
	{
		\lib\data::page(T_('Jibres Social Responsibility'), 'title');
		\lib\data::page(T_('Social responsibility refers to our role in maintaining, caring about and helping our society, while having set as its goal a responsibility-centered enterprise along with wealth production.'), 'desc');
	}
}
?>