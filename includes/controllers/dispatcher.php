<?php

function controller_dispatcher($args) {
  if (user() && user()->is_admin) {
    redirect('my_guests');
  }
  redirect('login/' . $args[0]);
}
