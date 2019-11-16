<?php
error_reporting(0);
system("clear");
$banner = "\e[33;1m                                                                                 
   _   _             _            _   _ _     _
  | | | |_   _ _ __ | |_ ___ _ __| \ | | |__ | |____
  | |_| | | | | '_ \| __/ _ \ '__|  \| | '_ \| |_  /
  |  _  | |_| | | | | ||  __/ |  | |\  | |_) | |/ /
  |_| |_|\__,_|_| |_|\__\___|_|  |_| \_|_.__/|_/___|
                                                                            

    }---------------------------------------{                               
}--------------> \033[1;32mYahoo Mail Valid\e[0;1m\e[33;1m <--------------{
    }---------------------------------------{
                                                                            
 Coded By : Muhammad Nabil / HunterNblz
 Github   : https//github.com/hunternblz\n\n\e[0;1m";
sleep(2);
echo $banner;
sleep(2);
echo "[\033[1;31m?\e[0;1m] List Mail : ";
$list = trim(fgets(STDIN));
echo "\n";
$file = file_get_contents("$list");
$data = explode("\n", str_replace("\r", "", $file));
$x = 0;
for ($a = 0; $a < count($data); $a++) {
    $email   = $data[$a];
    $x++;
     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.nabill.me/yahoo.php?email='.$email);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers   = array();
    $headers[] = 'Connection: Keep-Alive';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    $hasil = json_decode($result);
    curl_close($ch);
	$status = $hasil->status;
	if($status == 'live'){
		echo "$email | \033[1;32mLive\e[0;1m\n";
		$x = fopen("Yahoo_LIVE.txt", "a+");
		fwrite($x, $email."\r\n");
	}else{
		echo "$email | \e[1;91mDie\e[0;1m\n";
		$x = fopen("Yahoo_DIE.txt", "a+");
		fwrite($x, $email."\r\n");
    }
}
?>
