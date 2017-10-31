<?php
namespace content_a\staff\edit;

class view extends \content_a\main\view
{

	public function static_var()
	{
		$this->data->grade_list = \lib\utility\grade::list();
		$parent_list =
		[
			"father"              => T_("Father"),
			"mother"              => T_("Mother"),
			"sister"              => T_("Sister"),
			"brother"             => T_("Brother"),
			"grandfather"         => T_("Grandfather"),
			"grandmother"         => T_("Grandmother"),
			"aunt"                => T_("Aunt"),
			"husband of the aunt" => T_("Husband of the aunt"),
			"uncle"               => T_("Uncle"),
			"boy"                 => T_("Boy"),
			"girl"                => T_("Girl"),
			"spouse"              => T_("Spouse"),
			"stepmother"          => T_("Stepmother"),
			"stepfather"          => T_("Stepfather"),
			"neighbor"            => T_("Neighbor"),
			"staff"             => T_("Staff"),
			"friend"              => T_("Friend"),
			"boss"                => T_("Boss"),
			"supervisor"          => T_("Supervisor"),
			"child"               => T_("Child"),
			"grandson"            => T_("Grandson"),
		];
		$this->data->parent_list = implode(',' ,array_values($parent_list));

		$country_list = \lib\utility\location\countres::list('name', 'name - localname');
		$this->data->country_list = implode(',', $country_list);

		$city_list = \lib\utility\location\cites::list('localname');
		$city_list = array_unique($city_list);
		$this->data->city_list = implode(',', $city_list);

		$provice_list = \lib\utility\location\provinces::list('localname');
		$provice_list = array_unique($provice_list);
		$this->data->provice_list = implode(',', $provice_list);
	}


	/**
	 * edit staff
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_staff_edit($_args)
	{
		$this->static_var();
		$this->data->staff = $x =  $this->model()->loadStaffData($_args);

		$this->data->edit_id = isset($_args->match->url[0][1]) ? $_args->match->url[0][1] : null;
		$this->data->edit_mode = true;

		$staff_name = null;



		if($this->data->staff['displayname'])
		{
			$staff_name = $this->data->staff['displayname'];
		}
		// set title and desc for all pages
		$this->data->page['title'] = T_('Edit staff');
		$this->data->page['desc']  = T_('you can edit detail of staff');

		switch (\lib\router::get_url(2))
		{
			case 'avatar':
				$this->data->page['title'] = T_('Staff avatar');
				$this->data->page['desc']  = T_('Allow to set and change avatar of staff');
				break;

			case 'contact':
				$this->data->page['title'] = T_('Staff contact');
				$this->data->page['desc']  = T_('Change mobile number of staff and parents, email and tel of home');
				break;

			case 'identification':
				$this->data->page['title'] = T_('Staff identification detail');
				$this->data->page['desc']  = T_('set personal and birth identification detail and some other id detail like passport and etc');
				break;

			case 'address':
				$this->data->page['title'] = T_('Staff address');
				$this->data->page['desc']  = T_('set current location and full address');
				break;

			case '':
			default:
				break;
		}
		$this->data->page['desc'] .= ' | '. $staff_name;
	}

}
?>