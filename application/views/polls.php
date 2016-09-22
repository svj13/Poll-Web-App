
<?php
/**
 * @file polls.php
 * @author Matthew Ruffell
 * @date 10 October 2014
 * @brief This file simply serves up the original angular frontpage
 */
echo doctype('html5');
?>


<html lang="en" ng-app="pollsApp">
<head>
    
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.
      min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLe
      gxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <title>Poll World</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <?php
  $links = array (
    "angularjs/scripts/angular.js", 
    "angularjs/scripts/angular-route.js",
    "angularjs/js/app.js",
    "angularjs/js/controllers.js",
    "Chart.min.js"  
      
    );
  $scripts = "";
  foreach ($links as $value) {
      $scripts.= '<script src="';
      $scripts.= base_url($value);
      $scripts.= '"></script>';
      $scripts.= "\n";
  }
  echo $scripts;
  ?>
</head>

<body>


<div class="jumbotron">
  <h1>Poll World</h1>

</div>
    
</div>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="#/about">About</a></li>
      <li><a href="#/polls/">Polls</a></li>
      <li><a href="#/votes/">Admin View</a></li>
    </ul>
  </div>
</nav>


  

</body>
  <div class="container">
    <div ng-view></div>
  </div>
  

</body>
</html>
