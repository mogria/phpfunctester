<?php
if(function_exists($_POST['func'])) {
  ob_start();
  var_dump(call_user_func_array($_POST['func'], $_POST['arg']));
  $content = ob_get_contents();
  ob_end_clean();

  echo htmlspecialchars($content);
} else {
  echo "this function does not exist!";
}
