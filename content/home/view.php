<?php
namespace content\home;

class view extends \mvc\view
{
	function config()
	{
		$this->data->bodyclass = 'unselectable vflex';
		// $this->include->js     = false;

		self::set_static_titles();
	}


	/**
	 * [pushState description]
	 * @return [type] [description]
	 */
	function pushState()
	{
		// if($this->module() !== 'home')
		// {
		// 	$this->data->display['mvc']     = "content/home/layout-xhr.html";
		// }
	}


	/**
	 * set title of static pages in project
	 */
	function set_static_titles()
	{
		switch ($this->module())
		{
			case 'home':
				$this->data->page['title']   = $this->data->site['title']. ' - '. T_('Integrated Sales and Online Accounting');
				$this->data->page['special'] = true;
				break;


			case 'terms':
				$this->data->page['title'] = T_('Terms of Service Agreement');
				$this->data->page['desc']  = T_('Jibres acts upon international rules, depends on the countries receiving its services and renders its activities within this framework.');
				break;


			case 'privacy':
				$this->data->page['title'] = T_('Privacy Policy');
				$this->data->page['desc']  = T_('We wish to assure you that our main concern is to secure your privacy and protect your information against impermissible access.');
				break;


			case 'about':
				$this->data->page['title'] = T_('About our platform');
				$this->data->page['desc']  = $this->data->site['desc'];
				break;



			default:
				// $this->data->page['title']   = $this->data->site['title']. ' - '. T_('Integrated Sales and Online Accounting');
				break;
		}
	}
}
?>