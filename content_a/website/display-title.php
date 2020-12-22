<?php

$lineSetting = \dash\data::lineSetting();

if(!a($lineSetting, 'title') && a($lineSetting, 'title') !== '0')
{
  $currentTitle =  \dash\data::nameSuggestion();
}
else
{
  $currentTitle = a($lineSetting, 'title');
}

?>

<?php if(\dash\url::subchild() !== 'title') {?>
<section class="f" data-option='website-line-news-title'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo $currentTitle; ?></h3>
      <div class="body">
        <?php if(a($lineSetting, 'more_link') === 'show') {?>
          <div class="fc-mute"><?php echo T_("Title with more link") ?></div>
        <?php } //endif ?>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::that(). '/title'. \dash\request::full_get(); ?>"><?php echo T_("Edit title"); ?></a>
      </div>
  </div>
</section>

<?php }else{  // url subchild is title ?>
<form method="post" autocomplete="off" id="formboxtitle">
  <input type="hidden" name="set_title" value="1">
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <label for="title"><?php echo T_("Line title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php if(!a($lineSetting, 'title') && a($lineSetting, 'title') !== '0'){ echo \dash\data::nameSuggestion(); }else{ echo a($lineSetting, 'title'); } ?>"  maxlength="200">
        </div>
        <div class="mB10">
           <div class="row">
              <div class="c-xs-6 c-sm-6">
                <div class="radio3">
                  <input type="radio" name="show_title" value="yes" id="showtitleyes" <?php if(a($lineSetting, 'show_title') === 'yes' || !a($lineSetting, 'show_title')) { echo 'checked';} ?>>
                  <label for="showtitleyes"><?php echo T_("Show title on website") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c-sm-6">
                <div class="radio3">
                  <input type="radio" name="show_title" value="no" id="showtitleno" <?php if(a($lineSetting, 'show_title') === 'no') { echo 'checked';} ?>>
                  <label for="showtitleno"><?php echo T_("Do not show title on website") ?></label>
                </div>
              </div>
            </div>
        </div>

        <?php if(\dash\url::child() === 'news') {?>
          <div data-response='show_title' data-response-where='yes' <?php if(a($lineSetting, 'show_title') === 'yes' || !a($lineSetting, 'show_title')) {}else{ echo 'data-response-hide';} ?>>
            <div class="mB10">
              <div class="row">
                <div class="c-xs-6 c-sm-6">
                  <div class="radio3">
                    <input type="radio" name="more_link" value="show" id="showmorelink" <?php if(a($lineSetting, 'more_link') === 'show' || !a($lineSetting, 'more_link')) { echo 'checked';} ?>>
                    <label for="showmorelink"><?php echo T_("Show read more link") ?></label>
                  </div>
                </div>
                <div class="c-xs-6 c-sm-6">
                  <div class="radio3">
                    <input type="radio" name="more_link" value="hide" id="hidemorelink" <?php if(a($lineSetting, 'more_link') === 'hide') { echo 'checked';} ?>>
                    <label for="hidemorelink"><?php echo T_("Hide read more link") ?></label>
                  </div>
                </div>
              </div>
            </div>

            <div data-response='more_link' data-response-where='show' <?php if(a($lineSetting, 'more_link') === 'show' || !a($lineSetting, 'more_link')) {}else{ echo 'data-response-hide';} ?>>
              <label for="more_link_caption"><?php echo T_("Caption of more link"); ?></label>
              <div class="input">
                <input type="text" name="more_link_caption" id="more_link_caption" value="<?php echo a($lineSetting, 'more_link_caption');  ?>"  maxlength="200">
              </div>
            </div>
          </div>
        <?php } // endif ?>
      </div>
    </div>
  </div>
</form>

<?php } //endif ?>