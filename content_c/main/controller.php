<?php
namespace content_c\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!$this->login())
		{
			$this->redirector($this->url('base'). '/enter')->redirect();
			return;
		}

		/**
		 * if we have domain in this content
		 * redirect to whitout subdomain
		 */
		if(SubDomain)
		{
			$url = Protocol. '://'. Domain. '.'. Tld . '/c';
			$this->redirector($url)->redirect();
			return;
		}
	}
}
?>
