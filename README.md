# call_twitter

About the keyword convert Twitter feed to json using [Queryfeed](https://queryfeed.net/ "Queryfeed") API.
I used in [anichecker](https://kuje.kousakusyo.info/tools/anichecker/ "anichecker").

## Description

This API returns throw queryfeed.net API to search keywords that sent from the get value "q", where the returned title, comment, the URL in JSON.

## Demo

<https://kuje.kousakusyo.info/tools/iphone/anichecker/>

!["Get JSON by twitter's feed from queryfeed.net" demo image](https://kuje.kousakusyo.info/tools/anichecker/images/20190202anichecker_review_preparation_twitter.jpg)

## Usage

Please setting 'call_twitter__config.php' before using.

(call_twitter__config.php)
Setting temp folder and effective time.

(get)
'q' keyword.

(return)
'title' title.
'description' description.
'link' link url.
'pubDate' date.

## LICENCE

MIT License.