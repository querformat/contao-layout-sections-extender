# querformat/layout-sections-extender
### Contao-Erweiterung
[![Latest Stable Version](https://poser.pugx.org/querformat/layout-sections-extender/v/stable)](https://packagist.org/packages/querformat/layout-sections-extender)
[![Total Downloads](https://poser.pugx.org/querformat/layout-sections-extender/downloads)](https://packagist.org/packages/querformat/layout-sections-extender)
[![License](https://poser.pugx.org/querformat/layout-sections-extender/license)](https://packagist.org/packages/querformat/layout-sections-extender)

Mit dem Modul layout-sections-extender steht ein neuer Hook in Contao bereit.

Der "addLayoutSections"-Hook ermöglicht anderen Modulen neue Layoutbereiche für Artikel bereit zu stellen ohne das diese über die Layouteinstellungen in Contao definiert werden müssen.

```php
// config.php
$GLOBALS['TL_HOOKS']['addLayoutSections'][] = array(
  'myLayoutSectionKey' => 'MyLayoutSectionName',
  ...
);
```
