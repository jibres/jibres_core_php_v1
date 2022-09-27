<?php
namespace lib\app\form\generate;


trait formBoxHtml
{


	public static function shipping_survey($_form_id)
	{
		$load_form = \lib\app\form\form\get::public_get_for_generate($_form_id);

		if(!$load_form)
		{
			return null;
		}

		self::$html = '';

		$load_items = \lib\app\form\item\get::items($_form_id);

		self::$html .= '<div class="box">';
		{
			self::$html .= '<div class="pad" >';
			{
				self::$html .= self::startTimeHtml($load_form);
				self::$html .= self::setLoadTokenInputHTML($load_form);
				self::$html .= '<input type="hidden" name="answerform" value="answerform">';

				if(a($load_form, 'file'))
				{
					self::$html .= '<img class="mb-2" src="' . a($load_form, 'file') . '" alt="' . a($load_form, 'title') . '">';
				}
				if(a($load_form, 'desc'))
				{
					self::$html .= '<div class="mb-4">' . a($load_form, 'desc') . '</div>';
				}


				\lib\app\form\generator::items($load_items);
			}
			self::$html .= '</div>';
		}
		self::$html .= '</div>';


		return self::$html;
	}


	public static function master_form_page_html()
	{
		$html = '';
		$html .= self::generateFinalMessageFromTransaction();
		$html .= '<div class="box">';
		{

			$html .= '<header class="c-xs-0"><h2>' . \dash\data::formDetail_title() . '</h2></header>';

			$html .= '<div class="body" data-jform>';
			{
				$load_form = \lib\app\form\form\get::public_get_for_generate(\dash\data::formId());

				$html      .= self::startTimeHtml($load_form);
				$html      .= self::setLoadTokenInputHTML($load_form);
				$html      .= \dash\csrf::html();
				$html      .= \dash\captcha\recaptcha::html();
				if(\dash\data::formDetail_status() !== 'publish' && \dash\data::accessLoadItem())
				{
					$html .= '<div class="alert-warning text-center font-bold">' . T_("Your form is not publish. Only you can view this form.") . ' <a class="btn-link" href="' . \lib\store::admin_url() . '/a/form/edit?id=' . \dash\data::formDetail_id() . '">' . T_("Edit form") . '</a></div>';
				}

				if(\dash\data::formDetail_file())
				{
					$html .= '<img class="mb-2" src="' . \dash\data::formDetail_file() . '" alt="' . \dash\data::formDetail_title() . '">';
				}
				if(\dash\data::formDetail_desc())
				{
					$html .= '<div class="mb-4 leading-loose">' . nl2br(\dash\data::formDetail_desc()) . '</div>';
				}


				if(\dash\data::accessLoadItem())
				{
					if($allow_form_schedule = self::check_schedule(\dash\data::formDetail_id()))
					{
						$html .= \lib\app\form\generator::items(\dash\data::formItems());
					}
					else
					{
						$html .= self::$schedule_message;
					}
				}
				else
				{
					$html .= '<div class="alert-warning">' . T_("Access to answer to this form is blocked") . '</div>';
				}
			}
			$html .= '</div>';



			if(\dash\data::accessLoadItem() && isset($allow_form_schedule) && $allow_form_schedule)
			{
				$html .= self::formFooter();
			}
		}
		$html .= '</div>';

		return $html;
	}


	public static function sitebuilder_full_html($_form_id)
	{
		$load_form = \lib\app\form\form\get::public_get_for_generate($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items = \lib\app\form\item\get::items($_form_id);

		$action = \dash\url::kingdom() . '/f/' . $_form_id;

		self::$html = '';

		self::$html .= '<form id="jformbuilder" method="post" autocomplete="off" action="' . $action . '" data-clear>';
		{
			self::$html .= '<div class="">';
			{
				self::$html .= self::generateFinalMessageFromTransaction();
				self::$html .= '<div class="box">';
				{
					self::$html .= \dash\csrf::html();
					self::$html .= \dash\captcha\recaptcha::html();
					self::$html .= '<input type="hidden" name="notredirect" value="1" data-unclear>';

					self::$html .= '<header class="c-xs-0"><h2>' . a($load_form, 'title') . '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= self::startTimeHtml($load_form);
						self::$html .= self::setLoadTokenInputHTML($load_form);
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';

						if(a($load_form, 'file'))
						{
							self::$html .= '<img class="mb-2" src="' . a($load_form, 'file') . '" alt="' . a($load_form, 'title') . '">';
						}
						if(a($load_form, 'desc'))
						{
							self::$html .= '<div class="mb-4 leading-relaxed">' . nl2br(a($load_form, 'desc')) . '</div>';
						}

						if($allow_form_schedule = self::check_schedule(\dash\data::formDetail_id()))
						{
							\lib\app\form\generator::items($load_items);
						}
						else
						{
							self::$html .= self::$schedule_message;
						}

					}
					self::$html .= '</div>';


					if(isset($allow_form_schedule) && $allow_form_schedule)
					{
						self::$html .= self::formFooter();
					}

				}
				self::$html .= '</div>';
			}
			self::$html .= '</div>';

		}
		self::$html .= '</form>';

		return self::$html;
	}


	public static function full_html($_form_id, $_option = [])
	{
		$load_form = \lib\app\form\form\get::public_get_for_generate($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items =
			\lib\app\form\item\get::items($_form_id, true, a($_option, 'delete_item'), a($_option, 'hidden_item'));

		self::$html = '';

		self::$html .= '<form id="jformbuilder" method="post" autocomplete="off">';
		{

			self::$html .= '<div class="">';
			{

				self::$html .= self::generateFinalMessageFromTransaction();
				self::$html .= '<div class="box">';
				{

					self::$html .= '<header class="c-xs-0"><h2>' . a($load_form, 'title') . '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= self::startTimeHtml($load_form);
						self::$html .= self::setLoadTokenInputHTML($load_form);
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';

						if(a($load_form, 'file'))
						{
							self::$html .= '<img class="mb-2" src="' . a($load_form, 'file') . '" alt="' . a($load_form, 'title') . '">';
						}
						if(a($load_form, 'desc'))
						{
							self::$html .= '<div class="mb-4">' . nl2br(a($load_form, 'desc')) . '</div>';
						}

						if($allow_form_schedule = self::check_schedule(\dash\data::formDetail_id()))
						{
							\lib\app\form\generator::items($load_items);
						}
						else
						{
							self::$html .= self::$schedule_message;
						}

					}
					self::$html .= '</div>';

					if(isset($allow_form_schedule) && $allow_form_schedule)
					{
						self::$html .= self::formFooter();
					}
				}
				self::$html .= '</div>';
			}
			self::$html .= '</div>';

		}
		self::$html .= '</form>';

		return self::$html;
	}


	/**
	 * Edit from
	 *
	 * @param <type> $_form_id   The form identifier
	 * @param <type> $_answer_id The answer identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function edit_html($_form_id, $_answer_id = null)
	{
		$load_form = \lib\app\form\form\get::public_get_for_generate($_form_id);

		if(!$load_form)
		{
			return null;
		}

		$load_items = [];

		if($_answer_id)
		{
			self::$load_answer = true;

			$load_items =
				\lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'), true, true);

			if(is_array($load_items))
			{
				self::$answer_detail = $load_items;
			}
		}

		if(!$load_items)
		{
			$load_items = \lib\app\form\item\get::items($_form_id);
		}

		self::$html = '';

		self::$html .= '<form id="jformbuilder" method="post" autocomplete="off">';
		{

			self::$html .= '<div class="">';
			{

				self::$html .= '<div class="box">';
				{
					self::$html .= '<header class="c-xs-0"><h2>' . a($load_form, 'title') . '</h2></header>';
					self::$html .= '<div class="body" data-jform>';
					{
						self::$html .= self::startTimeHtml($load_form);
						self::$html .= self::setLoadTokenInputHTML($load_form);
						self::$html .= '<input type="hidden" name="answerform" value="answerform">';


						\lib\app\form\generator::items($load_items);
					}
					self::$html .= '</div>';

					self::$html .= self::formFooter();
				}
				self::$html .= '</div>';
			}
			self::$html .= '</div>';

		}
		self::$html .= '</form>';

		return self::$html;
	}



}
