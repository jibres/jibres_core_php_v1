<?php require_once(core. 'layout/tools/stepGuide.php'); ?>


<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Choose your profile type"); ?></h2></header>

      <div class="body">

        <div class="f">
          <div class="c6 s12">
            <a class="btn block xl light" href="<?php echo \dash\url::this(). '/profile?type=real'; ?>"><?php echo T_("Real person") ?></a>
          </div>
          <div class="c6 s12">
            <a class="btn block xl mLa5 light" href="<?php echo \dash\url::this(). '/profile?type=legal'; ?>"><?php echo T_("Legal profile") ?></a>
          </div>
        </div>



      </div>


    </form>
  </div>
</div>


