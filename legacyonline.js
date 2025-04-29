// Vervang door je eigen domein+poort
const SSE_URL = 'https://exorth.bulbasaur.nl/players/stream';

const countEl   = document.getElementById('count');
const playersEl = document.getElementById('players');

const evtSource = new EventSource(SSE_URL);

evtSource.onmessage = e => {
  const data = JSON.parse(e.data);
  countEl.textContent = data.count;
  playersEl.innerHTML = data.players
    .map(p => `<li>${p.username} (lvl ${p.combatLvl})</li>`)
    .join('');
};

evtSource.onerror = () => {
  countEl.textContent = 'connection lost';
};
