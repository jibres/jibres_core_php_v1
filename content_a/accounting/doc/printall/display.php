
<?php
if(\dash\data::dataTableAll())
{
	$add_addr = root. 'content_a/accounting/doc/add/';

	foreach (\dash\data::dataTableAll() as $key => $value)
	{
		$value['status'] = 'lock'; // to disable edit btn

		\dash\data::dataRow($value);
		\dash\data::myType(\dash\data::dataRow_type());
		\dash\data::editMode(true);
		\dash\data::printAllMode(true);

		\dash\data::myTitle(T_('Accounting Document Number'). ' '. \dash\data::dataRow_number());

		if(\dash\data::dataRow_type() === 'opening')
		{
			\dash\data::myTitle(\dash\data::myTitle(). ' | '. T_("Opening Document"));
		}

		if(\dash\data::dataRow_type() === 'closing')
		{
			\dash\data::myTitle(\dash\data::myTitle(). ' | '. T_("Closing Document"));
		}

		echo "<div class='printArea pageBreak' data-size='A4' data-height='auto'>";
			echo "<h1>". \dash\data::myTitle(). '</h1>';
			echo '<div class="box ">';
				echo '<div class="pad">';
					echo '<div class="row align-center mB10">';
						echo '<div class="c txtB">'. \lib\store::title(). '</div>';
						echo '<div class="c-auto">'. \dash\data::dataRow_tstatus(). '</div>';
						echo '<div class="c-auto">'. T_("Date"). ' <b>'. \dash\utility\convert::to_en_number(\dash\fit::date(\dash\data::dataRow_date())). '</b></div>';
						echo '</div>';
					echo '<div class="msg"><b>'. T_("Document Description"). '</b> '. \dash\data::dataRow_desc(). '</div>';
				echo '</div>';
			echo '</div>';

		$detail = \lib\app\tax\docdetail\get::list(\dash\data::dataRow_id());

		if($detail && is_array($detail))
		{
			$summary = [];
			$summary['debtor'] = array_sum(array_column($detail, 'debtor'));
			$summary['creditor'] = array_sum(array_column($detail, 'creditor'));

			if(floatval($summary['debtor']) === floatval($summary['creditor']))
			{
				\dash\data::equalICON('<i class="mLR5 sf-check-circle fc-red fs12 p0"></i>');
			}
			elseif(floatval($summary['debtor']) > floatval($summary['creditor']))
			{
				\dash\data::deptorICON('<i class="mLR5 sf-chevron-up fc-green"></i>');
				\dash\data::creditorICON('<i class="mLR5 sf-chevron-down"></i>');
			}
			elseif(floatval($summary['debtor']) < floatval($summary['creditor']))
			{
				\dash\data::creditorICON('<i class="mLR5 sf-chevron-up fc-green"></i>');
				\dash\data::deptorICON('<i class="mLR5 sf-chevron-down"></i>');
			}

			\dash\data::summary($summary);
		}




		if(!is_array($detail))
		{
			$detail = [];
		}
		\dash\data::docDetail($detail);
		// require($add_addr. 'display-doc.php');

		// if(\dash\data::dataRow_status() === 'lock')
		// {

		// }
		// else
		// {
		// 	require($add_addr. 'display-docdetail.php');
		// }

		require($add_addr. 'display-list.php');
		echo "</div>";
	}
		\dash\utility\pagination::html();


 }
 ?>