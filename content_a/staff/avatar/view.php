<?php
namespace content_a\staff\avatar;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		parent::config();

		$this->data->page['title'] = T_('Staff avatar');
		$this->data->page['desc']  = T_('Allow to set and change avatar of staff');

	}

}
?>