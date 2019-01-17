<?PHP
/***********************************************
Common stuff used daily by me
***********************************************/
class g_utils {
  /*********************************************
  Returns true if $haystack ends with $needle
  *********************************************/
  function endsWith($haystack, $needle) {
      $length = strlen($needle);
      if ($length == 0) {
          return true;
      }
      return (substr($haystack, -$length) === $needle);
  }
  /*********************************************
  Returns an array with path of files in a $dir directory 
  *********************************************/
  function getDirContents($dir, &$results = array()){
      $files = scandir($dir);

      foreach($files as $key => $value){
          $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
          if(!is_dir($path)) {
              $results[] = $path;
          } else if($value != "." && $value != "..") {
              getDirContents($path, $results);
              $results[] = $path;
          }
      }
      return $results;
  }
  //CLI-coloring
  function green($str) {
    return "\033[32m".$str."\033[0m";
  }
  function red($str) {
      return "\033[31m".$str."\033[0m";
  }
  function yellow($str) {
      return "\033[33m".$str."\033[0m";
  }
  function log($msg,$type = 'ERROR') {
    $return = true;
    $dir = __DIR__ .'/log';
    $message = "";
    if ($type == 'INLINE') {
        $return = "<pre>";
        $return .= var_export($msg,true);
        $return .= "</pre>";
    }
    if ($type != 'INLINE') {
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        if (is_array($msg)) {
            $message = var_export($msg,true);
        }
        else {
            $message = $msg;
        }
        $message = "[" . $date . " " . $time . "]" . "\t[" . $type . "]\t" . $message . "\n";
        $logfile = $dir."/".strtolower($type).".log";
        file_put_contents($logfile,$message,FILE_APPEND);
    }
    return $return;
  }
}

?>
