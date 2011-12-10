<?php

function cast($var, $type) {
  switch($type) {
    default: 
    case "string":
      return (string) $var;
      break;
    case "int":
      return (int) $var;
      break;
    case "bool":
      return (bool) $var;
      break;
    case "float":
      return (float) $var;
      break;
    case "double":
      return (double) $var;
      break;
  }
}


// Is a function given?
if(isset($_POST['func'])) {
  $func = $_POST['func'];
  // does the function exist?
  if(function_exists($func)) {

    // get all the arguments and the datatypes given
    $arg = isset($_POST['arg']) && is_array($_POST['arg']) ? array_values($_POST['arg']) : array();
    $type = isset($_POST['type']) && is_array($_POST['type']) ? array_values($_POST['type']) : array();

    // the same amount?
    if(count($arg) === count($type)) {

      // cast the arguments to the given datatypes
      foreach($arg as $key => $value) {
        $arg[$key] = cast($value, $type[$key]);
      }

      // get number of params the function has
      $reflection = new ReflectionFunction($func);
      $num_params = $reflection->getNumberOfRequiredParameters();
      
      // enougth params given?
      if(count($arg) >= $num_params) {
        // write to a buffer
        ob_start();

        //call the function
        var_dump(call_user_func_array($_POST['func'], $arg));

        //get the content of the buffer
        $content = ob_get_contents();
        //clean the buffer
        ob_end_clean();
        echo htmlspecialchars($content);
      } else {
        echo "to few parameters given.";
      }
    } else {
      echo "Diffrent number of datatypes and parameters?!";
    }
  } else {
    echo "this function does not exist!";
  }
}
