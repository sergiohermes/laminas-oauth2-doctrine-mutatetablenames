Mutate tablename for Laminas API Tools OAuth2 Doctrine Adapter
======================================================

About
-----

This module allows to configure the tables that the [OAuth2 Doctrine Adapter](https://github.com/API-Skeletons/oauth2-doctrine) for [Laminas API Tools](https://api-tools.getlaminas.org/) generates.

Installation
------------

Installation of this module uses composer. For composer documentation, please refer to [getcomposer.org](http://getcomposer.org/).

```sh
$ composer require sergiohermes/laminas-oauth2-doctrine-mutatetablenames
```

Add this module to your application's configuration:

```php
'modules' => array(
   ...
   'LaminasApi\\OAuth2\\Doctrine\\MutateTableNames',
),
```


Configuration
-------------

Copy `config/oauth2.doctrine-orm.mutatetablenames.global.php.dist` to your autoload directory and rename to `oauth2.doctrine-orm.mutatetablenames.global.php`

Edit the appropriate values to customize table names. This module considers the usage of the configured doctrine event manager.


Migration
---------

You should be able to review the changes with the following command

```
php public/index.php orm:schema-tool:update --dump-sql
```

When satisfied run this command to actually modify your database

```
php public/index.php orm:schema-tool:update --force
```

Now you should manually copy the relevant information to the new tables. Old tables are not removed unless you specify the '--complete' flag.

*WARNING: Will find any difference between the doctrine managed entities and the schema found in the database, not just the ones regarding the table name changes!* 
