<?php
namespace content_a\staff\contact;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		parent::config();

		$this->data->page['title'] = T_('Staff contact');
		$this->data->page['desc']  = T_('Change mobile number of staff and parents, email and tel of home');
	}

}
?>