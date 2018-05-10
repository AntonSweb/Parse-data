<?
if (!function_exists('parseDate')) {
    function parseData($url){
        $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    };
}

$html = parseData(url($L->lang.'/'.$b_article->seo_url));

$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML($html);
libxml_use_internal_errors(false);
$doc->saveHTML();

$find = new DomXPath($doc);
$nodes = $find->query("//*[contains(@class, 'article__photo-desc')]");
foreach($nodes as $key => $node){
    $src[$key] = $node->getAttribute('src');
}