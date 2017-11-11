<?php
namespace content_a\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Dashboard of your store"). ' | ' . \lib\store::name();
		$this->data->page['desc']  = T_('Glance at your store summary and compare some important data together and enjoy Jibres!'). ' '. T_('Have a good day;)');
	}
}
?>
