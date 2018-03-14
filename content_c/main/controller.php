<?php
namespace content_c\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!$this->login())
		{
			$this->redirector(\lib\url::base(). '/enter')->redirect();
			return;
		}

		/**
		 * if we have domain in this content
		 * redirect to whitout subdomain
		 */
		if(\lib\url::subdomain())
		{
			$url = \lib\url::site() . '/c';
			$this->redirector($url)->redirect();
			return;
		}
	}
}
?>
