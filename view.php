<?php
require 'backend/includes/db.php'; // Zorg ervoor dat de databaseverbinding correct is ingesteld

// Haal het blog-ID uit de URL
$blog_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Controleer of het blog-ID geldig is en haal de bloggegevens op
$stmt = $conn->prepare("
    SELECT blogs.title, blogs.content, blogs.created_at, users.display_name 
    FROM blogs 
    JOIN users ON blogs.author_id = users.id 
    WHERE blogs.id = ? AND blogs.status = 'published'
");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();

// Controleer of de blog bestaat
if ($result->num_rows === 0) {
    die("The requested blog post does not exist or is not published.");
}

$blog = $result->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <meta http-equiv="Content-Language" content="en, English"> 
  <!-- <meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming"> 
  <meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">  -->
  <title><?= htmlspecialchars($blog['title']) ?> - Exorth RSPS</title> 
  <style type="text/css">/*\*/@import url(css/global.css);/**/</style> 
  <style type="text/css">/*\*/@import url(css/home.css);/**/</style> 
 </head> 
 <body id="navhome">   
<a name="top"></a> 
  <div id="scroll"> 
   <div id="head"> 
    <div id="headOrangeTop"></div> 
    <img src="img/banner.jpg" alt="Exorth"> 
    <div id="headImage">
     <a href="index.php" id="logo_select"></a> 
     <!-- <div id="player_no">
      Happy X-mass and a happy new year!
     </div>  -->
    </div> 
    <div id="headOrangeBottom"></div> 
    <div id="menubox"> 
     <ul id="menus"> 
      <li class="top"><a href="index.php" id="home" class="tl"><span class="ts">Home</span></a></li> 
      <li class="top"><a id="discord" class="tl" href="https://discord.gg/HgAR7swYYH" target="_blank"><span class="ts">Discord</span></a></li>
    </ul>
     <br class="clear"> 
    </div> 
   </div> 
   <div id="content"> 
     <div id="recentnews"> 
      <div class="sectionHeader"> 
        <div class="left"> 
         <div class="right"> 
          <div class="plaque_medium">
            <?= htmlspecialchars($blog['title']) ?>
          </div> 
         </div> 
        </div> 
       </div> 
      <div class="section"> 
       <div class="sectionBody first"> 
        <div class="News"> 
         <p>
            <?= $blog['content'] ?> <!-- HTML wordt correct weergegeven -->
         </p> 
         <p>
            <small>
                Published on: <?= date("d-M-Y", strtotime($blog['created_at'])) ?> 
                by: <?= htmlspecialchars($blog['display_name']) ?>
            </small>
         </p>
        </div> 
       </div>  
      </div> 
     </div> 
   </div> 
   <div id="footer">
    <div class="contain">
     <div class="footerdesc">
       <!-- &copy; Exorth.net.  -->
     </div>
    </div>
   </div> 
  </div> 
 </body>
</html>
