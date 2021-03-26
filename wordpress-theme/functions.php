<?php
// Helpers here serve as example. Change to suit your needs.

// For a real-world example check here:
// https://github.com/wp-bond/bond/blob/master/src/Tooling/Vite.php
// https://github.com/wp-bond/boilerplate/tree/master/app/themes/boilerplate

// on the links above there is also example for @vitejs/plugin-legacy


// Some dev/prod mechanism would exist in your project
// Handling manualy here, change to test both cases

remove_action( 'template_redirect', 'redirect_canonical' );

// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
function remove_redirects() {
	add_rewrite_rule( '^/(.+)/?', 'index.php', 'top' );
}

add_action( 'init', 'remove_redirects' );

function vite($entry): string
{
    return jsTag($entry)
        . jsPreloadImports($entry)
        . cssTag($entry);
}

function jsTag(string $entry): string
{
    $url =  assetUrl($entry);

    return '<script type="module" crossorigin src="'
        . $url
        . '"></script>';
}

function jsPreloadImports(string $entry): string
{


    $res = '';
    foreach (importsUrls($entry) as $url) {
        $res .= '<link rel="modulepreload" href="'
            . $url
            . '">';
    }
    return $res;
}

function cssTag(string $entry): string
{

    $tags = '';
    foreach (cssUrls($entry) as $url) {
        $tags .= '<link rel="stylesheet" href="'
            . $url
            . '">';
    }
    return $tags;
}


/**
 * 获取Manifest文件
 */
function getManifest(): array
{
    $content = file_get_contents(__DIR__ . '/manifest.json');

    return json_decode($content, true);
}

/**
 * 获取资源地址
 */
function assetUrl(string $entry): string
{
    $manifest = getManifest();
  
    return isset($manifest[$entry])
        ? '/' . $manifest[$entry]['file']
        : '';
}

/**
 * 导入url地址
 */
function importsUrls(string $entry): array
{
    $urls = [];
    $manifest = getManifest();

    if (!empty($manifest[$entry]['imports'])) {
        foreach ($manifest[$entry]['imports'] as $imports) {
            $urls[] = '/' . $manifest[$imports]['file'];
        }
    }
    return $urls;
}

/**
 * 获取css地址
 */
function cssUrls(string $entry): array
{
    $urls = [];
    $manifest = getManifest();

    if (!empty($manifest[$entry]['css'])) {
        foreach ($manifest[$entry]['css'] as $file) {
            $urls[] = '/' . $file;
        }
    }
    return $urls;
}