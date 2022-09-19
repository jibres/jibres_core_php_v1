<?php

$html = '';
$html .= '<div class="justify-center flex"><div class="w-full lg:w-4/5 m-2">';
{

	$html .= '<div class="alert-info fs14">';
	{
		$html .= T_("You can export your form answer to a CSV file to help with several tasks.");
	}
	$html .= '</div>';

	if(!\dash\data::countAll())
	{
		$html .= '<p class="alert-warning fs14">'. T_("You have not any answer to export!"). '</p>';
	}
	else
	{
		$html .= '<div class="msg f fs14">';
		{
			$html .= '<div class="cauto mLa5 s12">'. T_("Answer count"). ' <b>'. \dash\fit::number(\dash\data::countAll()). '</b></div>';

			$html .= '<div class="c mLa5">';
			{
				if(\dash\data::countAll() < 50)
				{
					$html .= '<a href="'. \dash\url::current(). '?id='. \dash\request::get('id'). '&download=now" data-direct class="mLa10 btn-link">'. T_("Download all answer now"). '</a>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		if(\dash\data::countAll())
		{
			$html .= '<form method="post" autocomplete="off">';
			{
				$html .= '<input type="hidden" name="export" value="answer">';
				$html .= '<div class="box">';
				{
					$html .= '<div class="pad">';
					{
						$html .= '<h2 class="text-lg font-bold">'. T_("Export by special filter"). '</h2>';
						$html .= '<div class="row">';
						{
							$html .= '<div class="c">';
							{
								$html .= '<label for="startdate">'. T_("Start date").'</label>';
								$html .= '<div class="input">';
								{
									$html .= '<input type="tel" name="startdate" data-format="date" id="startdate">';
								}
								$html .= '</div>';
							}
							$html .= '</div>';

							$html .= '<div class="c">';
							{

								$html .= '<label for="starttime">'. T_("Start time").'</label>';
								$html .= '<div class="input">';
								{
									$html .= '<input type="tel" name="starttime" data-format="time" id="starttime">';
								}
								$html .= '</div>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$html .= '<div class="row">';
						{

							$html .= '<div class="c">';
							{

								$html .= '<label for="enddate">'. T_("End date").'</label>';
								$html .= '<div class="input">';
								{
									$html .= '<input type="tel" name="enddate" data-format="date" id="date">';
								}
								$html .= '</div>';
							}
							$html .= '</div>';

							$html .= '<div class="c">';
							{

								$html .= '<label for="endtime">'. T_("End time").'</label>';
								$html .= '<div class="input">';
								{
									$html .= '<input type="tel" name="endtime" data-format="time" id="endtime">';
								}
								$html .= '</div>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						if(\dash\data::allTagList())
						{

							$html .= '<label for="tag">'. T_("Filter by tag").'</label>';
							$html .= '<select name="tag" class="select22" id="tag" data-placeholder="'. T_("Choose a tag").'">';
							{
								$html .= '<option value="">'. T_("Choose a tag"). '</option>';
								$html .= '<option value="0">'. T_("None"). '</option>';
								foreach (\dash\data::allTagList() as $key => $value)
								{
									$html .= '<option value="'. a($value, 'id'). '">'. a($value, 'title'). '</option>';
								}
							}
							$html .= '</select>';
						}
					}
					$html .= '</div>';

					$html .= '<footer class="txtRa">';
					{
						$html .= '<button class="btn-primary">'. T_("Send export request"). '</button>';
					}
					$html .= '</footer>';
				}
				$html .= '</div>';
			}
			$html .= '</form>';
		}
	}


	if(\dash\data::exportList())
	{
		$html .= '<h5>'. T_("Answer exported list"). '</h5>';

		$html .= '<div class="f fs12">';
		{
			foreach (\dash\data::exportList() as $key => $value)
			{
				$html .= '<div class="mLa10 c5 m12 s12">';
				{
					$html .= '<div class="f msg align-center">';
					{

						$html .= '<div class="cauto mRa10"><i class="sf-database fs14 text-green-700"></i></div>';
						$html .= '<div class="c sauto">'. \dash\fit::date($value['datecreated']). '</div>';
						$html .= '<div class="c s12">'. \dash\fit::date_human($value['datecreated']). '</div>';

						if(isset($value['status']) && $value['status'] == 'request')
						{
							$html .= '<div class="c s12">'. T_("Waiting to complete process..."). '</div>';
						}
						else
						{
							$html .= '<div class="cauto mRa10" data-confirm data-data=\'{"remove": "remove", "id": "'. a($value, 'id'). '"}\'><i class="sf-trash fs14 text-red-800"></i></div>';
							$html .= '<div class="c s12"><small>'. T_("Status"). '</small> <b>'. $value['tstatus']. '</b></div>';
						}

						$html .= '<div class="cauto mLa5">';
						{
							if(isset($value['status']) && $value['status'] == 'done')
							{
								$html .= '<a download class="btn-link" href="'. a($value, 'download_link'). '">'. T_("Download"). '</a>';
							}
						}
						$html .= '</div>';
					}
					$html .= '</div>';


				}
				$html .= '</div>';
			}
		}
		$html .= '</div>';

	}


	$html .= '<div class="justify-center flex w-full mx-auto">';
	{
		$html .= '<img class="banner w300" src="'. \dash\url::cdn(). '/img/product/export1.png" alt="'. T_("import answers"). '">';
	}
	$html .= '</div>';
}
$html .= '</div></div>';

echo $html;
?>