<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="nl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Language" content="nl">
  <meta charset="UTF-8" />
  <title>Legacy - Exorth RSPS - Highscores</title>
  <style type="text/css">@import url(css/global.css);</style>
  <style type="text/css">@import url(css/home.css);</style>
  <style>
    /* -- Hiscores Layout Styles -- */
    /* Flex container for skills & table */
    #hiscores_section {
      display: flex;
      gap: 12px;
      align-items: flex-start;
      margin-top: 12px;
    }
    /* Skills menu box */
    #skillsList_back {
      background: #4d3b18;
      border: 1px solid #5e4a25;
      border-radius: 3px;
      overflow: hidden;
      flex: 0 0 180px;
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
    #skillsList { margin: 0; padding: 0; }
    #skillsList ul { list-style: none; margin: 0; padding: 0; }
    #skillsList li {
      position: relative;
      padding: 8px;
      background: #43381f;
      border-bottom: 1px solid #5e4a25;
      cursor: pointer;
      text-align: center;
      transition: background 0.2s;
    }
    #skillsList li:last-child { border-bottom: none; }
    #skillsList li.selected { background: #ffd65a; }
    #skillsList li.selected a { color: #3b2a0f; font-weight: bold; }
    #skillsList li:hover { background: #5e4a25; }
    #skillsList li .ico {
      position: absolute;
      left: 8px;
      top: 50%;
      width: 20px;
      height: 20px;
      background-size: contain;
      background-repeat: no-repeat;
      transform: translateY(-50%);
    }
    #skillsList li a {
      display: inline-block;
      width: 100%;
      color: #e1d3a4;
      text-decoration: none;
      font-size: 13px;
      z-index: 1;
    }
    /* Hiscores table box */
    #playerList_back {
      background: #4d3b18;
      border: 1px solid #5e4a25;
      border-radius: 3px;
      flex: 1;
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
    .table_back {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
    }
    .table_back thead th {
      background: #5e4a25;
      color: #ffd65a;
      font-weight: bold;
      padding: 6px 12px;
      border-bottom: 2px solid #5e4a25;
      text-align: left;
    }
    .table_back tbody tr:nth-child(odd) td { background: #43381f; }
    .table_back tbody tr:nth-child(even) td { background: #3c3120; }
    .table_back tbody td {
      padding: 6px 12px;
      color: #e1d3a4;
      border-bottom: 1px solid #5e4a25;
      text-align: left;
    }
    .table_back tbody td.alL { text-align: left; }
    .table_back tbody tr:hover td { background: #6f562e; color: #ffffff; }
    .table_back tbody a { color: #ffd65a; text-decoration: none; }
    .table_back tbody a:hover { text-decoration: underline; }
  </style>
</head>
<body id="navhome">
  <div id="scroll">
    <div id="head">
      <div id="headOrangeTop"></div>
      <img src="img/banner.jpg" alt="Exorth">
      <div id="headImage"><a href="index.php" id="logo_select"></a></div>
      <div id="headOrangeBottom"></div>
      <div id="menubox"><?php include 'menu.php'; ?><br class="clear"></div>
    </div>
    <div id="content">
    <div id="recentnews"> 
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
       <div class="sectionBody first"> 
        <div class="News"> 
      <div id="hiscores_section"> <!-- Start Scores !-->
        <!-- Skills menu -->
        <div id="skillsList_back" class="brown_box">
          <div class="subsectionHeader">Skills</div>
          <div id="skillsList"><ul>
            <li class="selected" data-mode="overall">
              <span class="ico" style="background-image:url('img/icons/skill_overall.gif')"></span>
              <a href="#">Overall</a>
            </li>
            <li data-mode="skiller">
              <span class="ico" style="background-image:url('img/icons/skill_overall.gif')"></span>
              <a href="#">Skiller Overall</a>
            </li>
            <li data-mode="skill" data-skill="0">
              <span class="ico" style="background-image:url('img/icons/skill_attack.gif')"></span>
              <a href="#">Attack</a>
            </li>
            <li data-mode="skill" data-skill="1">
              <span class="ico" style="background-image:url('img/icons/skill_defence.gif')"></span>
              <a href="#">Defence</a>
            </li>
            <li data-mode="skill" data-skill="2">
              <span class="ico" style="background-image:url('img/icons/skill_strength.gif')"></span>
              <a href="#">Strength</a>
            </li>
            <li data-mode="skill" data-skill="3">
              <span class="ico" style="background-image:url('img/icons/skill_hitpoints.gif')"></span>
              <a href="#">Hitpoints</a>
            </li>
            <li data-mode="skill" data-skill="4">
              <span class="ico" style="background-image:url('img/icons/skill_ranged.gif')"></span>
              <a href="#">Ranged</a>
            </li>
            <li data-mode="skill" data-skill="5">
              <span class="ico" style="background-image:url('img/icons/skill_prayer.gif')"></span>
              <a href="#">Prayer</a>
            </li>
            <li data-mode="skill" data-skill="6">
              <span class="ico" style="background-image:url('img/icons/skill_magic.gif')"></span>
              <a href="#">Magic</a>
            </li>
            <li data-mode="skill" data-skill="7">
              <span class="ico" style="background-image:url('img/icons/skill_cooking.gif')"></span>
              <a href="#">Cooking</a>
            </li>
            <li data-mode="skill" data-skill="8">
              <span class="ico" style="background-image:url('img/icons/skill_woodcutting.gif')"></span>
              <a href="#">Woodcutting</a>
            </li>
            <li data-mode="skill" data-skill="9">
              <span class="ico" style="background-image:url('img/icons/skill_fletching.gif')"></span>
              <a href="#">Fletching</a>
            </li>
            <li data-mode="skill" data-skill="10">
              <span class="ico" style="background-image:url('img/icons/skill_fishing.gif')"></span>
              <a href="#">Fishing</a>
            </li>
            <li data-mode="skill" data-skill="11">
              <span class="ico" style="background-image:url('img/icons/skill_firemaking.gif')"></span>
              <a href="#">Firemaking</a>
            </li>
            <li data-mode="skill" data-skill="12">
              <span class="ico" style="background-image:url('img/icons/skill_crafting.gif')"></span>
              <a href="#">Crafting</a>
            </li>
            <li data-mode="skill" data-skill="13">
              <span class="ico" style="background-image:url('img/icons/skill_smithing.gif')"></span>
              <a href="#">Smithing</a>
            </li>
            <li data-mode="skill" data-skill="14">
              <span class="ico" style="background-image:url('img/icons/skill_mining.gif')"></span>
              <a href="#">Mining</a>
            </li>
            <li data-mode="skill" data-skill="15">
              <span class="ico" style="background-image:url('img/icons/skill_herblore.gif')"></span>
              <a href="#">Herblore</a>
            </li>
            <li data-mode="skill" data-skill="16">
              <span class="ico" style="background-image:url('img/icons/skill_agility.gif')"></span>
              <a href="#">Agility</a>
            </li>
            <li data-mode="skill" data-skill="17">
              <span class="ico" style="background-image:url('img/icons/skill_thieving.gif')"></span>
              <a href="#">Thieving</a>
            </li>
            <li data-mode="skill" data-skill="18">
              <span class="ico" style="background-image:url('img/icons/skill_slayer.gif')"></span>
              <a href="#">Slayer</a>
            </li>
            <!-- <li data-mode="skill" data-skill="19">
              <span class="ico" style="background-image:url('img/icons/skill_farming.gif')"></span>
              <a href="#">Farming</a>
            </li> -->
            <li data-mode="skill" data-skill="20">
              <span class="ico" style="background-image:url('img/icons/skill_runecraft.gif')"></span>
              <a href="#">Runecraft</a>
            </li>
            <!-- <li data-mode="skill" data-skill="21">
              <span class="ico" style="background-image:url('img/icons/skill_hunter.gif')"></span>
              <a href="#">Hunter</a>
            </li>
            <li data-mode="skill" data-skill="22">
              <span class="ico" style="background-image:url('img/icons/skill_construction.gif')"></span>
              <a href="#">Construction</a>
            </li> -->
          </ul></div>
        </div>
        <!-- Hiscores table -->
        <div id="playerList_back" class="brown_box">
          <div class="subsectionHeader" id="table-title">Overall Hiscores</div>
          <table class="table_back">
            <thead>
              <tr><th>Rank</th><th>Name</th><th>Combat Lvl</th><th>Level</th><th>XP</th></tr>
            </thead>
            <tbody id="hs-body"><tr><td colspan="5" style="text-align:center;">Loading…</td></tr></tbody>
          </table>
        </div>
      </div>
    </div> <!-- End scores !-->
    <div class="section"> 
       <div class="sectionBody first"> 
        <div class="News"> 
         <p>
            * We only load the 200 best of each overvieuw!
         </p> 
        </div> 
       </div>  
      </div> 
  </div></div></div></div>
  
    <div id="footer"><div class="contain"><div class="footerdesc"></div></div></div>
  </div>
  <script>
    const fmt = new Intl.NumberFormat('nl-NL',{minimumFractionDigits:0,maximumFractionDigits:0});
    const skills = ['Attack','Defence','Strength','Hitpoints','Ranged','Prayer','Magic','Cooking','Woodcutting','Fletching','Fishing','Firemaking','Crafting','Smithing','Mining','Herblore','Agility','Thieving','Slayer','Farming','Runecraft','Hunter','Construction','Summoning'];
    document.querySelectorAll('#skillsList li').forEach(li=> li.addEventListener('click',()=>{
      document.querySelectorAll('#skillsList li').forEach(i=>i.classList.remove('selected'));
      li.classList.add('selected');
      const mode = li.dataset.mode;
      const skill = li.dataset.skill;
      const titleText = mode==='overall'? 'Overall Hiscores'
                        :mode==='skiller'? 'Skiller Overall Hiscores'
                        : skills[skill] + ' Hiscores';
      document.getElementById('table-title').textContent = titleText;
      loadHighscores(mode, skill);
    }));
    async function loadHighscores(mode='overall', skill=null) {
      const tbody = document.getElementById('hs-body');
      tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;">Loading…</td></tr>';
      let url = 'https://exorth.bulbasaur.nl/highscores?limit=200';
      if(mode==='skill') url = `https://exorth.bulbasaur.nl/highscores/skill/${skill}?limit=200`;
      const res = await fetch(url), json = await res.json();
      let data = json.highscores.filter(e=>e.privilege<2);
      if(mode==='skiller') data = data.filter(e=>e.combatLvl===3);
      if(!data.length) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;">No results</td></tr>';
        return;
      }
      tbody.innerHTML = '';
      data.forEach((e,i)=>{
        const xp = e.totalXp ?? e.xp;
        tbody.insertAdjacentHTML('beforeend',
          //`<tr><td>${i+1}</td><td class="alL"><a href="player.html?name=${e.username}">${e.username}</a></td><td class="alL">${e.combatLvl}</td><td class="alL">${e.lvl}</td><td class="alL">${fmt.format(xp)}</td></tr>`
           `<tr><td>${i+1}</td><td class="alL">${e.username}</td><td class="alL">${e.combatLvl}</td><td class="alL">${e.lvl}</td><td class="alL">${fmt.format(xp)}</td></tr>`
        );
      });
    }
    window.addEventListener('DOMContentLoaded', ()=> loadHighscores('overall', null));
  </script>
</body>
</html>
