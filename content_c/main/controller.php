<?php
namespace content_c\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!\dash\user::login())
		{
			\dash\redirect::to(\dash\url::base(). '/enter');
			return;
		}

		/**
		 * if we have domain in this content
		 * redirect to whitout subdomain
		 */
		if(\dash\url::subdomain())
		{
			$url = \dash\url::site() . '/c';
			\dash\redirect::to($url);
			return;
		}
	}
}
?>
