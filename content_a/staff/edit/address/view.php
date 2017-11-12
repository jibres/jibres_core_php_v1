<?php
namespace content_a\staff\edit\address;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		parent::config();

		$this->data->page['title'] = T_('Staff address');
		$this->data->page['desc']  = T_('set current location and full address');
	}

}
?>