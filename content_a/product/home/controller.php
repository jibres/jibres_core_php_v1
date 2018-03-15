<?php
namespace content_a\product\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		// $this->post('search')->ALL();

		// redirect if query not exist
		if(\lib\utility::get('q') === '' && !\lib\utility::get('page'))
		{
			$new_url = \lib\url::pwd();
			$new_url = strtok($new_url,'?');
			$this->redirector($new_url)->redirect();
		}
	}
}
?>
