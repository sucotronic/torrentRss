<?php
class TorrentzCommand extends CConsoleCommand {
	public function actionUpdate() {

		$doc = new DOMDocument();
		$doc -> load('c:\\users\\suco\\test.rss');

		$items = $doc -> getElementsByTagName("item");
		// save each element
		foreach ($items as $item) {
			$title = $item -> getElementsByTagName("title") -> item(0) -> nodeValue;
			$title = str_ireplace('spanish', '', $title);
			$title = str_ireplace('avi', '', $title);
			$title = str_ireplace('mp3', '', $title);
			$title = str_ireplace('dvdrip', '', $title);
			$title = str_ireplace('xvid', '', $title);
			$title = str_ireplace('tdt', '', $title);
			$title = preg_replace('/(AC3(( )*5( )*1)?)/i', '', $title);
			$title = preg_replace('/((x|h|X|H)*264)/i', '', $title);
			echo $title . "\r\n";

			$description = $item -> getElementsByTagName("description") -> item(0) -> nodeValue;
			$descriptionArray = explode(' ', $description);
			$size = $descriptionArray[1];
			$peers = $descriptionArray[4];
			$seeds = $descriptionArray[6];
			$hash = $descriptionArray[8];
			//echo $size.' '.$peers.' '.$seeds.' '.$hash.' '."\r\n";
			$date = $item -> getElementsByTagName("pubDate") -> item(0) -> nodeValue;
			echo strtotime($date) . "\r\n";

			// get the piratebay link to files
			/*
			$link = $item->getElementsByTagName( "link" )->item(0)->nodeValue;
			$data = Yii::app()->CURL->run($link);
			if(preg_match('/(http:\/\/thepiratebay.org[^"]*)/i', $data, $result) != 0){
				echo $result[0]."\r\n";
				$data = Yii::app()->CURL->run($result[0]);
				if(preg_match('/(magnet:[^"]*)/i', $data, $result2) != 0){
					echo $result2[0]."\r\n";
				}
			}*/
			// TODO this is not fair, and should be changed to take data from wikipedia
			$data = Yii::app() -> CURL -> run('http://www.bing.com/search?q=site%3Aimdb.com+' . urlencode($title) . '&form=MOZSBR&pc=MOZI');
			if (preg_match('/(http:\/\/www.imdb.com\/title\/[^\/]*)/i', $data, $result) != 0) {
				$cut = explode('&', $result[0]);
				echo $cut[0] . "\r\n";
				$data2 = Yii::app() -> CURL -> run($cut[0] . 'releaseinfo');
				if (!empty($data2)) {
					$doc2 = new DOMDocument();
					libxml_use_internal_errors(true);
					$doc2 -> loadHTML($data2);
					libxml_clear_errors();
					$algo = $doc2 -> getElementById('tn15content');
					$tables = $algo -> getElementsByTagName('table');
					$akaTable = $tables -> item(1);
					$trs = $akaTable -> getElementsByTagName('tr');
					$spanishName = "";
					$tmpName = "";
					foreach ($trs as $tr) {
						$tds = $tr -> getElementsByTagName('td');
						foreach ($tds as $td) {
							if (stripos($td -> nodeValue, "Spain") !== FALSE) {
								$spanishName = $tmpName;
							}
							$tmpName = $td -> nodeValue;
						}
					}
					echo $spanishName . "\r\n";
					//die;
				}
			}
			// random time to avoid spider blockage
			usleep(rand(1500, 4000) * 1000);
		}
		// browse imdb rating and good name (aka), if not found, mark as error to review
		// http://www.imdbapi.com/?i=&t=El+Expreso+Polar
		// http://www.imdb.com/title/tt0338348/releaseinfo#akas (extract desired)
		// browse youtube video
		// http://gdata.youtube.com/feeds/api/videos?q=el%20expreso%20polar%20trailer%20-subtitulado%20-subtitulos&setOrderBy=viewCount&lr=es
		// get sinopsis from labutaca, if not found, mark as error to review
		// http://www.labutaca.net/films/29/polarexpress.htm
	}
}
?>