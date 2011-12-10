<?php


if(isset($_POST['func'])) {
  $func = $_POST['func'];
  if(function_exists($func)) {
    $arg = isset($_POST['arg']) ? $_POST['arg'] : array();
    $func = $_POST['func'];

    $reflection = new ReflectionFunction($func);
    $num_params = $reflection->getNumberOfRequiredParameters();
    
    if(count($arg) >= $num_params) {
      ob_start();
      var_dump(call_user_func_array($_POST['func'], $arg));
      $content = ob_get_contents();
      ob_end_clean();
      echo htmlspecialchars($content);
    } else {
      echo "to few parameters given.";
    }
  } else {
    echo "this function does not exist!";
  }
}
