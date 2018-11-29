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
}

?>