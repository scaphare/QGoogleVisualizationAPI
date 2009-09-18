<?php

function GUID($file)
{
  $time = str_split(time(),5);
  $str = str_split(strtoupper(md5($file)),4);
  $str[0] = strrev($time[0]);
  $str[7] = strrev($time[1]);
  return "/**-------TS".implode("-",$str)."--------*/";
}

$start = microtime(true);

$d = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."Google".DIRECTORY_SEPARATOR;

$r = new RecursiveDirectoryIterator($d);
$bytestotal=0;
$nbfiles=0;
$files = array();

$handle = fopen("Google.merge.v_1_0.php","w");
fwrite($handle,'<?php');
fwrite($handle,"\n");
fwrite($handle,"/**\n");
fwrite($handle," *\n * This program is free software; you can redistribute it and/or modify it under\n * the terms of the GNU General Public License as published by the Free Software\n * Foundation; either version 3 of the License, or (at your option) any later version.\n * \n * This program is distributed in the hope that it will be useful, but\n * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or\n * FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.\n * \n * You should have received a copy of the GNU General Public License along with\n * this program; if not, see <http://www.gnu.org/licenses/>.\n * \n");
fwrite($handle," * @author Thomas Schäfer <scaphare@googlemail.com>\n");
fwrite($handle," * @copyright 2009 Thomas Schäfer <scaphare@googlemail.com>\n");
fwrite($handle," * @since ".date("Y-m-d")."\n");
fwrite($handle," * @license GNU General Public License\n");
fwrite($handle," * @version 1.0\n");
fwrite($handle,"*/\n\n");


foreach (new RecursiveIteratorIterator($r) as $filename=>$cur) {
    $filesize=$cur->getSize();
    $bytestotal+=$filesize;
    $nbfiles++;
    $files[$filename] = $filesize;
    $a = explode(".",basename($filename));
    if($a[count($a)-1]=="php")
    {
      fwrite($handle, str_replace('<?php', GUID($filename) ,file_get_contents($filename)."\n"));
    }
}
fclose($handle);

$bytestotal=number_format($bytestotal);

echo "Total: $nbfiles files, $bytestotal bytes\n";

$end = microtime(true);
echo $end-$start."\n";

var_dump($files);