<div class="row">
  <div class="c-xs-0 c-sm-0 c-lg-4 c-xl-3 d-lg-block">
    <?php require_once(root. 'content_a/form/itemLink.php');?>
  </div>
  <div class="c-lg-8 c-xl-9">
	  <?php require_once(root . 'content_a/form/formTitle.php'); ?>
    <form method="post" autocomplete="off" id="form1" >
      <div class="box">
        <div class="pad">

          <div class="row">

            <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
              <div class="radio4">
                <input  id="draft" type="radio" name="status" value="draft" <?php if(\dash\data::dataRow_status() == 'draft') {echo 'checked';} ?>>
                <label for="draft">
                  <div>
                    <div class="title"><?php echo T_("Draft"); ?></div>
                    <div class="addr"><?php echo T_("The form is draft"); ?></div>
                  </div>
                </label>
              </div>
            </div>

            <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
              <div class="radio4">
                <input  id="publish" type="radio" name="status" value="publish" <?php if(\dash\data::dataRow_status() == 'publish') {echo 'checked';} ?>>
                <label for="publish">
                  <div>
                    <div class="title"><?php echo T_("Publish"); ?></div>
                    <div class="addr"><?php echo T_("The form is publish"); ?></div>
                  </div>
                </label>
              </div>
            </div>

            <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
              <div class="radio4">
                <input  id="expire" type="radio" name="status" value="expire" <?php if(\dash\data::dataRow_status() == 'expire') {echo 'checked';} ?>>
                <label for="expire">
                  <div>
                    <div class="title"><?php echo T_("Expire"); ?></div>
                    <div class="addr"><?php echo T_("The form is expire"); ?></div>
                  </div>
                </label>
              </div>
            </div>

            <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
              <div class="radio4">
                <input  id="trash" type="radio" name="status" value="trash" <?php if(\dash\data::dataRow_status() == 'trash') {echo 'checked';} ?>>
                <label for="trash">
                  <div>
                    <div class="title"><?php echo T_("Trash"); ?></div>
                    <div class="addr"><?php echo T_("Move to trash"); ?></div>
                  </div>
                </label>
              </div>
            </div>
          </div>
<?php

$html = '';
$html .= '<div data-response="status" data-response-where="publish"  ';
{
  if(\dash\data::dataRow_status() !== 'publish')
  {
    $html .= 'data-response-hide';
  }
  $html .= '>';

  $have_schedule = false;

  if(\dash\data::dataRow_starttime() || \dash\data::dataRow_endtime())
  {
    $have_schedule = true;
  }
  $html .= '<div class="switch1">';
  {
    $html .= '<input type="checkbox" name="schedule" id="schedule"';
    if($have_schedule)
    {
      $html .= 'checked';
    }

    $html .='>';
    $html .= '<label for="schedule"></label>';
    $html .= '<label for="schedule">'.T_("Form activation schedule").'</label>';
  }
  $html .= '</div>';

  $html .= '<div data-response="schedule"';
  if(!$have_schedule)
  {
    $html .= 'data-response-hide';
  }

  $html .= '>';
  {
    $html .= '<div class="row">';
    {
      $html .= '<div class="c">';
      {
        $html .= '<label for="startdate">'. T_("Start date").'</label>';
        $html .= '<div class="input">';
        {
          $html .= '<input type="tel" name="startdate" data-format="date" id="startdate" value="'. ((\dash\data::dataRow_starttime()) ? \dash\fit::number_en(\dash\fit::date(date("Y-m-d", strtotime(\dash\data::dataRow_starttime())))) : '').'">';
        }
        $html .= '</div>';
      }
      $html .= '</div>';

      $html .= '<div class="c">';
      {

        $html .= '<label for="starttime">'. T_("Start time").'</label>';
        $html .= '<div class="input">';
        {
          $html .= '<input type="tel" name="starttime" data-format="time" id="starttime" value="'. ((\dash\data::dataRow_starttime()) ? date("H:i", strtotime(\dash\data::dataRow_starttime())) : '').'">';
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
          $html .= '<input type="tel" name="enddate" data-format="date" id="date" value="'. ((\dash\data::dataRow_endtime()) ? \dash\fit::number_en(\dash\fit::date(date("Y-m-d", strtotime(\dash\data::dataRow_endtime())))) : '').'">';
        }
        $html .= '</div>';
      }
      $html .= '</div>';

      $html .= '<div class="c">';
      {

        $html .= '<label for="endtime">'. T_("End time").'</label>';
        $html .= '<div class="input">';
        {
          $html .= '<input type="tel" name="endtime" data-format="time" id="endtime" value="'. ((\dash\data::dataRow_endtime()) ? date("H:i", strtotime(\dash\data::dataRow_endtime())) : '').'">';
        }
        $html .= '</div>';
      }
      $html .= '</div>';
    }
    $html .= '</div>';

    $html .= '<div class="mb-2">';
    {
      $html .= '<label for="beforestart">'. T_("This message is displayed before the start of the form response time") . '</label>';
      $html .= '<textarea name="beforestart" class="txt" rows="3" id="beforestart" >'. a(\dash\data::dataRow(), 'setting', 'beforestart'). '</textarea>';
    }
    $html .= '</div>';

    $html .= '<div class="mb-2">';
    {
      $html .= '<label for="afterend">'. T_("This message will be displayed after the response time of the form") . '</label>';
      $html .= '<textarea name="afterend" class="txt" rows="3" id="afterend" >'. a(\dash\data::dataRow(), 'setting', 'afterend'). '</textarea>';
    }
    $html .= '</div>';
  }
  $html .= '</div>';
}
$html .= '</div>';
echo $html;
?>

        </div>
        <?php if(\dash\data::dataRow_status() == 'trash') { ?>
          <footer class="txtRa">
            <div class="btn-link-danger" data-confirm data-data='{"status" : "deleted"}'><?php echo T_("Delete completely") ?></div>
          </footer>
        <?php } ?>
      </div>
    </form>
  </div>
</div>
