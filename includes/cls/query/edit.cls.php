<?php
class query_edit_cls extends query_cls
{
	public function config($datarow, $form)
	{
		foreach ($form as $key => $value) 
		{
			if(isset($datarow[$key]))
			{
				$oForm = $form->$key;
				if($oForm->attr['type'] == "radio" || $oForm->attr['type'] == "select" || $oForm->attr['type'] == "checkbox") 
				{
					foreach ($oForm->child as $k => $v) 
					{
						if($v->attr["value"] == $datarow[$key])
						{
							if ($oForm->attr['type'] == "select")
							{
								$form->$key->child($k)->selected("selected");
							}
							else
							{
								$v->checked("checked");
							}
						}
					}
				}
				else
				{
					$oForm->value($datarow[$key]);
				}
			}
		}
	}
}
?>