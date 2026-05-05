<?php include 'includes/header.php'; 
require 'includes/database.php';

if (isset($_SESSION['user'])) {
    echo "Vítej, " . htmlspecialchars($_SESSION['user']) . " (" . $_SESSION['role'] . ") | <a href='logout.php'>Odhlásit se</a><hr>";
    echo "<a href='add_post.php'>Přidat příspěvek</a><br>";
    if ($_SESSION['role'] === 'admin') {
        echo "<a href='admin_users.php'>Správa uživatelů</a><br>";
    }
    echo "<hr><h3>Veřejné příspěvky</h3>";

    if ($_SESSION['role'] === 'admin') {
        $stmt = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
        $posts = $stmt->fetchAll();
    } elseif ($_SESSION['role'] === 'redaktor') {
        $stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE user_id = ? ORDER BY posts.created_at DESC");
        $stmt->execute([$_SESSION['user_id']]);
        $posts = $stmt->fetchAll();
    } else {
        $posts = [];
    }

    foreach ($posts as $post) {
        echo "<div style='border:1px solid #ccc; margin:10px 0; padding:10px;'>";
        echo "<strong>" . htmlspecialchars($post['title']) . "</strong> <em>({$post['username']})</em><br>";
        echo nl2br(htmlspecialchars($post['content']));
        echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Organizace spojených národů</title>
  <link rel="stylesheet" href="assets/css/style.css?v=2">
  <link rel="stylesheet" href="assets/css/style2.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<style>
.hidden {
      display: none !important;
    }
.navbar {
  background-color: #0056b3;
  padding: 10px;
}
.nav-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 10px 15px;
  font-size: 18px;
  cursor: pointer;
  margin-bottom: 10px;
  border-radius: 4px;
  display: none;
}
.nav-container {
  flex-direction: column;
  gap: 10px;
}
.nav-link {
  color: white;
  text-decoration: none;
  padding: 8px 12px;
  border-radius: 4px;
  transition: background 0.3s;
}

.nav-link:hover {
  background-color: #0062cc;
}


.hidden {
  display: none;
}


@media (max-width: 768px) {
  .nav-button {
    display: block;
  }

  .nav-container {
    display: none;
  }

  .nav-container:not(.hidden) {
    display: flex;
  }
}


@media (min-width: 769px) {
  .nav-button {
    display: none;
  }

  .nav-container {
    display: flex !important;
    flex-direction: row;
    gap: 15px;
  }
}
</style>

</head>
<body>
  <nav class="navbar">
    <button class="nav-button" onclick="toggleMenu()">☰ Menu</button>
    <div class="nav-container hidden">
    <a href="#about" class="nav-link">O OSN</a>
    <a href="#timeline" class="nav-link">Časová osa</a>
    <a href="#historie" class="nav-link">Historie</a>
    <a href="#clenove" class="nav-link">Členové</a>
    <a href="#social" class="nav-link">Kontakt</a>
  </div>
</nav>

  <?php if (!isset($_SESSION['user'])): ?>
  <div style="text-align: center; padding: 15px; background-color: #f8f9fa;">
      <a href="login.php" style="display: inline-block; padding: 10px 20px; text-decoration: none; background-color: #0056b3; color: white; border-radius: 5px; font-weight: bold; margin-right: 10px;">Přihlásit se</a>
      <a href="register.php" style="display: inline-block; padding: 10px 20px; text-decoration: none; background-color: #28a745; color: white; border-radius: 5px; font-weight: bold;">Zaregistrovat se</a>
  </div>
  <?php endif; ?>

  <header class="hero">
    <div class="hero-content">
      <h1 class="title">Organizace spojených národů</h1>
      <p class="subtitle">Podpora míru, bezpečnosti a spolupráce ve světě</p>
      <a href="#about" class="cta-button">Více informací</a>
    </div>
  </header>

  <main>

    <section id="about" class="card blue-section">
      <div class="section-content">
        <h2>Co je OSN?</h2>
         <div class="about-grid"> 
          <div class="about-item">
            <i class="fas fa-globe icon-large"></i>
            
            <p>Organizace spojených národů (OSN) je mezinárodní organizace, která vznikla po druhé světové válce dne 24. října 1945. Jejím hlavním cílem je udržování mezinárodního míru a bezpečnosti, ochrana lidských práv, zajištění rozvoje a spolupráce mezi státy.</p>
          </div>
          
          <div class="about-item">
            <h3>Hlavní úkoly OSN:</h3>
            <ul class="styled-list">
              <li>Zabránit válkám a konfliktům</li>
              <li> Pomáhat při humanitárních krizích</li>
              <li> Podporovat vzdělání, zdravotnictví a rovnost</li>
              <li> Bojovat proti chudobě a klimatickým změnám</li>
            </ul>
          </div>
          
          <div class="about-item">
            <h3>Sídlo OSN:</h3>
            <p>Hlavní sídlo OSN se nachází v New Yorku (USA). Další důležitá střediska jsou v Ženevě (Švýcarsko), Vídni (Rakousko) a Nairobi (Keňa).</p>
          </div>
          
          <div class="about-item">
            <h3>Členové OSN:</h3>
            <p>OSN má dnes 193 členských států. Každý stát má jedno hlasovací právo v Valném shromáždění OSN, které je hlavním rozhodovacím orgánem.</p>
          </div>
          
          <div class="about-item">
            <h3>Zajímavosti:</h3>
            <ul class="styled-list">
              <li></i> Mezi zakládající členy OSN patří i Československo (nyní Česká republika a Slovensko).</li>
              <li> OSN má šest hlavních orgánů, včetně Rady bezpečnosti, Valného shromáždění, Mezinárodního soudního dvora a dalších.</li>
              <li> OSN také provozuje různé agentury, jako je UNESCO, UNICEF nebo WHO (Světová zdravotnická organizace).</li>
            </ul>
          </div>
        </div>
      </div>
    </section> 

    <section id="timeline" class="timeline-section">
      <div class="section-content">
        <h2 class="animated-text">Klíčové momenty OSN</h2>
        <p class="section-intro">Prohlédněte si důležité milníky v historii Organizace spojených národů:</p>
        
        <div class="timeline-container">
          <div class="timeline-line"></div>
          
          <div class="timeline-event" onclick="showEventDetails('1945')">
            <div class="event-date">1945</div>
            <div class="event-content">
              <h3>Založení OSN</h3>
              <p>26. června 1945 byla podepsána Charta OSN v San Franciscu. Organizace oficiálně vznikla 24. října 1945.</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('1948')">
            <div class="event-date">1948</div>
            <div class="event-content">
              <h3>Deklarace lidských práv</h3>
              <p>10. prosince 1948 Valné shromáždění OSN přijalo Všeobecnou deklaraci lidských práv.</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('1960')">
            <div class="event-date">1960</div>
            <div class="event-content">
              <h3>Deklarace o dekolonizaci</h3>
              <p>OSN přijala Deklaraci o udělení nezávislosti koloniálním zemím a národům.</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('1971')">
            <div class="event-date">1971</div>
            <div class="event-content">
              <h3>Čína v Radě bezpečnosti</h3>
              <p>Čínská lidová republika nahradila Tchaj-wan jako stálý člen Rady bezpečnosti OSN.</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('1992')">
            <div class="event-date">1992</div>
            <div class="event-content">
              <h3>Konference o životním prostředí</h3>
              <p>V Rio de Janeiru se konala Konference OSN o životním prostředí a rozvoji (UNCED).</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('2000')">
            <div class="event-date">2000</div>
            <div class="event-content">
              <h3>Rozvojové cíle tisíciletí</h3>
              <p>OSN stanovila 8 Rozvojových cílů tisíciletí na summitu v New Yorku.</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('2015')">
            <div class="event-date">2015</div>
            <div class="event-content">
              <h3>Cíle udržitelného rozvoje</h3>
              <p>OSN přijala 17 Cílů udržitelného rozvoje (SDGs) na období 2015-2030.</p>
            </div>
          </div>
          
          <div class="timeline-event" onclick="showEventDetails('2020')">
            <div class="event-date">2020</div>
            <div class="event-content">
              <h3>Pandemie COVID-19</h3>
              <p>OSN koordinovala globální reakci na pandemii COVID-19 prostřednictvím WHO.</p>
            </div>
          </div>
        </div>
        
        <div id="event-details" class="event-details-modal">
          <div class="modal-content">
            <span class="close-modal" onclick="closeEventDetails()">&times;</span>
            <h2 id="event-title">Detail události</h2>
            <div id="event-full-description">Načítání informací...</div>
          </div>
        </div>
      </div>
    </section>

    
    <section id="historie" class="blue-section">
      <div class="section-content">
        <h2>Historie OSN</h2>
        <div class="history-grid">
          <div class="history-card">
            <h3>Předchůdci OSN</h3>
            <p>Myšlenka mezinárodní organizace pro udržení míru vznikla již v 19. století. Předchůdcem OSN byla Společnost národů, založená v roce 1919 po první světové válce, která však nedokázala zabránit vypuknutí druhé světové války.</p>
          </div>
          
          <div class="history-card">
            <h3>Založení OSN</h3>
            <p>OSN byla založena 24. října 1945, kdy její Chartu ratifikovalo 51 zakládajících členů. Hlavními iniciátory byly vítězné mocnosti druhé světové války - USA, SSSR, Velká Británie, Francie a Čína.</p>
          </div>
          
          <div class="history-card">
            <h3>Studená válka</h3>
            <p>Během studené války byla činnost OSN často paralyzována veta v Radě bezpečnosti. Přesto organizace sehrála důležitou roli v dekolonizaci a řešení některých regionálních konfliktů.</p>
          </div>
          
          <div class="history-card">
            <h3>Po studené válce</h3>
            <p>Po roce 1991 OSN výrazně rozšířila své mírové operace a humanitární aktivity. Počet členských států vzrostl z původních 51 na současných 193.</p>
          </div>
          
          <div class="history-card">
            <h3>21. století</h3>
            <p>V novém tisíciletí se OSN zaměřuje na globální výzvy jako klimatické změny, udržitelný rozvoj, terorismus a pandemie. Organizace však čelí kritice za byrokratičnost a nedostatečnou efektivitu.</p>
          </div>
        </div>
      </div>
    </section>
    
   
    <section id="clenove" class="members-section">
      <div class="section-content">
        <h2>Členské státy OSN</h2>
        <p class="section-intro">OSN má v současnosti 193 členských států. Zde je přehled některých významných členů:</p>
        
        <div class="members-grid">
          <div class="member-card" onclick="showCountryInfo('Francie')">
            <div class="member-flag france">
            <img src="assets/images/francie.jpg" alt="Vlajka Francie" />
            </div>
            <h3>Francie</h3>
            <p>Člen Rady bezpečnosti, zakládající stát OSN. Aktivní v mírových misích a klimatických iniciativách.</p>
          </div>
         
          <div class="member-card" onclick="showCountryInfo('Rusko')">
            <div class="member-flag russia">
            <img src="assets/images/rusko.jpg" alt="Vlajka Ruska" />
            </div>
            <h3>Rusko</h3>
            <p>Jako nástupce SSSR je stálým členem Rady bezpečnosti. Často využívá právo veta.</p>
          </div>
 
          <div class="member-card" onclick="showCountryInfo('Německo')">
            <div class="member-flag germany">
            <img src="assets/images/nemecko.jpg" alt="Vlajka Německa" />
            </div>
            <h3>Německo</h3>
            <p>Připojilo se v roce 1973. Čtvrtý největší přispěvatel do rozpočtu OSN.</p>
          </div>
         
          <div class="member-card" onclick="showCountryInfo('Česká republika')">
            <div class="member-flag czech">
            <img src="assets/images/cesko.webp" alt="Vlajka České Republiky" />
            </div>
            <h3>Česká republika</h3>
            <p>Člen OSN od roku 1993 po rozdělení Československa. Aktivní ve Východní Evropě.</p>
          </div>

    </section>
  <section>
          <div id="country-info" class="country-info-box">
            <div class="info-header">
              <h2 id="country-name">Vyber stát ze seznamu </h2>
              <div id="country-flag" class="country-flag"></div>
            </div>
            <p id="country-description">Zobrazí se ti informace o vybraném členském státě OSN.</p>
            <div id="country-details" class="country-details"></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  
  <footer id="social" class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h3>Organizace spojených národů</h3>
        <p>Mezinárodní organizace pro udržení míru a bezpečnosti ve světě.</p>
      </div>
      
      <div class="footer-section">
        <h3>Kontakt</h3>
        <p><i class="fas fa-map-marker-alt"></i>Klatovy</p>
        <p><i class="fas fa-phone"></i> +380 97 019 18 19</p>
        <p><i class="fas fa-envelope"></i>alexgolovanov07@gmail.com</p>
      </div>
      
      <div class="footer-section">
        <h3>Sledujte nás</h3>
        <div class="social-icons">
          <a href="https://www.facebook.com/UN/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
          <a href="https://twitter.com/UN" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="https://www.instagram.com/unitednations/" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="https://www.youtube.com/unitednations" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          <a href="https://www.linkedin.com/company/united-nations" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
    </div>
    
    <div class="footer-bottom">
      <p>&copy; 2025 Organizace spojených národů. Holovanov Oleksandr</p>
    </div>
  </footer>


<script>
function showCountryInfo(country) {
  const countryName = document.getElementById("country-name");
  const countryDescription = document.getElementById("country-description");
  const countryDetails = document.getElementById("country-details");
  const countryFlag = document.getElementById("country-flag");

  countryName.textContent = country;
  countryFlag.className = "country-flag flag-" + country.toLowerCase().replace(/\s/g, "-");

  let description = "";
  let details = "";

  switch(country) {
    case "Francie":
      description = "Francie je zakládajícím členem OSN a stálým členem Rady bezpečnosti.";
      details = `
        <div class="detail-item">
          <h4><i class="fas fa-info-circle"></i> Základní informace</h4>
          <p><strong>Členství v OSN:</strong> Zakládající člen (1945)</p>
          <p><strong>Status v RB:</strong> Stálý člen s právem veta</p>
          <p><strong>Příspěvek do rozpočtu:</strong> 5,61% (2023)</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-star"></i> Zapojení v OSN</h4>
          <p>Francie hraje klíčovou roli v mírových operacích OSN, zejména v Africe. Je aktivní v boji proti klimatickým změnám a podpoře lidských práv.</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-landmark"></i> Zajímavosti</h4>
          <p>Francouzština je jedním ze šesti úředních jazyků OSN. Paříž hostila podpis Charty UNESCO v roce 1945.</p>
        </div>
      `;
      break;

    case "Německo":
      description = "Německo se připojilo k OSN v roce 1973 a je důležitým dárcem.";
      details = `
        <div class="detail-item">
          <h4><i class="fas fa-info-circle"></i> Základní informace</h4>
          <p><strong>Členství v OSN:</strong> Od 18. září 1973</p>
          <p><strong>Status v RB:</strong> Nestálý člen (2023–2024)</p>
          <p><strong>Příspěvek do rozpočtu:</strong> 6,09% (2023)</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-star"></i> Zapojení v OSN</h4>
          <p>Německo je čtvrtým největším přispěvatelem do rozpočtu OSN. Aktivně se podílí na mírových misích a humanitární pomoci.</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-landmark"></i> Zajímavosti</h4>
          <p>Bonn je sídlem 25 organizací OSN, včetně Sekretariátu Rámcové úmluvy OSN o změně klimatu.</p>
        </div>
      `;
      break;

    case "Česká republika":
      description = "Česká republika je členem OSN od roku 1993 a podporuje mezinárodní spolupráci.";
      details = `
        <div class="detail-item">
          <h4><i class="fas fa-info-circle"></i> Základní informace</h4>
          <p><strong>Členství v OSN:</strong> Od 19. ledna 1993</p>
          <p><strong>Status v RB:</strong> Nestálý člen (1994–1995)</p>
          <p><strong>Příspěvek do rozpočtu:</strong> 0,47% (2023)</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-star"></i> Zapojení v OSN</h4>
          <p>Česká republika se aktivně účastní mírových operací OSN, humanitárních a rozvojových programů.</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-landmark"></i> Zajímavosti</h4>
          <p>V roce 2015 Česká republika předsedala Ekonomickému a sociálnímu výboru OSN (ECOSOC).</p>
        </div>
      `;
      break;

    case "Rusko":
      description = "Rusko je nástupnickým státem SSSR a stálým členem Rady bezpečnosti OSN.";
      details = `
        <div class="detail-item">
          <h4><i class="fas fa-info-circle"></i> Základní informace</h4>
          <p><strong>Členství v OSN:</strong> Od 1945 jako SSSR, od 1991 jako Ruská federace</p>
          <p><strong>Status v RB:</strong> Stálý člen s právem veta</p>
          <p><strong>Příspěvek do rozpočtu:</strong> 2,40% (2023)</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-star"></i> Zapojení v OSN</h4>
          <p>Rusko se účastní mírových misí a diplomatických jednání v rámci OSN, ale jeho role je v posledních letech kontroverzní.</p>
        </div>
        <div class="detail-item">
          <h4><i class="fas fa-landmark"></i> Zajímavosti</h4>
          <p>Ruština je jedním z oficiálních jazyků OSN. Rusko pravidelně využívá své právo veta v Radě bezpečnosti.</p>
        </div>
      `;
      break;

    default:
      description = "Vyberte stát kliknutím na mapu.";
      details = "";
  }

  countryDescription.textContent = description;
  countryDetails.innerHTML = details;
}
</script>
<script>
    function toggleMenu() {
      const nav = document.querySelector('.nav-container');
      nav.classList.toggle('hidden');
    }
  </script>
</body>
</html>

