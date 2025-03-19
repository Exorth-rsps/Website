<?php
require 'backend/includes/db.php'; // Zorg ervoor dat de databaseverbinding correct is ingesteld

// Haal recente blogberichten op (bijvoorbeeld de 3 meest recente)
$stmt = $conn->prepare("SELECT title, content, created_at, id FROM blogs WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$result = $stmt->get_result();

// Functie om afbeeldingen te verwijderen uit de HTML
function stripImages($html) {
    // Verwijder <img> tags
    return preg_replace('/<img[^>]*>/i', '', $html);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <meta http-equiv="Content-Language" content="en, English"> 
  <!-- <meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming"> 
  <meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">  -->
  <title>Exorth RSPS</title> 
  <style type="text/css">/*\*/@import url(css/global.css);/**/</style> 
  <style type="text/css">/*\*/@import url(css/home.css);/**/</style> 
  <script type="text/javascript">
 function h(o){o.getElementsByTagName('span')[0].className='shimHover';}
 function u(o){o.getElementsByTagName('span')[0].className='shim';}
</script> 
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
    <?php include 'menu.php'; ?>
     <br class="clear"> 
    </div> 
   </div> 
   <div id="content"> 
    <div id="left"> 
     <div id="features"> 
      <div class="narrowHeader">Featured</div> 
      <div class="section"> 
       <div class="feature">
        <a href="https://discord.gg/HgAR7swYYH" target="_blank">
          <img src="img/main/home/feature_upgrade_icon.jpg" alt="">
        </a> 
        <div class="featureTitle">Join our Discord</div> 
        <div class="featureDesc">
         Join our Discord and stay tuned! <a href="https://discord.gg/HgAR7swYYH" target="_blank">Join here!</a>
        </div> 
       </div> 
      </div> 
     </div> 
     <p>
     <iframe
            src="https://discord.com/widget?id=1224396880994107452&theme=dark"
            width="100%"
            height="300"
            allowtransparency="true"
            frameborder="0"
            sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts">
        </iframe>
        
     </p>
    </div> 
    <div id="right"> 
     <div id="recentnews"> 
      <div class="sectionHeader"> 
       <div class="left"> 
        <div class="right"> 
         <div class="plaque">Recent News</div> 
        </div> 
       </div> 
      </div> 
      <div class="section">
       <?php while ($blog = $result->fetch_assoc()): ?>
       <div class="sectionBody"> 
        <div class="recentNews"> 
         <div class="newsTitle"> 
          <h3><?= htmlspecialchars($blog['title']) ?></h3> 
          <span><?= date("d-M-Y", strtotime($blog['created_at'])) ?></span> 
         </div> 
         <p>
           <?= substr(stripImages($blog['content']), 0, 150) ?>...
           <a href="view.php?id=<?= $blog['id'] ?>">Read more...</a>
         </p> 
        </div> 
       </div>
       <?php endwhile; ?>
      </div> 
     </div> 
    </div> 
   </div> 
   <div id="footer">
    <div class="contain">
     <div class="footerdesc"></div>
    </div>
   </div> 
  </div> 
 </body>
</html>
