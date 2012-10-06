<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Crémaillère de Nath</title>
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

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">Crémaillère de Nath</a>
            <?php if(user()): ?>
              <div class="nav-collapse collapse">
                  <ul class="nav">
                      <li><a href="<?php echo url(''); ?>">Mon invitation</a></li>
                      <li><a href="<?php echo url('my-guest'); ?>">Mes invités</a></li>
                      <?php if (user()->is_admin): ?>
                        <li><a href="<?php echo url('all-guest'); ?>">Liste des invités</a></li>
                      <?php endif; ?>
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
