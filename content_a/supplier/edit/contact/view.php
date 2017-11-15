<?php
namespace content_a\supplier\edit\contact;


class view extends \content_a\supplier\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Edit contact information'). $this->data->page['title'];
		$this->data->page['desc']  = T_('Change mobile number of supplier and parents, email and tel of home');
	}
}
?>
