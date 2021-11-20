# DataConfig
PMMP 4.0

Save yaml or json files asynchronously

# How to use

## get data or create data
```php
Data::call(string $path, $type);
```

## save data
```php
Data::save(string $path, array $data, $type);
```

### $type
```php
Data::YAML or Data::JSON
```