# Lead generator for test task of Leads.Tech project

## Install package

Install with composer:

```bash
composer require vladimir163/lead-generator
```

or add to the require section in `composer.json`

```bash
"vladimir163/lead-generator": "*"
```

## Using

```php
$generator = new Generator();

$generator->generateLeads(10000, function (Lead $lead) {
    //TODO: send lead to handling
});
```
