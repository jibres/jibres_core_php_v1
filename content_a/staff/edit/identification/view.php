<?php
namespace content_a\staff\edit\identification;


class view extends \content_a\staff\edit\view
{
	public function config()
	{
		self::loadMemberDetail();

		$this->data->page['title'] = T_('Edit identification detail'). $this->data->page['title'];
		$this->data->page['desc']  = T_('set personal and birth identification detail and some other id detail like passport and etc');
	}
}
?>
