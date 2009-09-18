<?php

if(!defined('DS'))
{
  define("DS", DIRECTORY_SEPARATOR);
}
if(!defined('CLASSESDIR'))
{
  define("CLASSESDIR", dirname(__FILE__).DIRECTORY_SEPARATOR."classes");
}

if(!function_exists('js_replace'))
{
  function js_replace($search, $replacePairs) {
    return preg_replace(array_keys($replacePairs), array_values($replacePairs), $search);
  }
}

if(!function_exists('includeFile'))
{
  function includeFile($classFile)
  {
    if(is_file($classFile)) {
      include $classFile;
      return true;
    } else  {
      return false;
    }
  }
}

function googleAutoload($class) {

  $hasIncluded = false;
  $hasIncluded2 = false;

  $strClassPath = $class;

  // [className].php in basedir
  $hasIncluded = includeFile(dirname(__FILE__).DIRECTORY_SEPARATOR.$class.".php");

  if (empty($hasIncluded) and substr($strClassPath, 0, strlen("Google")) === 'Google')
  {
    $classFile = CLASSESDIR
      . DIRECTORY_SEPARATOR
      . str_replace("_",DIRECTORY_SEPARATOR,$strClassPath)
      . '.php';

    $hasIncluded = includeFile($classFile);
    if($hasIncluded)
    {
      $hasIncluded2 = true;
    }
  }
  if(empty($hasIncluded))
  {
    throw new InvalidArgumentException("autoloading of class $class impossible. Namespace syntax for classes seems to be wrong.");
  }

}
spl_autoload_register('googleAutoload');

