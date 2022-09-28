<?php
$html = '';

if(\dash\request::get('print'))
{
	if(\dash\data::specailPage())
	{
		$html .= \dash\data::specailPage();
	}
	else
	{
		$html .= '<div class="printArea" data-size="A4">';
		{

			$html .= '<div class="alert-info text-left ltr font-bold text-sm">';
			{

				$html .= '<div class="f">';
				{

					$html .= '<div class="cauto">';
					{

						$html .= '<span>' . T_("Answer ID") . '</span>';
						$html .= '<span><code class="inline-block font-bold">' . \dash\request::get('id') . '_' . \dash\request::get('aid') . '</code></span>';
					}
					$html .= '</div>';

					$html .= '<div class="c"></div>';

					$html .= '<div class="cauto">';
					{
						$html .= '<a class="font-14 print:hidden" href="' . \dash\url::current() . \dash\request::full_get(['print' => null]) . '">' . T_("Back") . '</a>';
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

					$i = 0;
					foreach (\dash\data::dataTable() as $key => $value)
					{
						$i++;
						if($i % 2)
						{
							$html .= '<tr>';
						}

						$html .= '<th class="">' . a($value, 'item_title') . '</th>';
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

}
else
{

	$html .= '<div class="row">';
	{

		$html .= '<div class="c-xs-12 c-sm-12 c-md-12 c-lg-7">';
		{


			if(\dash\data::answerTransactionDetail())
			{

				$html .= '<a href="' . \dash\url::kingdom() . '/crm/transactions/detail?id=' . \dash\data::answerDetail_transaction_id() . '">';
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
								$html .= '<span class="font-bold mx-4">' . \dash\fit::number(\dash\data::answerTransactionDetail_plus()) . ' ' . \lib\store::currency() . '</span>';
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


			if(is_numeric(\dash\data::answerDetail_totalscore()))
			{


				$html .= '<div class="alert-info">';
				{
					$html .= '<div class="row">';
					{
						$html .= '<div class="c-auto">';
						{
							$html .= T_("Total score");
						}
						$html .= '</div>';

						$html .= '<div class="c"></div>';
						$html .= '<div class="c-auto">';
						{
							$html .= '<span class="font-bold mx-4">' . \dash\fit::number(\dash\data::answerDetail_totalscore()) . '</span>';
						}
						$html .= '</div>';

					}
					$html .= '</div>';
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
								$html .= \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);
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


		$html .= '<div class="c-xs-12 c-sm-12 c-md-12 c-lg-5 print:hidden">';
		{
			$html .= '<form method="post" id="markasreview">';
			{
				$html .= '<input type="hidden" name="review" value="review">';
			}
			$html .= '</form>';

			$html .= '<div class="tblBox">';
			{

				$html .= '<table class="tbl1 v2">';
				{

					$html .= '<tbody>';
					{


						$html .= '<tr>';
						{
							$html .= '<th class="text-sm">' . T_("Answer id") . '</th>';
							$html .= '<td>';
							{
								$html .= '<span><code class="inline-block font-bold">' . \dash\request::get('id') . '_' . \dash\request::get('aid') . '</code></span>';
								$html .= '<a class="btn-link" href="' . \dash\url::that() . '/edit' . \dash\request::full_get() . '">' . T_("Edit") . "</div>";
							}
							$html .= '</td>';

						}
						$html .= '</tr>';

						$html .= '<tr>';
						{
							$html .= '<th class="text-sm">' . T_("Date register") . '</th>';
							$html .= '<td>';
							{
								$html .= \dash\fit::date_time(\dash\data::answerDetail_datecreated());
							}
							$html .= '</td>';

						}
						$html .= '</tr>';


						// $html .= '<tr>';
						// {
						// 	$html .= '<th class="text-sm">'. T_("Print").'</th>';
						// 	$html .= '<td>';
						// 	{
						// 		$html .= '<a class="font-14" href="'. \dash\url::current(). \dash\request::full_get(['print' => 1]). '"><i class="sf-print"></i></a>';
						// 	}
						// 	$html .= '</td>';

						// }
						// $html .= '</tr>';

						if(\dash\data::answerDetail_ticket_id())
						{
							$html .= '<tr>';
							{
								$html .= '<th class="text-sm">' . T_("View ticket") . '</th>';
								$html .= '<td>';
								{
									$html .= '<a class="btn-link" href="' . \dash\url::kingdom() . '/crm/ticket/view?id=' . \dash\data::answerDetail_ticket_id() . '">' . T_("Ticket :val", ['val' => \dash\fit::number(\dash\data::answerDetail_ticket_id())]) . '</a>';
								}
								$html .= '</td>';

							}
							$html .= '</tr>';
						}
						else
						{
							$html .= '<tr>';
							{
								$html .= '<th class="text-sm">' . T_("Save as ticket") . '</th>';
								$html .= '<td>';
								{
									$html .= '<div class="btn-link" data-confirm data-data=\'{"save_as_ticket" : "save_as_ticket"}\'>' . T_("Save this answer as a ticket") . '</a>';
								}
								$html .= '</td>';

							}
							$html .= '</tr>';
						}

						$html .= '<tr>';
						{
							$html .= '<th class="text-sm">' . T_("Review") . '</th>';
							$html .= '<td>';
							{
								if(\dash\data::answerDetail_review())
								{
									$html .= '<div>' . \dash\fit::date_time(\dash\data::answerDetail_review()) . '</a>';
								}
								else
								{
									$html .= '<div class="btn-link" data-ajaxify data-method="post" data-data=\'{"review" : "review"}\'>' . T_("Mark as reviewed") . '</a>';
								}
							}
							$html .= '</td>';

						}
						$html .= '</tr>';


						$html .= '<tr>';
						{
							$html .= '<th class="text-sm">' . T_("Answer status") . '</th>';
							$html .= '<td>';
							{
								$status =
									[
										'draft'   => T_("draft"),
										'active'  => T_("active"),
										'spam'    => T_("spam"),
										'archive' => T_("archive"),
										// 'unknown'     => T_("unknown"),
										// 'start'       => T_("start"),
										// 'skip'        => T_("skip"),
										// 'filter'      => T_("filter"),
										// 'complete'    => T_("complete"),
										// 'block'       => T_("block"),
										// 'enable'      => T_("enable"),
										// 'disable'     => T_("disable"),
										// 'deleted'     => T_("deleted"),
										// 'done'        => T_("done"),
										// 'review'      => T_("review"),
										// 'pending'     => T_("pending"),
										// 'other'       => T_("other"),
										// 'payed'       => T_("payed"),
										// 'expire'      => T_("expire"),
										// 'cancel'      => T_("cancel"),
										// 'reject'      => T_("reject"),
										// 'trash'       => T_("trash"),
										// 'approved'    => T_("approved"),
										// 'awaiting'    => T_("awaiting"),
										// 'unapproved'  => T_("unapproved"),
										// 'close'       => T_("close"),
										// 'deactive'    => T_("deactive"),
										// 'unreachable' => T_("unreachable"),
									];

								if(\dash\data::answerDetail_status() === 'deleted')
								{
									$status['deleted'] = T_("deleted");
								}

								$html .= '<form method="post" autocomplete="off" data-patch>';
								{
									$html .= '<input type="hidden" name="setstatus" value="setstatus">';

									$html .= '<select name="status" class="select22">';
									{
										$html .= '<option value=""></option>';
										foreach ($status as $key => $value)
										{
											$html .= '<option value="' . $key . '" ';
											if(\dash\data::answerDetail_status() === $key)
											{
												$html .= 'selected';
											}
											$html .= '>' . $value . '</option>';
										}
									}
									$html .= '</select>';
								}
								$html .= '</form>';
							}
							$html .= '</td>';

						}
						$html .= '</tr>';


						$html .= '<tr>';
						{
							// $html .= '<th class="text-sm">'. T_("Print").'</th>';
							$html .= '<td colspan="3">';
							{
								$html .= '<div class="row">';
								{
									$html .= '<div class="c-auto">';
									{
										$html .= '<a class="font-14" href="' . \dash\url::current() . \dash\request::full_get(['print' => 1]) . '" title="' . T_("Print") . '"><i class="sf-print"></i></a>';
									}
									$html .= '</div>';

									if(a(\dash\data::formDetail(), 'reportpage'))
									{
										$html .= '<div class="c-auto">';
										{
											$html .= '<a target="_blank" class="btn-success" href="' . \dash\url::current() . \dash\request::full_get(['print'   => 1,
																																					   'special' => 1,
												]) . '" title="' . T_("Print by special design");
											$html .= '"><i class="sf-print"></i> ' . T_("Print by specai desing") . '</a>';
										}
										$html .= '</div>';
									}


									$html .= '<div class="c"></div>';

									$html .= '<div class="c-auto">';
									{
										if(\dash\data::answerDetail_status() !== 'deleted')
										{
											$html .= '<div data-confirm data-data=\'{"setstatus" : "setstatus", "status" : "deleted"}\' data-method="post" title= "' . T_("Remove answer") . '">';
											{
												$html .= \dash\utility\icon::svg('delete', 'major', 'red', 'w-5 mx-4 mt-2');
											}
											$html .= '</div>';
										}
									}
									$html .= '</div>';
								}
								$html .= '</div>';

							}
							$html .= '</td>';

						}
						$html .= '</tr>';


						if(a(\dash\data::answerDetail(), 'factor_id'))
						{
							$html .= '<tr>';
							{
								$html .= '<th class="text-sm">' . T_("View Order") . '</th>';
								$html .= '<td>';
								{
									$html .= '<a href="' . \dash\url::kingdom() . '/a/order/comment?id=' . a(\dash\data::answerDetail(), 'factor_id') . '">' . T_("View Order") . '</a>';
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
								$html .= '<label for="tag">' . T_("Tag") . '</label>';
							}
							$html .= '</div>';

							$html .= '<div class="c-auto os">';
							{
								$html .= '<a class="text-sm" ';
								if(!\dash\detect\device::detectPWA())
								{
									$html .= " target='_blank' ";
								}
								$html .= ' href="' . \dash\url::here() . '/form/tag' . \dash\request::full_get() . '">' . T_("Manage") . ' <i class="sf-link-external"></i></a>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$html .= '<select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">';
						{
							foreach (\dash\data::allTagList() as $key => $value)
							{
								$html .= '<option value="' . $value['title'] . '"';
								if(in_array($value['title'], \dash\data::tagsSavedTitle()))
								{
									$html .= ' selected';
								}
								$html .= '>';
								$html .= $value['title'];

								if(a($value, 'autocomment'))
								{
									$html .= ' 💬 ';
								}

								if(a($value, 'sendsms'))
								{
									$html .= ' 📱 ';
								}

								$html .= '</option>';
							}
						}
						$html .= '</select>';

					}
					$html .= '</div>';
					$html .= '<footer class="txtRa">';
					$html .= '<button class="btn-outline-secondary btn-sm">' . T_("Save") . '</button>';
					$html .= '</footer>';
				}
				$html .= '</div>';
			}
			$html .= '</form>';

			if(\dash\data::answerDetail_inquirytimes())
			{
				$inquerytimes = json_decode(\dash\data::answerDetail_inquirytimes(), true);
				if(!is_array($inquerytimes))
				{
					$inquerytimes = [];
				}

				if($inquerytimes)
				{
					$html .= '<div class="box">';
					{
						$html .= '<header data-kerkere=".showInquiryTimes" data-kerkere-icon><h2>' . T_("Inquiry time by customer");
						if(a($inquerytimes, 'last', 'time'))
						{
							$html .= '<b> ' . \dash\fit::date_time(a($inquerytimes, 'last', 'time'), 'l j F Y H:i') . '</b>';
						}

						$html .= '</h2></header>';
						$html .= '<div class="body padLess showInquiryTimes" data-kerkere-content="hide">';
						{
							$html .= '<div class="tblBox">';
							{

								$html .= '<table class="tbl1 v2">';
								{

									$html .= '<tbody>';
									{

										if(a($inquerytimes, 'first', 'time') === a($inquerytimes, 'last', 'time'))
										{
											$html .= '<tr>';
											{
												$html .= '<th class="text-sm">' . T_("Last inquiry time") . '</th>';
												$html .= '<td>' . \dash\fit::date_time(a($inquerytimes, 'first', 'time'), 'l j F Y H:i') . '</td>';
											}
											$html .= '</tr>';
										}
										else
										{
											$html .= '<tr>';
											{
												$html .= '<th class="text-sm">' . T_("First inquiry time") . '</th>';
												$html .= '<td>' . \dash\fit::date_time(a($inquerytimes, 'first', 'time'), 'l j F Y H:i') . '</td>';
											}
											$html .= '</tr>';
											$html .= '<tr>';
											{
												$html .= '<th class="text-sm">' . T_("Count inquiry") . '</th>';
												$html .= '<td>' . \dash\fit::number(a($inquerytimes, 'count')) . ' ' . T_("times") . '</td>';
											}
											$html .= '</tr>';
											$html .= '<tr>';
											{
												$html .= '<th class="text-sm">' . T_("Last inquiry time") . '</th>';
												$html .= '<td>' . \dash\fit::date_time(a($inquerytimes, 'last', 'time'), 'l j F Y H:i') . '</td>';
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
						$html .= '</div>';
					}
					$html .= '</div>';

				}

			}


			$html .= '<form method="post" autocomplete="off">';
			{

				$html .= '<div class="box">';
				{

					$html .= '<header><h2>' . T_("Add note to this answer") . '</h2></header>';
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
							$html .= '<div class="c-xs-12 c-sm-12 mb-1">';
							{
								$html .= '<div class="radio3">';
								{
									$html .= '<input type="radio" name="privacy" value="private" checked id="privacyprivate">';
									$html .= '<label for="privacyprivate">' . T_("Private") . ' <small class="hidden md:inline-block">' . T_('Only your can view this note') . '</small></label>';
								}
								$html .= '</div>';
							}
							$html .= '</div>';

							$html .= '<div class="c-xs-12 c-sm-12 mb-1">';
							{
								$html .= '<div class="radio3">';
								{
									$html .= '<input type="radio" name="privacy" value="public"  id="privacypublic">';
									$html .= '<label for="privacypublic">' . T_("Public") . ' <small class="hidden md:inline-block">' . T_('Your and customer can view this note') . '</small></label>';
								}
								$html .= '</div>';
							}
							$html .= '</div>';
						}
						$html .= '</div>';

						$list   = [];
						$list[] = ['key' => 'primary', 'title' => T_('Blue')];
						$list[] = ['key' => 'secondary', 'title' => T_('Black')];
						$list[] = ['key' => 'success', 'title' => T_('Green')];
						$list[] = ['key' => 'danger', 'title' => T_('Red')];
						$list[] = ['key' => 'warning', 'title' => T_('Yellow')];
						$list[] = ['key' => 'info', 'title' => T_('Light blue')];
						$list[] = ['key' => 'light', 'title' => T_('Light')];
						$list[] = ['key' => 'dark', 'title' => T_('Dark')];

						$html .= '<label for="color">' . T_("Color") . '</label>';
						$html .= '<select name="color" class="select22" id="color">';
						{
							$html .= '<option value="">' . T_("None") . '</option>';
							foreach ($list as $key => $value)
							{
								$html .= '<option value="' . $value['key'] . '">' . $value['title'] . '</option>';
							}
						}
						$html .= '</select>';


					}
					$html .= '</div>';

					$html .= '<footer class="f">';
					{
						$html .= '<div class="c"></div>';
						$html .= '<div class="cauto">';
						$html .= '<button class="btn-outline-secondary btn-sm">' . T_("Add note") . '</button>';
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

						$html .= '<h2>' . T_("Notes") . '</h2>';

						foreach (\dash\data::commentList() as $key => $value)
						{
							$html .= '<div class="';
							if(a($value, 'color'))
							{
								$html .= 'alert-' . $value['color'];
							}
							else
							{
								$html .= 'alert-secondary';

							}
							$html .= '">';
							{
								$html .= '<div class="m-2">' . nl2br(strval(a($value, 'content'))) . '</div>';

								$html .= '<div data-kerkere=".showMore' . a($value, 'id') . '" >' . \dash\utility\icon::svg('three-dots', 'bootstrap', null, 'w-4') . '</div>';

								$html .= '<div class="showMore' . a($value, 'id') . '" data-kerkere-content="hide" >';
								{
									$html .= '<hr class="my-2">';

									$html .= '<div class="">';
									{
										$html .= '<div class="tblBox">';
										{

											$html .= '<table class="tbl1 v2">';
											{

												$html .= '<tbody>';
												{

													if(a($value, 'from_tag_id'))
													{
														$html .= '<tr>';
														{
															$html .= '<th class="text-sm">' . T_("Auto note from tag") . '</th>';
															$html .= '<td>' . \lib\app\form\tag\get::get_title($value['from_tag_id']) . '</td>';
														}
														$html .= '</tr>';
													}

													if(a($value, 'displayname'))
													{
														$html .= '<tr>';
														{
															$html .= '<th class="text-sm">' . T_("Operator") . '</th>';
															$html .= '<td>' . a($value, 'displayname') . '</td>';
														}
														$html .= '</tr>';
													}

													$html .= '<tr>';
													{
														$html .= '<th class="text-sm">' . T_("Type") . '</th>';
														$html .= '<td>' . T_(ucfirst(strval(a($value, 'privacy')))) . '</td>';
													}
													$html .= '</tr>';

													$html .= '<tr>';
													{
														$html .= '<th class="text-sm">' . T_("Date") . '</th>';
														$html .= '<td>' . \dash\fit::date_time(a($value, 'date')) . '</td>';
													}
													$html .= '</tr>';


													if(a($value, 'dateview'))
													{
														$html .= '<tr>';
														{
															$html .= '<td colspan="2">' . T_("Viewed by customer at") . ' <b>' . \dash\fit::date_time(a($value, 'dateview'), 'l j F Y H:i') . '</b></td>';
														}
														$html .= '</tr>';
													}

													if(\dash\permission::check('FormRemoveAnswer'))
													{
														$html .= '<tr>';
														{

															$html .= '<td colspan="2">';
															{
																$html .= '<div class="row">';
																{
																	$html .= '<div class="c-auto">';
																	{
																		$html .= '<a href="' . \dash\url::that() . '/note' . \dash\request::full_get(['noteid' => $value['id']]) . '" class="text-blue-500">' . T_("Edit note") . '</a>';

																	}
																	$html .= '</div>';
																	$html .= '<div class="c"></div>';
																	$html .= '<div class="c-auto">';
																	{

																		$html .= '<div data-confirm data-data=\'{"removecomment" : "removecomment", "id" : "' . a($value, 'id') . '"}\' class="text-red-500">' . T_("Remove note") . '</div>';
																	}
																	$html .= '</div>';

																}
																$html .= '</div>';


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
									$html .= '</div>';
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