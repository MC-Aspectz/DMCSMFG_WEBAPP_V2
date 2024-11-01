<?php 

require_once("Java.inc");
require_once("lib/aspose.cells.php");

use aspose\cells;
use aspose\cells\Workbook;
use aspose\cells\CellsHelper;
use aspose\cells\Color;

echo "Java version: ".java("java.lang.System")->getProperty("java.version");
echo "\n";

// $license = new cells\License();
// $license->setLicense("Aspose.Cells.lic");

echo "CellsHelper version: ".CellsHelper::getVersion();
echo "\n";
echo cells\BorderType::BOTTOM_BORDER;
echo "\n";

echo "Color1: ".Color::fromArgb(0xffff00);
echo "\n";
echo "Color2: ".Color::fromArgb(0x30, 0, 0xff);
echo "\n";

$workbook = new Workbook("Book2.xlsx");
$settings = $workbook->getSettings();
echo $settings->isVScrollBarVisible();
echo "\n";

$settings->setVScrollBarVisible(false);
echo "\n";

$locale = new Java("java.util.Locale", "en", "US");
$settings->setLocale($locale);
echo $settings->getLocale();

echo "\n";

echo $workbook->save("result.xlsx");

?>
