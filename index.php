<?php
define('NAME', 'http://');

class SearchKeywords
{
    public $result = [];
    public $keywords = ["covid", "coronavirus", "covid-19"];

    /**
     * @return array|false
     */
    public function getFileToArray()
    {
        header('Content-type: application/json');

        // you file path
        $fp = 'blogs-input.txt';

        // get the contents of file in array
        $contents_arr = file($fp, FILE_IGNORE_NEW_LINES);

        foreach ($contents_arr as $key => $value) {
            $value = explode(':', $value);
            $contents_arr[$key] = [rtrim($value[1], "\r"), [$value[0]]];
        }
        //var_dump($contents_arr);
        return $contents_arr;
    }

    /**
     * Download page content and http code.
     *
     * @param string $url URL
     *
     * @return array 0 => HTTP Response Code, 1 => HTML
     */
    protected function getContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        ob_start();
        curl_exec($ch);
        $response = ob_get_contents();
        ob_end_clean();

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        return array($httpCode, $response);
    }

    /**
     * Remove HTML tags.
     * @param $html
     * @return string
     */
    public function parseBody($html)
    {
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        $doc->preserveWhiteSpace = false;

        $body = $doc->getElementsByTagName('body')->item(0)->nodeValue;

        return strip_tags($body);
    }

    public function countKeywords()
    {
        $allWordsArray = 0;
        $counts = 0;
        foreach ($this->getFileToArray() as $keys => $value) {
            $response = $this->getContent(NAME . $value[0]);
            $bodyText = $this->parseBody($response[1]);

            foreach ($this->keywords as $key) {
                //$counts = substr_count($response[1],$key);
                $allWordsArray += str_word_count($bodyText, 0, $key);
                $counts = count($allWordsArray);
            }
            $this->result = [[$value[0], $counts, $value[1][0]]];
        }
    }

    public function saveToFIle()
    {
        $fp = fopen('result.csv', 'w');

        foreach ($this->result as $key => $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }
}

$test = new SearchKeywords();
$test->countKeywords();
$test->saveToFIle();

