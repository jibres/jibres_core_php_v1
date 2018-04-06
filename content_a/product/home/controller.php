<?php
namespace content_a\product\home;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get()->ALL();
		// $this->post('search')->ALL();

		// redirect if query not exist
		if(\dash\request::get('q') === '' && !\dash\request::get('page'))
		{
			$new_url = \dash\url::pwd();
			$new_url = strtok($new_url,'?');
			\dash\redirect::to($new_url);
		}
	}
}
?>
