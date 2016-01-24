<?php
   $dbhost = 'db.matrixpe.net';
   $dbuser = 'mpe-server';
   $dbpass = '#Cookies153';
   
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn )
   {
      die('Could not connect: ' . mysql_error());
   }
   
   $sql = 'SELECT name, wins, deaths, kills, xp, coins FROM players';
   mysql_select_db('SkyWars');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval )
   {
      die('Could not get data: ' . mysql_error());
   }
   
   while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
   {
      echo "Name :{$row['name']}  <br> ".
         "Wins : {$row['wins']} <br> ".
         "Deaths : {$row['deaths']} <br> ".
         "Kills : {$row['kills']} <br> ".
         "XP : {$row['xp']} <br> ".
         "Coins : {$row['coins ']} <br> ".
         "--------------------------------<br>";
   }
   
   //echo "Fetched data successfully\n";
   
   mysql_close($conn);
?>
