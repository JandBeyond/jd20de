<?php defined( '_JEXEC' ) or die;

JHtml::script(Juri::base() . 'templates/'.$this->template.'/build/app.js');
JHtml::stylesheet(Juri::base() . 'templates/'.$this->template.'/build/style.css?v1');
JHtml::stylesheet(Juri::base() . 'templates/'.$this->template.'/css/custom.css?v1');

$app = JFactory::getApplication();
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$menu = $app->getMenu();
$active = $app->getMenu()->getActive();

?><!doctype html>
<html lang="<?php echo $this->language; ?>">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Juri::base() . 'templates/'.$this->template; ?>/img/favicon/apple-touch-icon.png"> 
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Juri::base() . 'templates/'.$this->template; ?>/img/favicon/favicon-32x32.png"> 
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Juri::base() . 'templates/'.$this->template; ?>/img/favicon/favicon-16x16.png"> 
  <link rel="manifest" href="<?php echo Juri::base() . 'templates/'.$this->template; ?>/img/favicon/site.webmanifest"> 
  <link rel="mask-icon" href="<?php echo Juri::base() . 'templates/'.$this->template; ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5"> 
  <meta name="msapplication-TileColor" content="#00aba9"> 
  <meta name="theme-color" content="#ffffff">
  <jdoc:include type="head" />
</head>

<body class="jd19de <?php echo $active->alias . ' ' . $pageclass; ?>">
  <div id="background">

    <nav role="navigation">
      <div id="mainMenu" class="wrap-inside">
        <input type="checkbox" />
        <span></span>
        <span></span>
        <span></span>
        <jdoc:include type="modules" name="menu" />
      </div>
    </nav>

    <header>
      <div class="wrap-inside">
        <jdoc:include type="modules" name="header" />
      </div>
    </header>

    <main>
      <div class="wrap-inside">
        <?php if ($this->countModules( 'intro' )) : ?>
          <section id="particles-intro" class="intro">
            <jdoc:include type="modules" name="intro" />
          </section>
        <?php else: ?>
          <section id="particles-logo" class="logo">
            <a href="<?php echo Juri::base(); ?>">
              <jdoc:include type="modules" name="logo" />
            </a>
          </section>
        <?php endif; ?>

        <?php if (
          $this->countModules('top_a') ||
          $this->countModules('top_b') ||
          $this->countModules('top_c')
        ) : ?>
          <section id="top">
            <jdoc:include type="modules" name="top_a" />
            <jdoc:include type="modules" name="top_b" />
            <jdoc:include type="modules" name="top_c" />
          </section>
        <?php endif; ?>

        <div class="main-content">
          <article class="<?php echo ($this->countModules('sidebar')) ? ('with-sidebar') : ('full-width'); ?>">
            <jdoc:include type="component" />
          </article>
          
          <?php if ($this->countModules('sidebar')) : ?>
            <aside>
              <jdoc:include type="modules" name="sidebar" />

            </aside>
          <?php endif; ?>
        </div>

        <?php if (
          $this->countModules('bottom_a') ||
          $this->countModules('bottom_b') ||
          $this->countModules('bottom_c')
        ) : ?>
          <section id="bottom">
            <jdoc:include type="modules" name="bottom_a" />
            <jdoc:include type="modules" name="bottom_b" />
            <jdoc:include type="modules" name="bottom_c" />
          </section>
        <?php endif; ?>
      </div>
    </main>

    <footer>
      <div class="wrap-inside">
        <jdoc:include type="modules" name="footer" style="xhtml" />
      </div>
    </footer>
    <div class="hinweis">
      <div class="wrap-inside">
       <jdoc:include type="modules" name="footer2" style="xhtml" />
      </div>
     </div>

  </div>
</body>

</html>
