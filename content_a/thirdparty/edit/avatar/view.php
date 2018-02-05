<?php
namespace content_a\thirdparty\edit\avatar;


class view extends \content_a\thirdparty\edit\view
{
	public function config()
	{
		self::load_thirdparty_detail();

		$this->data->page['title'] = T_('Edit avatar'). $this->data->page['title'];
		$this->data->page['desc']  = T_('Allow to set and change avatar of thirdparty');
	}
}
?>
