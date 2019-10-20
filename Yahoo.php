<?php
error_reporting(0);
system("clear");
$banner = "\e[33;1m                                                                                 
                                                                                 
╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱                      
╭╮╱╭┳╮╱╭┳━╮╱╭┳━━━━┳━━━┳━━━┳━╮╱╭┳━━╮╭╮╱╱╭━━━━╮
┃┃╱┃┃┃╱┃┃┃╰╮┃┃╭╮╭╮┃╭━━┫╭━╮┃┃╰╮┃┃╭╮┃┃┃╱╱╰━━╮━┃
┃╰━╯┃┃╱┃┃╭╮╰╯┣╯┃┃╰┫╰━━┫╰━╯┃╭╮╰╯┃╰╯╰┫┃╱╱╱╱╭╯╭╯
┃╭━╮┃┃╱┃┃┃╰╮┃┃╱┃┃╱┃╭━━┫╭╮╭┫┃╰╮┃┃╭━╮┃┃╱╭╮╭╯╭╯
┃┃╱┃┃╰━╯┃┃╱┃┃┃╱┃┃╱┃╰━━┫┃┃╰┫┃╱┃┃┃╰━╯┃╰━╯┣╯━╰━╮
╰╯╱╰┻━━━┻╯╱╰━╯╱╰╯╱╰━━━┻╯╰━┻╯╱╰━┻━━━┻━━━┻━━━━╯
╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱╱
                              
                                                                                 
[×] Yahoo Email Checker Validation [×]    
                                   
Coded By : Muhammad Nabil / HunterNblz                  
Github   : https//github.com/hunternblz\n\n\e[0;1m";
sleep(2);
echo $banner;
sleep(2);
echo "[\e[33;1m+\e[0;1m] List Email : ";
$list = trim(fgets(STDIN));
echo "\n";
$file = file_get_contents("$list");
$data = explode("\n", str_replace("\r", "", $file));
$x = 0;
for ($a = 0; $a < count($data); $a++) {
    $email   = $data[$a];
    $x++;
     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://nabill.me/api/yahoo.php?email='.$email);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers   = array();
    $headers[] = 'Connection: Keep-Alive';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    $hasil = json_decode($result);
    curl_close($ch);

    if($hasil->status === "live"){
        $x = fopen("HunterNblz_LIVE.txt", "a+");
        fwrite($x, $email."\r\n");
    }else{
        $x = fopen("HunterNblz_DEAD.txt", "a+");
        fwrite($x, $email."\r\n");
    }
    echo "\e[1;92m$email | \e[1;91m".$hasil->status."\e[0m\n";
}
?>
