# Správa chemických vzoriek laboratória

__Škola__: Slovenská Technická Univerzita v Bratislave<br/>
__Fakulta__: Fakulta informatiky a informačných technológií<br/>
__Predmet__: Databázové systémy<br/>
__Študenti__: Bc. František Gič, Ján Šouc<br/>
__Cvičiaci__: Ing. Samuel Pecár<br/>

<div style="page-break-after: always;"></div>

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

<div style="page-break-after: always;"></div>

## Implementácia

<p>

Projekt je napípsaný ako webová aplikácia.<br/>
Backend je napísaný v PHP Frameworku [Laravel 7](https://laravel.com)<br/>
Frontend bol pôvodne robený v JavaScript Frameworku [Vue.js](https://vuejs.org) ale z časového deficitu sme premigrovali na MPA verziu aplikácie.<br/>
Na FE používame taktiež CSS Framework [TailwindCSS](https://tailwindcss.com/)
a font ikoniek [Font Awesome 5](https://fontawesome.com/).<br/>
K administrácií chemických vzoriek používame [knižnicu JSME](https://peter-ertl.com/jsme/) od Peter Ertl a Bruno Bienfait.

</p>

<div style="page-break-after: always;"></div>

## Inštalácia
__Požiadavky__:
- PHP 7+
- Node.js & NPM - Na build frontend častí (transpilácia SASS do CSS)
- PostgreSQL
- Composer - PHP dependency manager

```bash
git clone https://github.com/FIIT-DBS2020/project-gic_souc/
cd project-gic_souc/src
composer install
npm install
```

Po nahodení databázy a importovaní dát dostupných v `db/db_dump.bak` spustiť server pomocou:

```bash
php artisan serve
```

_Debug credentials:_<br/>
__login:__ {rola}@test.sk<br/>
__supertajné heslo:__ nbusr123<br/>
_(Miesto role doplňte jedno z nasledujúcich - admin,garant,laborant,user)_
