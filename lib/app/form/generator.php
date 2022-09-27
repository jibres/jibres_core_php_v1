<?php
namespace lib\app\form;


use lib\app\form\generate\element;
use lib\app\form\generate\formBoxHtml;
use lib\app\form\generate\formFooter;
use lib\app\form\generate\items;
use lib\app\form\generate\randomQuestion;
use lib\app\form\generate\schedule;
use lib\app\form\generate\startButton;
use lib\app\form\generate\timeLimit;
use lib\app\form\generate\token;
use lib\app\form\generate\transactionMessage;


class generator
{

	use token;
	use timeLimit;
	use schedule;
	use transactionMessage;
	use formBoxHtml;
	use element;
	use items;
	use startButton;
	use formFooter;
	use randomQuestion;


	private static $html = '';
	private static $answer_detail = [];
	private static $load_answer = false;
	private static $schedule_message = '';
	private static $formDetail = [];
	private static $startTime = null;
	private static $formTimeLimited = false;
	private static $formStartButton = false;


}