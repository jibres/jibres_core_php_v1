<div class="row">
    <div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block">
		<?php require_once(root . 'content_a/form/itemLink.php'); ?>
    </div>
    <div class="c-xs-12 c-sm-12 c-lg-8">
		<?php require_once(root . 'content_a/form/formTitle.php'); ?>
		<?php
		$html = '';
		$html .= '<form method="get" autocomplete="off" action="' . \dash\url::that() . '" data-patch>';
		{
			$html .= '<input type="hidden" name="id" value="' . \dash\request::get('id') . '">';
			$html .= '<div class="box">';
			{
				$html .= '<div class="body">';
				{
					$html .= '<div class="msg">';
					{
						$html .= T_("On this page you can link one question to another question");
						$html .= '<br>';
						$html .= T_("Only questions that have options can be included in the condition");
					}
					$html .= '</div>';

					/*==========================
					=            IF            =
					==========================*/
					$html .= '<div>';
					{
						$html .= '<label for="if">' . T_("IF") . '</label>';
						$html .= '<select name="if" class="select22" id="if">';
						{
							$html .= '<option value="">-' . T_('Select question') . ' -</option>';

							foreach (\dash\data::itemsconditionable() as $key => $value)
							{
								if(in_array($value['id'], \dash\data::myConditoinThenElseIDS()))
								{
									continue;
								}

								$html .= '<option value="' . $value['id'] . '" ';
								if(\dash\request::get('if') == $value['id'])
								{
									$html .= 'selected';
								}

								$html .= '>' . $value['title'] . '</option>';
							}
						}
						$html .= '</select>';
					}
					$html .= '</div>';
					/*=====  End of IF  ======*/
				}
				$html .= '</div>';
				// $html .= '<footer class="txtRa">';
				// {
				//   $html .= '<button class="btn-primary">'. T_("Next"). '</button>';
				// }
				// $html .= '</footer>';
			}
			$html .= '</div>';


		}
		$html .= '</form>';

		if(\dash\request::get('if'))
		{
			$html .= '<form method="post" autocomplete="off">';
			{
				$html .= '<input type="hidden" name="if" value="' . \dash\request::get('if') . '">';
				$html .= '<div class="box">';
				{
					$html .= '<div class="body">';
					{
						/*=================================
						=            OPERATION            =
						=================================*/
						// $html .= '<div>';
						// {
						//   $html .= '<label for="operation">'. T_("Operation"). '</label>';
						//   $html .= '<select name="operation" class="select22" id="operation">';
						//   {
						//     $html .= '<option value="">-'. T_('Select operation') .' -</option>';

						//     foreach (\dash\data::operationList() as $key => $value)
						//     {
						//       $html .= '<option value="'. $key. '" ';
						//       $html .= '>'. $value. '</option>';
						//     }
						//   }
						//   $html .= '</select>';
						// }
						// $html .= '</div>';
						/*=====  End of OPERATION  ======*/


						/*=============================
						=            VALUE            =
						=============================*/
						$choiceList = \dash\data::choiceList();
						if($choiceList)
						{
							$html .= '<div>';
							{
								$html .= '<label for="value">' . T_("Value") . '</label>';
								$html .= '<select name="value" class="select22" id="value">';
								{
									$html .= '<option value="">-' . T_('Select value') . ' -</option>';

									foreach (\dash\data::choiceList() as $key => $value)
									{
										$html .= '<option value="' . $value['id'] . '" ';
										$html .= '>' . $value['title'] . '</option>';
									}
								}
								$html .= '</select>';
							}
							$html .= '</div>';
						}
						else
						{
							$html .= '<lable>' . T_("Value") . '</label>';
							$html .= '<div class="input">';
							{
								$html .= '<input type="text" name="value">';
							}
							$html .= '</div>';
						}
						/*=====  End of VALUE  ======*/


						/*============================
						=            THEN            =
						============================*/
						$html .= '<div class="mt-4">';
						{
							$html .= '<label for="then">' . T_("Then") . '</label>';
							$html .= '<select name="then" class="select22">';
							{
								$html .= '<option value="">-' . T_('Select question') . ' -</option>';

								foreach (\dash\data::items() as $key => $value)
								{
									if(in_array($value['id'], \dash\data::myConditoinThenElseIDS()))
									{
										continue;
									}

									if($value['id'] == \dash\request::get('if'))
									{
										continue;
									}

									$html .= '<option value="' . $value['id'] . '" ';
									$html .= '>' . $value['title'] . '</option>';
								}
							}
							$html .= '</select>';
						}
						$html .= '</div>';
						/*=====  End of THEN  ======*/


						/*============================
						=            ELSE            =
						============================*/
						$html .= '<div class="mt-4">';
						{
							$html .= '<label for="else">' . T_("Else") . '</label>';
							$html .= '<select name="else" class="select22">';
							{
								$html .= '<option value="">-' . T_('Select question') . ' -</option>';

								foreach (\dash\data::items() as $key => $value)
								{
									if(in_array($value['id'], \dash\data::myConditoinThenElseIDS()))
									{
										continue;
									}
									if($value['id'] == \dash\request::get('if'))
									{
										continue;
									}

									$html .= '<option value="' . $value['id'] . '" ';
									$html .= '>' . $value['title'] . '</option>';
								}
							}
							$html .= '</select>';
						}
						$html .= '</div>';
						/*=====  End of ELSE  ======*/


					}
					$html .= '</div>';

					$html .= '<footer class="f">';
					{
						$html .= '<div class="c"></div>';
						$html .= '<div class="cauto"><button class="btn master">' . T_("Add condition") . '</button></div>';
					}
					$html .= '</footer>';
				}
				$html .= '</div>';


			}
			$html .= '</form>';
		} // endif

		if($condition = \dash\data::conditionList())
		{

			$html .= '<div class="tblBox">';
			{
				$html .= '<table class="tbl1 v4">';
				{
					$html .= '<thead>';
					{
						$html .= '<tr>';
						{
							$html .= '<th>' . T_("If") . '</th>';
							// $html .= '<th>'. T_("Operation").'</th>';
							$html .= '<th>' . T_("Value") . '</th>';
							$html .= '<th>' . T_("Then") . '</th>';
							$html .= '<th>' . T_("Else") . '</th>';
							$html .= '<th class="collapsing"></th>';
						}
						$html .= '</tr>';
					}
					$html .= '</thead>';
					$html .= '<tbody>';
					{
						foreach ($condition as $key => $value)
						{

							$html .= '<tr>';
							{
								$html .= '<td>' . a($value, 'if_title') . '</td>';
								// $html .= '<td>'. a($value, 'operation') .'</td>';
								$html .= '<td>' . a($value, 'value') . '</td>';
								$html .= '<td>' . a($value, 'then_title') . '</td>';
								$html .= '<td>' . a($value, 'else_title') . '</td>';
								$html .= '<td class="collapsing">';
								{
									$html .= '<div class="" data-confirm data-data=\'{"remove_condition": "remove_condition", "key" : "' . $key . '"}\'>' . \dash\utility\icon::svg('trash', 'bootstrap', 'red', 'w-3') . '</div>';
								}
								$html .= '</td>';
							}
							$html .= '</tr>';
						}

					}
					$html .= '</tbody>';
				}
				$html .= '</table>';
			}
			$html .= '</div>';

		}


		echo $html;
		?>
    </div>
