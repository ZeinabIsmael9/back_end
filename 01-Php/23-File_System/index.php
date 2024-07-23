<?php
/*Part 1 => create file or directory and read , write data in file */

$file = file_exists(getcwd().'/file.txt');
var_dump($file);
echo "<br>";

// Read file 
// R read
$file2 = fopen("text.txt","r");
//var_dump($file2);
while(!feof($file2)){
    echo fgets($file2)."<br>";
}
fclose($file2);
echo "<br>";


// Create File
// W write
$file3 = fopen("text.txt","w");
fwrite($file3,"Welcome in PHP\n\r");
fwrite($file3,"Welcome in PHP\n\r");
fclose($file3);

$file3 = fopen("text.txt","r");
echo is_writable("text.txt");
// while(!feof($file3)){
//     echo fgets($file3)."<br>";
// }
fclose($file3);
// Create New Folder + make mood
if (! is_dir("storage")){
    mkdir("storage",0777,true);
}
$file4 = fopen("storage/file.txt","w");
fwrite($file4, "TEST");
fclose($file4);
echo "<hr>";



/*Part 2 => copy and delete files and directory */

// delete file
// if(file_exists("storage/file.txt")){
//     unlink("storage/file.txt");
// }
// if (is_dir("storage")){
//     rmdir("storage");
// }
echo "<br>";

//copy file

if (! is_dir("storage")){
    mkdir("storage",0777,true);
}
$file4 = fopen("storage/file.txt","w");
fwrite($file4, "TEST");
fclose($file4);
copy("storage/file.txt","storage/file1.txt");
echo "<hr>";



/*Part 3 =>  touch function  */

// $file5 = fopen("demo.txt","w+");
// fwrite($file5,"lolo");
// fclose($file5);

touch("demo.txt",time()-999);


/*Part 3 => symbolic link symlink function */

// $target = "inc/index.php";
// $link ="index.php";
// symlink("inc","config");

echo "<hr>";

/*Part 4 =>  filesize and filetype */
echo filesize("storage/file.txt");
echo "<br>";
echo filetype("storage/file.txt");
echo "<hr>";


/*Part 5 => get and put file contents  */
$file5 = file_get_contents("text.txt");
$output = file_put_contents("text.txt",$file5."\n\r Welcome in PHP Zeinab");
