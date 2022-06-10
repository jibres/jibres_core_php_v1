<?php
$html = '';

if(\dash\request::get('print'))
{

	$html .= '<div class="printArea" data-size="A4">';
	{

		$html .= '<div class="alert-info text-left ltr font-bold text-sm">';
		{

			$html .= '<div class="f">';
			{

				$html .= '<div class="cauto">';
				{

					$html .= '<span>'. T_("Answer ID"). '</span>';
					$html .= '<span><code class="inline-block font-bold">' . \dash\request::get('id'). '_'.\dash\request::get('aid'). '</code></span>';
				}
				$html .= '</div>';

				$html .= '<div class="c"></div>';

				$html .= '<div class="cauto">';
				{
					$html .= '<a class="font-14 print:hidden" href="'. \dash\url::current(). \dash\request::full_get(['print' => null]) . '">'.  T_("Back") .'</a>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		$html .= '<table class="tbl1 v6">';
		{

			$html .= '<tbody class="text-sm">';
			{

				$i=0;
				foreach (\dash\data::dataTable() as $key => $value)
				{
					$i++;
					if($i % 2)
					{
						$html .= '<tr>';
					}

					$html .= '<th class="">'. a($value, 'item_title'). '</th>';
					$html .= '<td class="">';
					{
						$html .= \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);
					}
					$html .= '</td>';
					if(!($i % 2))
					{
						$html .= '</tr>';
					}
				}
			}
			$html .= '</tbody>';
		}
		$html .= '</table>';

	}
	$html .= '</div>';

	$html .= \dash\utility\pagination::html(true);


}
else
{

	$html .= '<div class="row">';
	{

		$html .= '<div class="c-xs-12 c-sm-12 c-md-6">';
		{

			$html .= '<div class="alert-info text-left ltr font-bold text-sm">';
			{

				$html .= '<div class="f">';
				{
					$html .= '<div class="cauto">';
					{
						$html .= '<span>'. T_("Answer ID"). '</span>';
						$html .= '<span><code class="inline-block font-bold">'. \dash\request::get('id'). '_'.\dash\request::get('aid'). '</code></span>';
					}
					$html .= '</div>';

					$html .= '<div class="c"></div>';

					$html .= '<div class="cauto">';
					{
						$html .= '<a class="font-14" href="'. \dash\url::current(). \dash\request::full_get(['print' => 1]). '"><i class="sf-print"></i></a>';
					}
					$html .= '</div>';

					$html .= '<div class="cauto">';
					{
						if(\dash\url::isLocal())
						{
							$html .= '<a class="btn-primary btn-sm mx-2" href="'. \dash\url::that(). '/edit'. \dash\request::full_get(). '">'. T_("Edit"). '</a>';
						}
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			if(\dash\data::answerTransactionDetail())
			{

				$html .= '<a href="'. \dash\url::kingdom(). '/crm/transactions/detail?id='. \dash\data::answerDetail_transaction_id(). '">';
				{
					$html .= '<div class="';
					if(\dash\data::answerTransactionDetail_verify())
					{
						$html .= 'alert-success';
					}
					else
					{
						$html .= 'alert-danger';
					}
					$html .= '">';
					{
						$html .= '<div class="row">';
						{
							$html .= '<div class="c-auto">';
							{
								$html .= T_("Total amount");
								$html .= '<span class="font-bold mx-4">'.  \dash\fit::number(\dash\data::answerTransactionDetail_plus()). ' '. \lib\store::currency(). '</span>';
							}
							$html .= '</div>';

							$html .= '<div class="c"></div>';

							$html .= '<div class="c-auto">';
							{
								if(\dash\data::answerTransactionDetail_verify())
								{
									$html .= T_("Successful payment");
								}
								else
								{
									$html .= T_("Unsuccess");
								}
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</a>';
			}

			if(a(\dash\data::answerDetail(), 'factor_id'))
			{
				$html .= '<div class="alert-info text-left ltr font-bold text-sm">';
				{
					$html .= '<a href="'. \dash\url::kingdom(). '/a/order/comment?id='. a(\dash\data::answerDetail(), 'factor_id'). '">'. T_("View Order"). '</a>';
				}
				$html .= '</div>';
			}


			$html .= '<table class="tbl1 v6 responsive">';
			{

				$html .= '<tbody class="text-sm">';
				{
					foreach (\dash\data::dataTable() as $key => $value)
					{
						$html .= '<tr>';
						{
							$html .= '<th class="">';
							{
								$html .= a($value, 'item_title');
							}
							$html .= '</th>';

							$html .= '<td class="">';
							{
								$html .=  \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);
							}
							$html .= '</td>';
						}
						$html .= '</tr>';
					}
				}
				$html .= '</tbody>';
			}
			$html .= '</table>';
			$html .= \dash\utility\pagination::html(true);
		}
		$html .= '</div>';



		$html .= '<div class="c-xs-12 c-sm-12 c-md-6 print:hidden">';
		{
			$html .= '<form method="post" id="markasreview">';
			{
				$html .= '<input type="hidden" name="review" value="review">';
			}
			$html .= '</form>';

			$html .= '<form method="post" id="form1">';
			{
				$html .= '<input type="hidden" name="addtag" value="addtag">';
				$html .= '<div class="box">';
				{
					$html .= '<div class="pad">';
					{

						$html .= '<div class="row align-center">';
						{
							$html .= '<div class="c">';
							{
								$html .= '<label for="tag">'. T_("Tag"). '</label>';
							}
							$html .= '</div>';

							$html .= '<div class="c-auto os">';
							{
								$html .= '<a class="text-sm" ';
								if(!\dash\detect\device::detectPWA())
								{
									$html .= " target='_blank' ";
								}
								$html .= ' href="'. \dash\url::here(). '/form/tag'. \dash\request::full_get(). '">'. T_("Manage"). ' <i class="sf-link-external"></i></a>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$html .= '<select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">';
						{
							foreach (\dash\data::allTagList() as $key => $value)
							{
								$html .= '<option value="'. $value['title']. '"' ;
								if(in_array($value['title'], \dash\data::tagsSavedTitle()))
								{
									$html .= ' selected';
								}
								$html .= '>';
								$html .= $value['title'];
								$html .= '</option>';
							}
						}
						$html .= '</select>';

					}
					$html .= '</div>';
					$html .= '<footer class="txtRa">';
					$html .= '<button class="btn-outline-secondary btn-sm">'. T_("Save"). '</button>';
					$html .= '</footer>';
				}
				$html .= '</div>';
			}
			$html .= '</form>';




			$html .= '<form method="post" autocomplete="off">';
			{

				$html .= '<div class="box">';
				{

					$html .= '<header><h2>'. T_("Add comment to this answer"). '</h2></header>';
					$html .= '<div class="body padLess">';
					{

						$html .= '<input type="hidden" name="formcomment" value="formcomment">';

						$html .= '<div class="mb-4">';
						{
							$html .= '<textarea id="comment" name="comment" class="txt" rows="3"></textarea>';
						}
						$html .= '</div>';

						$html .= '<div class="row">';
						{
							$html .= '<div class="c-xs-6 c-sm-6">';
							{
								$html .= '<div class="radio3">';
								{
									$html .= '<input type="radio" name="privacy" value="private" checked id="privacyprivate">';
									$html .= '<label for="privacyprivate">'. T_("Private") . '</label>';
								}
								$html .= '</div>';
							}
							$html .= '</div>';

							$html .= '<div class="c-xs-6 c-sm-6">';
							{
								$html .= '<div class="radio3">';
								{
									$html .= '<input type="radio" name="privacy" value="public"  id="privacypublic">';
									$html .= '<label for="privacypublic">'. T_("Public") . '</label>';
								}
								$html .= '</div>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$list   = [];
						$list[] = ['key' => 'primary', 		'title' => T_('Blue') 		];
						$list[] = ['key' => 'secondary', 	'title' => T_('Black') 		];
						$list[] = ['key' => 'success', 		'title' => T_('Green') 		];
						$list[] = ['key' => 'danger', 		'title' => T_('Red') 		];
						$list[] = ['key' => 'warning', 		'title' => T_('Yellow') 	];
						$list[] = ['key' => 'info', 		'title' => T_('Light blue') ];
						$list[] = ['key' => 'light', 		'title' => T_('Light') 		];
						$list[] = ['key' => 'dark', 		'title' => T_('Dark') 		];

						$html .= '<label for="color">'. T_("Color") . '</label>';
						$html .= '<select name="color" class="select22" id="color">';
						{
							$html .= '<option value="">'. T_("None"). '</option>';
							foreach ($list as $key => $value)
							{
								$html .= '<option value="'. $value['key']. '">'. $value['title']. '</option>';
							}
						}
						$html .= '</select>';


					}
					$html .= '</div>';

					$html .= '<footer class="f">';
					{
						$html .= '<div class="c"></div>';
						$html .= '<div class="cauto">';
							$html .= '<button class="btn-outline-secondary btn-sm">'. T_("Add comment") . '</button>';
						$html .= '</div>';
					}
					$html .= '</footer>';
				}
				$html .= '</div>';
			}
			$html .= '</form>';



			if(\dash\data::commentList())
			{
				$html .= '<div class="box">';
				{

					$html .= '<div class="pad">';
					{

						$html .= '<h2>' . T_("Answer comment"). '</h2>';

						foreach (\dash\data::commentList() as $key => $value)
						{
							$html .= '<div class="';
							if(a($value, 'color'))
							{
								$html .= 'alert-'. $value['color'];
							}
							else
							{
								$html .= 'alert-secondary';

							}
							$html .='">';
							{
								$html .= '<div class="m-2">'. a($value, 'content'). '</div>';
								$html .= '<div class="row">';
								{
									$html .= '<div class="c">' . a($value, 'displayname'). '</div>';
									$html .= '<div class="c">' . T_(ucfirst(a($value, 'privacy'))). '</div>';
									$html .= '<div class="c">' . \dash\fit::date_time(a($value, 'datecreated')). '</div>';
									if(\dash\permission::check('FormRemoveAnswer'))
									{
										$html .= '<div class="c-auto"><div data-confirm data-data=\'{"removecomment" : "removecomment", "id" : "'.  a($value, 'id'). '"}\' class="">'. \dash\utility\icon::svg('trash', 'bootstrap', 'red', 'w-3'). '</div></div>';
									}
								}
								$html .= '</div>';
							}
							$html .= '</div>';

						}

					}
					$html .= '</div>';

				}
				$html .= '</div>';
			}
		}
		$html .= '</div>';
	}
	$html .= '</div>';
}

echo $html;
?>