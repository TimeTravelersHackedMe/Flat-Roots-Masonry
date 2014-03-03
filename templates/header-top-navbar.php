<header class="banner navbar navbar-default navbar-fixed-top" role="banner"
<?php if ( is_admin_bar_showing() ) echo ' style="margin-top:32px"';
?>>
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<?php if ( get_theme_mod( 'roots_logo' ) ) : ?>
<a class="navbar-brand logo-brand" href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><img class="logo" src='<?php echo esc_url( get_theme_mod( 'roots_logo' ) ); ?>' alt="<?php bloginfo('name'); ?>"></a>
<?php else : ?>
<a class="navbar-brand" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
<?php endif; ?>
</div>
    <nav class="collapse navbar-collapse" role="navigation">
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
        endif;
      ?>
<?php if (is_user_logged_in()) {  ?>
    <a type="button" class="btn btn-primary navbar-btn navbar-right" href="<?php echo wp_logout_url( home_url() ); ?>"><em class="fa fa-sign-out fa-lg"></em> Log Out</a>
<?php } else { ?>
<button type="button" data-toggle="modal" href="#signin" class="btn btn-primary navbar-btn navbar-right"><em class="fa fa-sign-in fa-large"></em> Log In</button>
<?php } ?>
</nav>
</div>
</header>
<div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="LoginLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><em class="fa fa-sign-in fa-lg"></em> Log In</h4>
        </div>
        <div class="modal-body">
        <p class="status"></p>
<ul class="list-inline text-center">
<li>
<a href="" class="btn btn-icon btn-facebook"><em class="fa fa-facebook"></em> Facebook</a>
</li>
<li>
<a href=""  class="btn btn-icon btn-twitter"><em class="fa fa-twitter"></em> Twitter</a>
</li>
<li>
<a href="" class="btn btn-icon btn-google"><em class="fa fa-google-plus"></em> Google</a>
</li>
</ul>
        <form id="login" action="login" method="post" role="form" >
                    <div class="form-group">
                      <div class="input-group input-icon">
                        <span class="input-group-addon">
                          <em class="fa fa-user fa-fw"></em>
                        </span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-icon">
                        <span class="input-group-addon">
                          <em class="fa fa-key fa-fw"></em>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                      </div>
                    </div>
                   <div class="form-group"><input type="submit" value="Log In" class="btn btn-primary pull-right">
<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
</form>
       <ul class="list-inline"><li><a href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a></li><li><a href="">Need to sign up?</a></li></ul></div>
         </div>
      </div>
    </div>
</div>
