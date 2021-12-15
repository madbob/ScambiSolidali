## CeloCelo

**CeloCelo** è una piattaforma per la raccolta e l'assegnazione di donazioni di beni e servizi.

Contrariamente a molte analoghe piattaforme, questa è pensata per collezionare donazioni e farle privatamente assegnare da operatori accreditati a persone in difficoltà (la cui identità è mantenuta anonima).

# Requisiti

* PHP >= 7.2.0
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

Molti testi descrittivi sono immessi direttamente nel template, altri (di natura più dipendente dall'istanza) sono cercati nel database: si veda il seeder in `database/seeds/TorinoTableSeeder.php` per vedere quali sono i parametri attesi nella tabella `configs`.

# Storia

**CeloCelo** è parte dell'omonimo progetto ideato e realizzato dall'Agenzia per lo Sviluppo Locale di San Salvario.

# Licenza

**CeloCelo** è distribuito in licenza AGPLv3.

Copyright (C) 2016/2021 Roberto Guido <info@madbob.org>.

La traduzione in italiano dei messaggi di sistema è distribuita in licenza MIT.

Copyright (C) 2016 Caouecs caouecs@caouecs.net
