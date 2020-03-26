
<div class="f justify-center">
  <div class="c6 m8 s12 x4">
    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Set your application download link from stores"); ?></h2></header>

      <div class="body">
          <p class="">
            <?php echo T_("You can customize application download page"); ?>
            <br>
            <a data-direct target="_blank" href="<?php echo \lib\store::subdomain_url(). '/app'; ?>"><?php echo T_("Download page"); ?></a>

          </p>

          <label for="title"><?php echo T_("Download title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="title" value="<?php echo \dash\data::appDetail_downloadtitle(); ?>" maxlength="50">
          </div>

          <label for="desc"><?php echo T_("Download description"); ?></label>
          <textarea class="txt mB10" name="desc" maxlength="150" rows="3" id="desc" ><?php echo \dash\data::appDetail_downloaddesc(); ?></textarea>


          <label for="googleplay"><?php echo T_("Google Play Store"); ?></label>
          <div class="input">
            <input type="url" name="googleplay" id="googleplay" value="<?php echo \dash\data::appDetail_googleplay(); ?>">
          </div>

          <label for="cafebazar"><?php echo T_("Cafebazar"); ?></label>
          <div class="input">
            <input type="url" name="cafebazar" id="cafebazar" value="<?php echo \dash\data::appDetail_cafebazar(); ?>">
          </div>

          <label for="myket"><?php echo T_("Myket"); ?></label>
          <div class="input">
            <input type="url" name="myket" id="myket" value="<?php echo \dash\data::appDetail_myket(); ?>">
          </div>


      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Save"); ?></button>
      </footer>
    </form>
  </div>

</div>


