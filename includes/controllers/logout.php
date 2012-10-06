<?php

function controller_logout($args) {
  user(null);
  redirect('');
}
