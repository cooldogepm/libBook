# libBook
Send preview of books to players

## Examples

### Hello world
```php
$item = VanillaItems::WRITTEN_BOOK();
$item->setPageText(0, "Hello World!");
$item->setPageText(1, "This is an example of libBook");

LibBook::sendPreview(Player, $item);
```

### Projects using libBook
[RulesBook](https://github.com/nhanaz-pm-pl/RulesBook)
