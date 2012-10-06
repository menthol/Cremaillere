<?php

function controller_error404($args) {
  return array(
    'content' => view('error404'),
  );
}
