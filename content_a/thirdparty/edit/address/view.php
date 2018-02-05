<?php
namespace content_a\thirdparty\edit\address;


class view extends \content_a\thirdparty\edit\view
{
	public function config()
	{
		self::load_thirdparty_detail();

		$this->data->page['title'] = T_('Edit address'). $this->data->page['title'];
		$this->data->page['desc']  = T_('set current location and full address');
	}
}
?>
