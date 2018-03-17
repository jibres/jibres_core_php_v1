<?php
namespace content_c\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!\lib\user::login())
		{
			\lib\redirect::to(\lib\url::base(). '/enter');
			return;
		}

		/**
		 * if we have domain in this content
		 * redirect to whitout subdomain
		 */
		if(\lib\url::subdomain())
		{
			$url = \lib\url::site() . '/c';
			\lib\redirect::to($url);
			return;
		}
	}
}
?>
