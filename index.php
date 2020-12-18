<!--
Nalezy przygotowac skrypt php ktory znjadzie blogi z podanej listy (blogs-intput.txt) publikujace artykuly na temat Corona-Virusa .
Wyniki powinny byc zapisane w pliku results.csv w nastepujacym formacie:
unaufschiebbar.de,x,100546
gdzie x okresla skumulowana liczbe wystapien szukanych hasel na konkretnej stronie.
Wyszukiwanie powinno ograniczac sie tylko do strony glownej dostepnej bezposrednio pod wywolanym adresem url.
Skrypt powinien byc uruchamiany z poziomu php cli.
-->
<?php

class SearchKeywords
{
    public $result = [];
    public $keywords = ["covid", "coronavirus", "covid-19"];

    /**
     * @return array|false
     */
    public function getFileToArray(): array
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
        return $contents_arr;
    }

    /**
     * Download page content and http code.
     *
     * @param string $url URL
     *
     * @return array 0 => HTTP Response Code, 1 => HTML
     */
    protected function getContent($url): array
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
     * Count words based on variable $keywords and text file blogs-input.txt.
     * @return void
     */
    public function countKeywords(): void
    {
        foreach ($this->getFileToArray() as $keys => $value) {
            $counts = 0;
            $response = $this->getContent($value[0]);
            $bodyText = $response[1];
            $allWordsArray = array_count_values(str_word_count(strip_tags(strtolower($bodyText)), 1));

            foreach ($this->keywords as $key) {
                isset($allWordsArray[$key]) ? $counts = $counts + $allWordsArray[$key] : null;
            }
            if ($counts > 0) {
                array_push($this->result, [$value[0], $counts, $value[1][0]]);
            }
        }
    }

    /**
     * Save to file 'result.csv'
     *
     */
    public function saveToFIle(): void
    {
        $fp = fopen('result.csv', 'w');

        foreach ($this->result as $key => $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        echo "Done";
    }
}

$test = new SearchKeywords();
$test->countKeywords();
$test->saveToFIle();

