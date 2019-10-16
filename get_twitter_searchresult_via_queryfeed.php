<?php
/**
 * 'Get twitter's RSS feed from queryfeed.net' main
 */
if(getenv("REMOTE_ADDR") === "" ||
  !(getenv("REMOTE_ADDR") != "" && current(get_included_files()) === __FILE__)) exit;

if(isset($_GET["q"])) {
    $q = urlencode(htmlspecialchars($_GET["q"], ENT_QUOTES, "UTF-8"));
} else exit;

include_once("get_twitter_searchresult_via_queryfeed__config.php");
$q_hash = hash('sha256', $q);
$time_start = microtime(true);

//古いキャッシュの削除
deleteOldFiles();

//キャッシュは存在するか？
if(! file_exists(TEMP_FOLDER.$q_hash.".xml")) {
    //キャッシュが存在しないなら保存
    $original = file_get_contents("https://queryfeed.net/tw?q=".$q, false, $AGENT);
    file_put_contents(TEMP_FOLDER.$q_hash.".xml", $original);
}

//RSSの解析
$json = array();
$rss = simplexml_load_file(TEMP_FOLDER.$q_hash.".xml");

foreach($rss->channel->item as $item) {
    $line = array(
        "link" => (string)$item->link,
        "title" => strip_tags(trim((string)$item->title)),
        "description" => strip_tags(trim((string)$item->description)),
        "pubDate" => date("Y/m/d H:i:s", strtotime((string)$item->pubDate))
    );
    array_push($json, $line);
}

array_push($json, array("processing_time" => (microtime(true) - $time_start)));

header("Content-type: application/json; charset=UTF-8");
echo json_encode($json);

exit;

/**
 * 古いファイルの削除
 */
function deleteOldFiles()
{
	if(! is_dir(TEMP_FOLDER)) return;

	$handle = opendir(TEMP_FOLDER);
	while(($file = readdir($handle)) !== false) {
		$dir_file = TEMP_FOLDER . $file;
		if(filetype($dir_file) !== "file") continue;
		if(time() < filemtime($dir_file) + EFFECTIVE_TIME) continue;
		if(pathinfo($dir_file, PATHINFO_EXTENSION) !== "xml") continue;
		unlink($dir_file);
	}
}
