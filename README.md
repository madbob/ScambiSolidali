## Scambi Solidali

**Scambi Solidali** è una piattaforma per la raccolta e l'assegnazione di
donazioni di beni e servizi.

Contrariamente a molte analoghe piattaforme, questa è pensata per collezionare
donazioni e farle privatamente assegnare da operatori accreditati a persone in
difficoltà (la cui identità è mantenuta anonima).

# Requisiti

* PHP >= 5.6.4
* composer ( https://getcomposer.org/ )
* un webserver ed un database

# Installazione

```
git clone https://github.com/madbob/ScambiSolidali.git
cd ScambiSolidali
composer install
cp .env.example .env
(editare .env con i propri parametri di accesso al database)
php artisan migrate
php artisan db:seed
php artisan key:generate
```

Le credenziali di default sono username: info@example.it, password: cippalippa

# Storia

**Scambi Solidali** è parte dell'omonimo progetto ideato e realizzato
dall'Agenzia per lo Sviluppo Locale di San Salvario.

# Licenza

**Scambi Solidali** è distribuito in licenza AGPLv3.

Copyright (C) 2016 Roberto Guido <info@madbob.org>.
