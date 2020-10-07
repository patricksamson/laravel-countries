<?php

/**
* PHP var_export() with short array syntax (square brackets) indented 2 spaces.
*
* NOTE: The only issue is when a string value has `=>\n[`, it will get converted to `=> [`
* @link https://www.php.net/manual/en/function.var-export.php
*/
function short_var_export($expression, $return=false)
{
    $export = var_export($expression, true);
    $patterns = [
        "/array \(/" => '[',
        "/^([ ]*)\)(,?)$/m" => '$1]$2',
        "/=>[ ]?\n[ ]+\[/" => '=> [',
        "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
    ];
    $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
    if ((bool)$return) {
        return $export;
    } else {
        echo $export;
    }
}

$countriesJsonPath = './vendor/mledoze/countries/dist/countries-unescaped.json';
$data = [];
if (file_exists($countriesJsonPath)) {
    $data = json_decode(file_get_contents($countriesJsonPath), true);
} else {
    throw new Exception(sprintf('Cannot find the file "%s".', $countriesJsonPath));
}


$stub = file_get_contents(__DIR__.'/CountriesDataSource.stub');
$stub = str_replace('[/*COUNTRIES_DATA*/]', short_var_export($data, true), $stub);

file_put_contents(__DIR__.'/../src/CountriesDataSource.php', $stub);
