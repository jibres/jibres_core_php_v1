<div class="f justify-center">
  <div class="c8 s12 m10 x6">
      <form method="post" autocomplete="off">
        <div class="box">
          <header><h2><?php echo T_("Change website status"); ?></h2></header>
          <div class="body">
            <p><?php echo T_("Choose your website status"); ?></p>
            <div class="radio3">
              <input type="radio" name="status" value="publish" id="typepublish" <?php if(\dash\data::websiteStatus() === 'publish') {echo 'checked';} ?>>
              <label for="typepublish"><?php echo T_("Publish"); ?></label>
            </div>

            <div class="radio3">
              <input type="radio" name="status" value="commingsoon" id="typecommingsoon" <?php if(\dash\data::websiteStatus() === 'commingsoon') {echo 'checked';} ?>>
              <label for="typecommingsoon"><?php echo T_("Comming Soon"); ?></label>
            </div>

            <div class="radio3">
              <input type="radio" name="status" value="visitcard" id="typevisitcard" <?php if(\dash\data::websiteStatus() === 'visitcard') {echo 'checked';} ?>>
              <label for="typevisitcard"><?php echo T_("Visit Card"); ?></label>
            </div>

          </div>
          <footer class="txtRa">
            <button class="btn success"><?php echo T_("Save"); ?></button>
          </footer>
        </div>
      </form>
  </div>
</div>