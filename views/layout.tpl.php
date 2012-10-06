<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>The Crémaillère de Nath</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
    </style>
    <link href="/css/bootstrap-responsive.min.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body>
<a class="visible-desktop" target="_blank" href="https://github.com/menthol/Cremaillere"><img style="position: absolute; top: 40px; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png" alt="Fork me on GitHub"></a>
<a class="hidden-desktop" target="_blank" href="https://github.com/menthol/Cremaillere"><img style="position: absolute; top: 50px; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_red_aa0000.png" alt="Fork me on GitHub"></a>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo url('') ?>">The Crémaillère de Nath</a>
            <?php if(user()): ?>
              <div class="nav-collapse collapse">
                  <ul class="nav">
                    <?php
                      $links = array(
                        '' => 'Mon invitation',
                        'my_info' => 'Mes informations',
                        'my_guests' => 'Mes invités',
                        'all_guests' => 'Liste des invités',
                        'error404' => '',
                      );
                      if (!user()->is_admin) {
                        unset($links['all_guests']);
                      }
                      $current = in_array($controller, array_keys($links)) ? $controller : '';
                      unset($links['error404']);
                      foreach($links as $path => $title): ?>
                        <li<?php echo $path == $current ? ' class="active"' : null; ?>><a href="<?php echo url($path); ?>"><?php echo $title; ?></a></li>
                      <?php endforeach;?>
                  </ul>
                  <ul class="nav pull-right">
                      <li><a href="<?php echo url('logout'); ?>">Déconnexion</a></li>
                  </ul>
              </div><!--/.nav-collapse -->
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container">

    <?php echo $content; ?>

    <hr>

    <footer>
        <p>&copy; Crémaillère de Nath 2012</p>
    </footer>

</div> <!-- /container -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>


</body>
</html>
