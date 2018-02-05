<?php
namespace content_a\thirdparty\edit\contact;


class view extends \content_a\thirdparty\edit\view
{
	public function config()
	{
		self::load_thirdparty_detail();

		$this->data->page['title'] = T_('Edit contact information'). $this->data->page['title'];
		$this->data->page['desc']  = T_('Change mobile number of thirdparty and parents, email and tel of home');
	}
}
?>
