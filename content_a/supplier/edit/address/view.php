<?php
namespace content_a\supplier\edit\address;


class view extends \content_a\supplier\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Edit address'). $this->data->page['title'];
		$this->data->page['desc']  = T_('set current location and full address');
	}
}
?>
