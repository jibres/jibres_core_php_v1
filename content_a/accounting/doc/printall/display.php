
<?php
if(\dash\data::dataTableAll())
{
	$add_addr = root. 'content_a/accounting/doc/add/';

	foreach (\dash\data::dataTableAll() as $key => $value)
	{
		echo "<div class='printArea' data-size='A4'>";
		\dash\data::dataRow($value);
		\dash\data::myType(\dash\data::dataRow_type());
		\dash\data::editMode(true);
		\dash\data::printAllMode(true);
		$detail = \lib\app\tax\docdetail\get::list(\dash\data::dataRow_id());


		if(!is_array($detail))
		{
			$detail = [];
		}
		\dash\data::docDetail($detail);
		require($add_addr. 'display-doc.php');

		if(\dash\data::dataRow_status() === 'lock')
		{

		}
		else
		{
			require($add_addr. 'display-docdetail.php');
		}

		require($add_addr. 'display-list.php');
		echo "</div>";

	}


 }
 ?>