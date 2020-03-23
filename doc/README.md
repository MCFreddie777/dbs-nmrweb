# Správa chemických vzoriek laboratória

__Škola__: Slovenská Technická Univerzita v Bratislave<br/>
__Fakulta__: Fakulta informatiky a informačných technológií<br/>
__Predmet__: Databázové systémy<br/>
__Študenti__: Bc. František Gič, Ján Šouc<br/>
__Cvičiaci__: Ing. Samuel Pecár<br/>

## Špecifikácia
<p>
Systém vytvorený pre centrálne laboratória (FCHPT STU) na zjednodušenie práce s chemickými vzorkami.
Momentálne laboratórium funguje na princípy, že zákazník (študent, prednášajúci, cvičiaci) prinesie do laboratória vzorku, ktorú spolu s reportom odovzdá laborantovi.
V reporte je uvedené, čo je daná vzorka zač, v akom rozpúšťadle je rozpustená, meno zákazníka, či je daný zákazník samoplatca alebo sa diagnostika prepláca z nejakého grantu, množstvo atď.
Následne laborant prilepí na skúmavku jej číslo, a pokiaľ potrebuje vyhľadať informácie o danej vzorke, musí si prečítať daný report.

Náš systém zjednodušuje prácu ako laborantovi, tak i zákazníkovi.
Zákazník má možnosť sa do systému prihlásiť (registrácia je uzatvorená administrátorom), vytvoriť novú vzorku, vidieť zoznam svojich odovzdaných vzoriek, ako aj ich stav (či boli analyzované alebo nie).
Laborant ľahko vyhľadá detaily a informácie o vzorke podľa čísla na skúmavke, ktoré je vygenerované po vytvorení vzorky zákazníkom.

Celá špecifikácia je dostupná na [Wiki projektu](https://github.com/FIIT-DBS2020/project-gic_souc/wiki)
</p>

## Implementácia

<p>

Projekt je napípsaný ako webová aplikácia.<br/>
Backend je napísaný v PHP Frameworku [Laravel 7](https://laravel.com)<br/>
Frontend bol pôvodne robený v JavaScript Frameworku [Vue.js](https://vuejs.org) ale z časového deficitu sme premigrovali na MPA verziu aplikácie.<br/>
Na FE používame taktiež CSS Framework [TailwindCSS](https://tailwindcss.com/)
a font ikoniek [Font Awesome 5](https://fontawesome.com/).<br/>
K administrácií chemických vzoriek používame [knižnicu JSME](https://peter-ertl.com/jsme/) od Peter Ertl a Bruno Bienfait.

</p>

## Inštalácia
__Požiadavky__:
- PHP 7+
- Node.js & NPM - Na build frontend častí (transpilácia SASS do CSS)
- MySQL 5.7
- Composer - PHP dependency manager

```bash
git clone https://github.com/FIIT-DBS2020/project-gic_souc/
cd project-gic_souc/src
composer install
npm install
```

Po nahodení databázy a importovaní dát dostupných v `db/db_dump.sql` spustiť server pomocou:

```bash
php artisan serve
```

<div style="page-break-after: always;"></div>

## Databázová štruktúra
### Entity

#### User
User - je entita používateľa. Je to používateľ pridaný administrátorom do databázy.
Toto heslo od administrátora si môže dodatočne zmeniť.

#### Rola
V aplikácií rozoznávame medzi 4 druhmi rolí

- __používateľ__
    - používateľ je bežný zákazník (prednášajúci, študent, cvičiaci) na fakulte
    - má možnosť vytvárať nové vzorky
    - meniť si heslo
    - vylistovať si svoje vzorky

- __garant__
    - garant je druh používateľa ktorý je zodpovedný za určitý grant
    - administrátor jednorázovo priradí grant
    - následne má garant možnosť vidieť všetky vzorky vytvorené s týmto grantom

- __laborant__
    - je zamestanec laboratória
    - dokáže vylistovať všetky vzorky v databáze, nezávisiac od toho komu patria
    - spracováva vzorky, vzorky bez laboranta si má možnosť priraďiť ak na nich pracuje
    - označuje vzorky ako spracované

- __administrátor__
    - vytvára používateľské kontá
    - upravuje vzorky, môže ich vymazať
    - môže vymazávať používateľov

#### Grant
Grant je druh fundovania daných vyhodnocovaní vzoriek. Pokiaľ vzorka nemá zvolený grant,
pre laboranta to znamená že od zákazníka pri prevzatí výsledkov musí zinkasovať sumu.
Pokiaľ idú peniaze z grantu, rieši sa to reportom na konci časového obdobia mimo systému.

#### Lab
Lab je entita laboratórneho úkonu. Drží informácie o stave spracovania vzorky,
priradeného laboranta, a kedy boli vytvorené zmeny (zmena stavu alebo laboranta).

#### Solvent
Solvent je rozpúštadlo v ktorom je daná vzorka. Rozpúštadla sú dané fixne administrátorom.
Pokiaľ je rozpúšťadlo špeciálne, daná relácia je označená ako `NULL` a rozpúštadlo musí byť vyplnené v poznámke.


<div style="page-break-inside: avoid;">

#### Spectrometer
Spectrometer sú zariadenia v laboratóriu. V databáze sú upravované manuálne, pretože vybavenie laboratória sa nemení prakticky nikdy, s výnimkami.
Majú daný typ a názov. Každá vzorka je vyhodnocovaná určitým spektrometrom, ktorý si užívateľ navolí.

</div>

#### Sample
Najdôležitejšia entita celej aplikácie. Vzorka je vytvorená v systéme a následne odovzdaná do laboratória.
Drží informácie o sebe ako názov (vybraný používateľom), množstvo (v ml), chemickú štruktúru,
informáciu o tom či ju majú z laboratória vrátiť alebo po analýze zahodiť, nejakú voliteľnú poznámku a časové údaje.
Vzorka môže byť taktiež platená z nejakého grantu, má priradeného laboranta, musí mať vybraté rozpúšťadlo a spektrometer.

<div style="page-break-after: always;"></div>

### Logický dátový model
Logický dátový model sme navrhovali použitím nástroja [draw.io](https://app.diagrams.net/).
![Logical model](img/logical_model.png)

<div style="page-break-after: always;"></div>

### Fyzický dátový model
Fyzický dátový model sme navrhovali použitím nástroja [dbdiagram.io](https://dbdiagram.io/home).
![Physical model](img/physical_model.png)

<div style="page-break-after: always;"></div>

## Scenáre

#### Autentifikácia

- __Milestone:__  [1. Odovzdanie](https://github.com/FIIT-DBS2020/project-gic_souc/milestone/1)
- __Issues:__
    - [#6 Make login great again](https://github.com/FIIT-DBS2020/project-gic_souc/issues/6)

<p>
Používateľovi je v tomto scenári umožnené prihásiť sa do
aplikácie pomocou vopred administrátorom vygenerovaného loginu a hesla.
Aplikácia si pamätá reláciu prihlásenia až do odhlásenia.
<br/> V rámci scenára je potreba prekopať Laravelovský login na custom riešenie.

_Debug credentials:_<br/>
__login:__ admin@admin.sk<br/>
__supertajné heslo:__ Nbusr123
</p>

#### Zmena hesla

- __Milestone:__  [1. Odovzdanie](https://github.com/FIIT-DBS2020/project-gic_souc/milestone/1)
- __Issues:__
    - [#4 Implementovanie prvého scenáru](https://github.com/FIIT-DBS2020/project-gic_souc/issues/4)

<p>
Používateľovi je taktiež umožnené dané heslo zmeniť zadaním aktuálneho hesla a nového hesla + potvrdenie.
Heslo sa samozrejme musí zhodovať s aktuálnym. Základná validácia. Používateľ je po akcií informovaný o výsledku pomocou notifikácií.
</p>

#### Vytvorenie novej vzorky

- __Milestone:__  [1. Odovzdanie](https://github.com/FIIT-DBS2020/project-gic_souc/milestone/1)
- __Issues:__
    - [#4 Implementovanie prvého scenáru](https://github.com/FIIT-DBS2020/project-gic_souc/issues/4)

<p>
Po kliknutí na tlačidlo nového záznamu v zozname všetkých vzoriek sa
sa používateľovi zobrazí formulár na vytvorenie novej vzorky.

Formulár používa [JSME Applet](https://peter-ertl.com/jsme/) na zjednodušenie reprezentácie chemickej štruktúry.
Používateľ je schopný vybrať si zo zoznamu grantov, rozpúštadiel a spektrometrov a uložiť svoju akciu.
Po uložení je notifikovaný o statuse uloženia daného záznamu (či bolo úspešné alebo nie) a následne môže vidieť svoj záznam ako posledný v zozname vzoriek.
</p>

#### List vzoriek

- __Milestone:__  TBA
- __Issues:__
	- Search
	- Pagination

<p>
Laborant je schopný vylistovať vzorky všetky vzorky laboratória,
zatiaľ čo používateľ listuje iba jeho vzorky.
Garanti vidia svoje vzorky a vzorky spadajúce pod ich granty.


</p>

#### Detail vzorky

- __Milestone:__  TBA
- __Issues:__ TBA

<p>
Všetky typy užívateľov majú možnosť vidieť detaily vzorky po vybratí zo zoznamu.
</p>

<div style="page-break-inside: avoid;">

#### Vytvorenie používateľa

- __Milestone:__  TBA
- __Issues:__ TBA

<p>
Administrátor v sekcií správa užívateľov
dokáže vytvoriť nové užívateľské konto alebo existujúce konto editovať (login alebo zmeniť heslo v prípade zabudnutia)
Dôvod prečo toto robíme je, že aplikácia funguje na intranete a je uzavretá - registrácia nie je možná.
</p>

</div>

#### Prezvatie vzorky a rozbor

- __Milestone:__  TBA
- __Issues:__ TBA

<p>
Laborant prevezme vzorku ktorá ešte nemá laboranta, označí ju ako rozpracovanú - že na nej pracuje.
Updatne sa čas modifikácie a o tomto stave je obozrejmený aj užívateľ.
Po dokončení laborant označí vzorku (labák) ako dokončený.<br/>

__Poznámka: Možno zoznam všetkých labákov v viewe laboranta? Not sure.__
</p>

#### Upravovanie a vymazávanie vzoriek

- __Milestone:__  TBA
- __Issues:__ TBA

<p>
Táto akcia je dostupná iba administrátorovi (aby sa nestrácali a nemdifikovali vzorky)
Má možnosť pristúpiť k edit pohľadu vzorky, upraviť ju alebo vymazať.
</p>

<div style="page-break-after: always;"></div>

## Galéria
#### Prihlasovcia obrazovka
![Login screen](img/login_screen.png)

#### Zoznam všetkých vzoriek
![Index of samples](img/samples_index.png)

#### Detail vzorky
![Sample detail](img/samples_detail.png)


