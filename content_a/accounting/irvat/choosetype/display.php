
<div class="f justify-center">
  <div class="c6 m8 s12">



    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Choose factor type"); ?></h2></header>

      <div class="body">


        <div class="f mB10">

          <div class="c s6">
            <a href="<?php echo \dash\url::that(); ?>/add?type=cost" class="stat">
              <h3>&nbsp;</h3>
              <div class="val"><?php echo T_("Add cost"); ?></div>
            </a>
          </div>


          <div class="c s6 mLa10">
            <a href="<?php echo \dash\url::that(); ?>/add?type=income" class="stat">
              <h3>&nbsp;</h3>
              <div class="val"><?php echo T_("Add income"); ?></div>
            </a>
          </div>

        </div>


      </div>

    </form>
  </div>
</div>