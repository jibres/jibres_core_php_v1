

    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Tell us a little about yourself"); ?></h1>
          <p><?php echo T_("Your answer is important for us."); ?></p>

          <form method="post" autocomplete="off">
            <?php foreach (\dash\data::polls_questions() as $key => $myQ) {?>

            <label for="<?php echo $myQ['id']; ?>"><?php echo $myQ['title']; ?></label>
            <select class="select" id="<?php echo $myQ['id']; ?>" name="<?php echo $myQ['id']; ?>">
              <option selected disabled><?php echo \dash\data::polls_placeholder(); ?></option>

            <?php foreach ($myQ['items'] as $itemKey => $myItem) {?>

              <option value="<?php echo $itemKey; ?>"><?php echo $myItem; ?></option>

            <?php } //endfor ?>

            </select>

            <?php } //endfor ?>

            <div class="f">
              <div class="c pRa5">
                <button class="btn success block"><?php echo T_("Next"); ?></button>
              </div>
              <div class="cauto os pLa5">
                <button class="btn block" name="skip" value="skip"><?php echo T_("Skip"); ?></button>
              </div>
            </div>
          </form>

          <img src="<?php echo \dash\url::cdn(); ?>/img/store/answer-polls.svg" alt='<?php echo T_("answer Jibres polls"); ?>'>

        </div>



      </div>

      <div class="f align-center">
        <div class="cauto os"><a href="<?php echo \dash\url::this(); ?>" class="btn"><?php echo T_("Cancel"); ?></a></div>
      </div>
    </div>

