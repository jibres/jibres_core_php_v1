<?php
namespace mvc;

class view extends \lib\view
{
	function project()
	{
		// define default value for global


		$this->data->site['title']           = T_("Jibres");
		$this->data->site['desc']            = T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life.");
		$this->data->site['slogan']          = T_("Integrated Sales and Online Accounting");

		$this->data->page['desc']            = $this->data->site['desc']. ' | '. $this->data->site['slogan'];

		$this->data->bodyclass               = 'unselectable';

		// for pushstate of main page
		$this->data->template['xhr']         = 'content/main/layout-xhr.html';

		$this->data->display['admin']        = 'content_a/main/layout.html';
		$this->data->template['social']      = 'content/template/social.html';
		$this->data->template['share']       = 'content/template/share.html';
		$this->data->template['price']       = 'content/template/priceTable.html';
		$this->data->template['priceSchool'] = 'content/template/priceSchoolTable.html';

		if(in_array(\lib\router::get_repository_name(), ['content']))
		{
			// get total uses
			$total_users                     = 10; // intval(\lib\db\userteams::total_userteam());
			$total_users                     = number_format($total_users);
			$this->data->total_users         = \lib\utility\human::number($total_users);
			$this->data->footer_stat         = T_("We help :count people to work beter!", ['count' => $this->data->total_users]);
		}

		// $this->include->css_ermile       = false;
		// $this->include->js_main       = false;
		// $this->include->css              = false;
		// $this->include->js            = false;

		// if you need to set a class for body element in html add in this value
		$this->data->bodyclass           = null;
	}

	public function createFilterMsg($_searchText, $_filterArray)
	{
		$result = null;

		if($_searchText)
		{
			$result = T_('Search with keyword :search', ['search' => '<b>'. $_searchText. '</b>']);
		}

		if($_filterArray)
		{
			$result .= ' '. T_('with condition'). ' ';
			$index  = 0;
			foreach ($_filterArray as $key => $value)
			{
				if($result && $index > 0)
				{
					$result .= T_(', ');
				}
				if($value === 1)
				{
					$value = 'enable';
				}
				elseif($value === 0)
				{
					$value = 'disable';
				}
				if(is_numeric($value))
				{
					$value = \lib\utility\human::fitNumber($value);
				}
				$result .= T_($key) . ' <b>'. T_(ucfirst($value)). '</b>';
				$index++;
			}
		}

		return $result;
	}

}
?>