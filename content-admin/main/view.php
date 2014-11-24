<?php
class main_view extends mvcView_cls
{
	// ---------------------------------------------------------------- default config function for ADMIN
	public function config()
	{
		if($this->data->module && $this->data->module!="home")
		{
			if($this->data->child)
			{
				// in add, edit or delete pages
				$this->data->form_title		= ucfirst($this->url_table_prefix());
				$this->global->page_title	= $this->url_title() . ' ' . $this->data->form_title;
				$myForm						= $this->createform("@".$this->data->module, $this->data->child);
				$this->data->form_show		= true;

				
				if(isset(config_lib::$surl['edit']))
				{
					$tmp_result = $this->sql("#datarowbyid");
					$this->fill_for_edit($tmp_result, $myForm);
				}

				$this->data->field_list		= getTable_cls::forms($this->data->module);
				// var_dump($this->data->field_list);

			}
			else
			{
				// in root page like site.com/admin/banks show datatable

				// get data from database through model
				$this->data->datatable		= $this->sql("#datatable");
				if($this->data->datatable)
				{
					// get all fields of table and filter fields name for show in datatable, access from columns variable
					// check if datatable exist then get this data
					$this->include->datatable	= true;
					// $this->data->columns		= getTable_cls::fields($this->data->module);
					// var_dump($this->data->columns);
					$this->data->columns		= getTable_cls::datatable($this->data->module);
				}
			}
		}
	}
}
?>