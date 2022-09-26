# libBook
Send preview of books to players

## Examples
```php
$item = VanillaItems::WRITTEN_BOOK();
$item->setTitle("Test Title");
$item->setAuthor("cooldogedev");
$item->setPageText(0, "Test Page 1");
$item->setPageText(1, "Test Page 2");

LibBook::sendPreview($sender, $item);
```
