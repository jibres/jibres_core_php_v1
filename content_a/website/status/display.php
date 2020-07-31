<div class="f justify-center">
  <div class="c8 s12 m10 x6">
      <form method="post" autocomplete="off">
        <div class="box">
          <header><h2><?php echo T_("Change website status"); ?></h2></header>
          <div class="body">
            <p><?php echo T_("Choose your website status"); ?></p>
            <div class="radio3">
              <input type="radio" name="status" value="publish" id="typepublish" <?php if(\dash\data::websiteStatus() === 'publish') {echo 'checked';} ?>>
              <label for="typepublish"><?php echo T_("Shoping website"); ?></label>
            </div>

            <div class="radio3">
              <input type="radio" name="status" value="visitcard" id="typevisitcard" <?php if(\dash\data::websiteStatus() === 'visitcard') {echo 'checked';} ?>>
              <label for="typevisitcard"><?php echo T_("Visit Card website"); ?></label>
            </div>

            <div class="radio3">
              <input type="radio" name="status" value="comingsoon" id="typecomingsoon" <?php if(\dash\data::websiteStatus() === 'comingsoon') {echo 'checked';} ?>>
              <label for="typecomingsoon"><?php echo T_("Coming Soon page"); ?></label>
            </div>


          </div>
          <footer class="txtRa">
            <button class="btn success"><?php echo T_("Save"); ?></button>
          </footer>
        </div>
      </form>
  </div>
</div>