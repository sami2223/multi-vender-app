<?php
$composer = json_decode(file_get_contents('composer.json'), true);
if (!isset($composer['autoload'])) {
  $composer['autoload'] = [];
}
if (!isset($composer['autoload']['files'])) {
  $composer['autoload']['files'] = [];
}
$helper = "app/Support/helpers.php";
if (!in_array($helper, $composer['autoload']['files'])) {
  $composer['autoload']['files'][] = $helper;
}
file_put_contents('composer.json', json_encode($composer, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) . PHP_EOL);
echo "Patched composer.json autoload files.\n";
