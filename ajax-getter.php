<?php
/**
 * Created by PhpStorm.
 * User: moridrin
 * Date: 21-8-17
 * Time: 22:39
 */

$url           = $_GET['url'];
$objectContent = file_get_contents($url);
$dom           = new DOMDocument();
$tmp           = '<!DOCTYPE html>' . explode('</head>', explode('</html>', $objectContent)[0])[1];
libxml_use_internal_errors(true);
$dom->loadHTML($tmp);
libxml_use_internal_errors(false);
$finder        = new DomXPath($dom);
$classname     = 'more-info-content';
$objectContent = $dom->saveHTML($finder->query("//*[contains(@class, '$classname')]")->item(0));
$classname     = 'ddb-footer-copyright';
$objectContent .= $dom->saveHTML($finder->query("//*[contains(@class, '$classname')]")->item(0));
$objectContent = preg_replace('/<script>(.*?)<\/script>/', date("Y"), $objectContent);
echo str_replace(PHP_EOL, '', trim(preg_replace('/\s+/', ' ', str_replace('href="/', 'href="https://www.dndbeyond.com/', $objectContent))));
