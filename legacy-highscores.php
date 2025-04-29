<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Language" content="en, English">
  <title>Legacy - Exorth RSPS</title>
  <style type="text/css">@import url(css/global.css);</style>
  <style type="text/css">@import url(css/home.css);</style>
  <style>
    /* Flex container: skills left, table fills right */
    #hiscores_container {
      display: flex;
      align-items: flex-start;
      width: 100%;
      gap: 12px;
      box-sizing: border-box;
    }

    /* Skills menu styling */
    #skillsList_back {
      background: #4d3b18;
      border: 1px solid #5e4a25;
      border-radius: 3px;
      overflow: hidden;
      flex: 0 0 160px;
    }
    #skillsList_back .subsectionHeader {
      background: #6f562e;
      color: #ffd65a;
      font-weight: bold;
      text-align: center;
      padding: 6px 0;
      border-bottom: 1px solid #5e4a25;
      font-size: 14px;
    }
    #skillsList ul { list-style: none; margin: 0; padding: 0; }
    #skillsList li {
      position: relative;
      padding: 5px 10px;
      background: #43381f;
      border-bottom: 1px solid #5e4a25;
      cursor: pointer;
      text-align: center;
      transition: background 0.2s;
    }
    #skillsList li.selected { background: #ffd65a; }
    #skillsList li.selected a { color: #3b2a0f; font-weight: bold; }
    #skillsList li:hover { background: #5e4a25; }
    #skillsList li .ico {
      position: absolute;
      left: 10px;
      top: 50%;
      width: 18px;
      height: 18px;
      background-size: contain;
      background-repeat: no-repeat;
      transform: translateY(-50%);
    }
    #skillsList li a {
      display: inline-block;
      color: #e1d3a4;
      text-decoration: none;
      font-size: 13px;
    }

    /* Table container fills remaining space */
    #playerList_back {
      background: #4d3b18;
      border: 1px solid #5e4a25;
      border-radius: 3px;
      flex: 1 1 0;
      min-width: 0;
      overflow-x: auto;
    }
    #playerList_back .subsectionHeader {
      background: #6f562e;
      color: #ffd65a;
      font-weight: bold;
      text-align: center;
      padding: 6px;
      border-bottom: 1px solid #5e4a25;
      font-size: 14px;
    }

    /* Table styling */
    .table_back {
      width: 100%; /* fill container */
      border-collapse: collapse;
      font-size: 13px;
      margin: 0;
    }
    .table_back thead th {
      background: #5e4a25;
      color: #ffd65a;
      font-weight: bold;
      padding: 6px 12px;
      border-bottom: 2px solid #5e4a25;
      text-align: left;
    }
    .table_back tbody tr:nth-child(odd) td {
      background: #43381f;
    }
    .table_back tbody tr:nth-child(even) td {
      background: #3c3120;
    }
    .table_back tbody td {
      padding: 6px 12px;
      color: #e1d3a4;
      border-bottom: 1px solid #5e4a25;
      text-align: left;
    }
    /* Right-align cells with class alL */
    .table_back tbody td.alL {
      text-align: right;
    }
    .table_back tbody tr:hover td {
      background: #6f562e;
      color: #ffffff;
    }
    .table_back tbody a {
      color: #ffd65a;
      text-decoration: none;
    }
    .table_back tbody a:hover {
      text-decoration: underline;
    }
  </style>
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
    <div id="recentnews">…</div>
    <div class="sectionHeader"> 
        <div class="left"> 
         <div class="right"> 
          <div class="plaque_medium">
            Exorth Legacy Server - Highscores
          </div> 
         </div> 
        </div> 
       </div> 
    <div class="section">
      <div class="brown_background">
        <div class="inner_brown_background" id="hiscores_container">

          <!-- Skills menu -->
          <div id="skillsList_back">
            <div class="subsectionHeader">Skills</div>
            <div id="skillsList">
              <ul>
                <li class="selected">
                  <span class="ico" style="background-image:url('/img/icons/skill_overall.gif')"></span>
                  <a href="?skill=overall">Overall</a>
                </li>
                <li>
                  <span class="ico" style="background-image:url('/img/icons/skill_attack.gif')"></span>
                  <a href="?skill=0">Attack</a>
                </li>
                <li>
                  <span class="ico" style="background-image:url('/img/icons/skill_defence.gif')"></span>
                  <a href="?skill=1">Defence</a>
                </li>
                <!-- additional skills... -->
              </ul>
            </div>
          </div>

          <!-- Hiscores table -->
          <div id="playerList_back">
            <div class="subsectionHeader">Overall Hiscores</div>
            <table class="table_back">
              <thead>
                <tr>
                  <th class="rankHead">Rank</th>
                  <th class="nameHead">Name</th>
                  <th class="levelHead">Level</th>
                  <th class="xpHead">XP</th>
                </tr>
              </thead>
              <tbody id="hiscores_table">
                <tr class="row row1">
                  <td class="rankCol">1</td>
                  <td class="alL"><a href="#">Einz</a></td>
                  <td class="alL">2376</td>
                  <td class="alL">1.377.817.421</td>
                </tr>
                <!-- more rows... -->
              </tbody>
            </table>
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
