<?php
namespace content_a\thirdparty\edit;


class view extends \content_a\main\view
{

	public function config()
	{

	}


	public function load_thirdparty_detail()
	{
		$this->static_var();

		$userstore_id = \lib\request::get('id');
		$userstore_id = \lib\coding::decode($userstore_id);

		if(!$userstore_id)
		{
			\lib\header::status(404, T_("Thirdparty id not found"));
		}

		$thirdparty             = \lib\app\thirdparty::get(\lib\request::get('id'));

		if(isset($thirdparty['supplier']) || (isset($thirdparty['type']) && $thirdparty['type'] === 'supplier'))
		{
			$this->data->supplier_mode = true;
		}

		$this->data->thirdparty = $thirdparty;

		if(isset($thirdparty['displayname']))
		{
			$this->data->page['title'] = ' | '. $thirdparty['displayname'];
		}

		$this->data->page['badge']['link'] = \lib\url::here(). '/thirdparty/add';
		$this->data->page['badge']['text'] = T_('Add new thirdparty');
	}


	public function static_var()
	{
		// $this->data->grade_list = \lib\utility\grade::list();
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
			"teacher"             => T_("Teacher"),
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
}
?>
