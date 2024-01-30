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

Celá špecifikácia je dostupná v [dokumentácií](doc/README.md)
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
- [Docker](https://www.docker.com/get-started/)


### 1. Vytvorte súbor .env a vyplňte premenné prostredia

- Skopírujte súbor `.env.example` a premenujte na `.env`.

```shell
cp .env.example .env
```
  
### 2. Vy-buildite kontajnery

  ```shell
  docker compose up --build -d
  ```

### 3. Vygenerujte kľúč secret

  ```shell
  docker compose exec app php artisan key:generate
  ```

### 4. Spustite migrácie databázy

  ```shell
  docker compose exec app php artisan migrate
  ```

### 5. Naplňte databázu demo dátami (optional)

  ```shell
  docker compose exec app php artisan db:seed
  ```

## Spúšťanie

- Na spustenie všetkých služieb použite príkaz:

  ```shell
  docker compose up -d
  ```
- Navštívte stránku v prehliadači: -  [http://localhost:3000](http://localhost:3000)

- Pre vypnutie služieb:

  ```shell
  docker compose down
  ```


## Debug prístupové údaje

__login:__ {rola}@test.sk<br/>
__supertajné heslo:__ Nbusr123<br/>
_(Miesto role doplňte jedno z nasledujúcich - admin,garant,laborant,user)_
