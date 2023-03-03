
<?php

$api_key = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
//aldığınız api key
$steamid = "XXXXXXXXXXXXXXXXXXXXXX";
//kişinin steamidsi 

$api_url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key&steamids=$steamid";
//api adresi

$json = json_decode(file_get_contents($api_url), true);
//json

function personaState($state)
//kişinin aktiflik durumu
{
    if ($state == 1)
    {
        return "Online";
    }
    elseif ($state == 2)
    {
        return "Busy";
    }
    elseif ($state == 3)
    {
        return "Away";
    }
    elseif ($state == 4)
    {
        return "Snooze";
    }
    elseif ($state == 5)
    {
        return "Looking to trade";
    }
    elseif ($state == 6)
    {
        return "Looking to play";
    }
    else
    {
        return "Offline";
    }
    
}

?>
<html lang="tr">
    <head>
    </head>
    <body>
        <!--jsondan gelen verilerin ekrana yazdırılması--> 
        <h1><?=$json["response"]["players"][0]["personaname"];?></h1>
        <img src="<?=$json["response"]["players"][0]["avatarfull"];?>">
        <ul>
            <li>SteamID64: <?=$json["response"]["players"][0]["steamid"];?></li>
            <li>Display Name: <?=$json["response"]["players"][0]["personaname"];?></li>
            <li>URL: <?=$json["response"]["players"][0]["profileurl"];?></li>
         
            <li>Status:- <?= personaState($json["response"]["players"][0]["personastate"]) ?></li>
            <li>Real Name: <?=$json["response"]["players"][0]["realname"];?></li>
            
            <li>Joined: <?=date('d M Y H:i:s Z',$json["response"]["players"][0]["timecreated"]);?></li>
            <!--steam apisi tarih olarak unix time yani  Ocak 1970'ten beri geçen saniye sayısına denilen sayısal veri tipini döndürüyor bu da onun çevirilmiş hali-->
            <li>Country: <?=$json["response"]["players"][0]["loccountrycode"];?></li>
        </ul>
    </body>

</html>