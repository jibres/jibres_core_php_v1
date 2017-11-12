<?php
namespace content_a\staff\edit\thumb;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		parent::config();

		$this->data->page['title'] = T_('Staff thumb');
		$this->data->page['desc']  = T_('Allow to set and change thumb of staff');

	}

}
?>