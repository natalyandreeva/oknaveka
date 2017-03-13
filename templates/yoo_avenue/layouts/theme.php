<?php
/**
* @package   yoo_avenue
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"  data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this['template']->render('head'); ?>
<link href="http://fonts.googleapis.com/css?family=Roboto:regular,600,700,900&subset=cyrillic,latin" rel="stylesheet">
</head>

<body  class="<?php echo $this['config']->get('body_classes'); ?>">
 <div class="popup" data-ix="popup" style="display: none;">
    <div class="form-wrapper w-form">
      <h4 class="title-form">Заказать звонок</h4>
      <form class="form" data-name="call back" id="wf-form-call-back" name="wf-form-call-back">
        <input class="input w-input" data-name="Name" id="Name-3" maxlength="256" name="Name" placeholder="Ваше имя" type="text">
        <input class="input w-input" data-name="telefon" id="telefon" maxlength="256" name="telefon" placeholder="Ваш телефон" required="required" type="text">
        <input class="form-but w-button" data-wait="идет отправка..." type="submit" value="Заказать звонок">
        <div class="_15-minute">перезвоним в течение 15 минут</div>
      </form>
      <div class="w-form-done">
        <div>Заявка отправлена менеджер свяжется
          <br>с Вами в течение 15 минут</div>
      </div>
      <div class="error w-form-fail" id="call-back">
        <div>Произошла ошибка попробуйте еще раз</div>
      </div>
    </div>
    <a class="close w-inline-block" data-ix="close" href="#">
      <img src="images/yootheme/demo/close-button.png" width="32">
    </a>
  </div>
	<div class="tm-page-bg">

		<div class="uk-container uk-container-center">

			<div class="tm-container">
              <div class="header-container">
				<?php if ($this['widgets']->count('logo + search + headerbar')) : ?>
				<div class="tm-headerbar uk-clearfix">

					<?php if ($this['widgets']->count('logo')) : ?>
					<a class="tm-logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
					<?php endif; ?>

					<?php if ($this['widgets']->count('search')) : ?>
					<div class="tm-search uk-float-right">
						<?php echo $this['widgets']->render('search'); ?>
					</div>
					<?php endif; ?>

					<?php echo $this['widgets']->render('headerbar'); ?>

				</div>
				<?php endif; ?>
			  </div>

				<?php if ($this['widgets']->count('menu + toolbar-l + toolbar-r')) : ?>
				<div class="tm-top-block tm-grid-block">

					<?php if ($this['widgets']->count('menu')) : ?>
					<nav class="tm-navbar uk-navbar" id="cssmenu">

						<?php if ($this['widgets']->count('menu')) : ?>
						<?php echo $this['widgets']->render('menu'); ?>
						<?php endif; ?>

						<?php if ($this['widgets']->count('offcanvas')) : ?>
						<a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas></a>
						<?php endif; ?>

						<?php /*if ($this['widgets']->count('logo-small')) : ?>
						<div class="uk-navbar-content uk-navbar-center uk-visible-small"><a class="tm-logo-small" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a></div>
						<?php endif; */?>

					</nav>
					<?php endif; ?>

					<?php if ($this['widgets']->count('toolbar-l + toolbar-r')) : ?>
					<div class="tm-toolbar uk-clearfix uk-hidden-small">

						<?php if ($this['widgets']->count('toolbar-l')) : ?>
						<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
						<?php endif; ?>

						<?php if ($this['widgets']->count('toolbar-r')) : ?>
						<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
						<?php endif; ?>

					</div>
					<?php endif; ?>

				</div>
				<?php endif; ?>

				<?php if ($this['widgets']->count('top-a')) : ?>
				<section class="<?php echo $grid_classes['top-a']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('top-a', array('layout'=>$this['config']->get('grid.top-a.layout'))); ?></section>
				<?php endif; ?>

				<?php if ($this['widgets']->count('top-b')) : ?>
				<section class="<?php echo $grid_classes['top-b']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('top-b', array('layout'=>$this['config']->get('grid.top-b.layout'))); ?></section>
				<?php endif; ?>

				<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
				<div class="tm-middle uk-grid" data-uk-grid-match>

					<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
					<div class="<?php echo $columns['main']['class'] ?>">

						<?php if ($this['widgets']->count('main-top')) : ?>
						<section class="<?php echo $grid_classes['main-top']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('main-top', array('layout'=>$this['config']->get('grid.main-top.layout'))); ?></section>
						<?php endif; ?>

						<?php if ($this['config']->get('system_output', true)) : ?>
						<main class="tm-content">

							<?php if ($this['widgets']->count('breadcrumbs')) : ?>
							<?php echo $this['widgets']->render('breadcrumbs'); ?>
							<?php endif; ?>

							<?php echo $this['template']->render('content'); ?>

						</main>
						<?php endif;?>

						<?php if ($this['widgets']->count('main-bottom')) : ?>
						<section class="<?php echo $grid_classes['main-bottom']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('main-bottom', array('layout'=>$this['config']->get('grid.main-bottom.layout'))); ?></section>
						<?php endif; ?>

					</div>
					<?php endif; ?>

		            <?php foreach($columns as $name => &$column) : ?>
		            <?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
		            <aside class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
		            <?php endif ?>
		            <?php endforeach ?>

				</div>
				<?php endif; ?>

				<?php if ($this['widgets']->count('bottom-a')) : ?>
				<section class="<?php echo $grid_classes['bottom-a']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('bottom-a', array('layout'=>$this['config']->get('grid.bottom-a.layout'))); ?></section>
				<?php endif; ?>

				<?php if ($this['widgets']->count('bottom-b + bottom-c + footer + debug')) : ?>
				<div class="tm-block-bottom">

					<?php if ($this['widgets']->count('bottom-b')) : ?>
					<section class="<?php echo $grid_classes['bottom-b']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('bottom-b', array('layout'=>$this['config']->get('grid.bottom-b.layout'))); ?></section>
					<?php endif; ?>

					<?php if ($this['widgets']->count('bottom-c')) : ?>
					<section class="<?php echo $grid_classes['bottom-c']; ?> tm-grid-block" data-uk-grid-match="{target:'> div > .uk-panel'}"><?php echo $this['widgets']->render('bottom-c', array('layout'=>$this['config']->get('grid.bottom-c.layout'))); ?></section>
					<?php endif; ?>

					<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
					<footer class="tm-footer">

						<?php if ($this['config']->get('totop_scroller', true)) : ?>
						<a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
						<?php endif; ?>

						<?php
							echo $this['widgets']->render('footer');
							$this->output('warp_branding');
							echo $this['widgets']->render('debug');
						?>

					</footer>
					<?php endif; ?>

				</div>
				<?php endif; ?>

			</div>

		</div>

	</div>

	<?php echo $this->render('footer'); ?>

	<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
	<?php endif; ?>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '154592';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->

</script>
<!--MOBILEFRIENDLY-->
<script>
function mobilefriendly() {
  if ( !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) ) return;
  var styles = document.styleSheets;
  if ( styles.length > 0 ) for ( i = 0; i < styles.length; i++ ) styles[i].disabled = true;
  var link = document.createElement('link');
  link.rel = 'stylesheet';
  link.type = 'text/css';
  link.href = 'mob-style.css';
  document.head.appendChild(link)
}
</script>	
</body>
<!--script async type="text/javascript" src="//api.pozvonim.com/widget/callback/v3/6a3249f96b3575c1832af5e2f31ae51b/connect" id="check-code-pozvonim" charset="UTF-8"></script-->

</html>