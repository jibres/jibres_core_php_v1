<?php
namespace content_a\product\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		// $this->post('search')->ALL();

		// redirect if query not exist
		if(\lib\utility::get('q') === '' && \lib\router::get_url_property('page') === null)
		{
			$new_url = $this->url('full');
			$new_url = strtok($new_url,'?');
			$this->redirector($new_url)->redirect();
		}
	}
}
?>
