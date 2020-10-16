<div class="avand">
  <?php $answer_question = \dash\data::chartDetail(); ?>
  <nav class="items">
    <ul>
      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Total business"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($answer_question, 'total'));?> <small><?php echo T_("Business") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Total Answered to all question"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($answer_question, 'answer_all'));?> <small><?php echo T_("User") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Total Skip all answer"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($answer_question, 'skip_all'));?> <small><?php echo T_("User") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

      <li>
        <a class="f item">
          <div class="key"><?php echo T_("Total Answer to some question"); ?></div>
          <div class="value"><?php echo \dash\fit::text(\dash\get::index($answer_question, 'som_answer'));?> <small><?php echo T_("User") ?></small></div>
          <div class="go"></div>
        </a>
      </li>

    </ul>
  </nav>


<div class="row">
  <div class="c-xs-12 c-6">
    <div id="chartdivpieskipanswer" class="box chart notActive x400" data-abc='love/business_answer'></div>

  </div>
  <div class="c-xs-12 c-6">
    <div id="chartdivbarskipanswer" class="box chart notActive x400" data-abc='love/business_answer'></div>

  </div>
</div>


    <div id="chartdivq1love" class="box chart notActive x400" data-abc='love/business_answer'></div>
    <div id="chartdivq2love" class="box chart notActive x400" data-abc='love/business_answer'></div>
    <div id="chartdivq3love" class="box chart notActive x400" data-abc='love/business_answer'></div>






<div class="hide">

  <div id="charttitleskipanswer"><?php echo T_("Total skip and answer"); ?></div>
  <div id="chartdataskipanswer"><?php echo \dash\get::index($answer_question, 'chart_skip_answer'); ?></div>



  <div id="chartdivq1lovetitle"><?php echo \dash\get::index($answer_question, 'chart_q1', 'title') ?></div>
  <div id="chartdivq1lovedata"><?php echo \dash\get::index($answer_question, 'chart_q1', 'data') ?></div>

  <div id="chartdivq2lovetitle"><?php echo \dash\get::index($answer_question, 'chart_q2', 'title') ?></div>
  <div id="chartdivq2lovedata"><?php echo \dash\get::index($answer_question, 'chart_q2', 'data') ?></div>

  <div id="chartdivq3lovetitle"><?php echo \dash\get::index($answer_question, 'chart_q3', 'title') ?></div>
  <div id="chartdivq3lovedata"><?php echo \dash\get::index($answer_question, 'chart_q3', 'data') ?></div>


</div>



</div>