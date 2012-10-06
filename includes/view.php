<?php

function view($view_name, $variables = array()) {
  ob_start();
  extract($variables);
  @include BASE_DIRECTORY . "/views/$view_name.tpl.php";
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}
