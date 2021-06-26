<?php

namespace Nemo9l\Laftel;

use \Nemo9l\Laftel\Models\AnimeInfo;
use \Nemo9l\Laftel\Models\SearchResult;

/**
 * Unofficial PHP Laftel.net API Wrapper
 * Thanks to https://github.com/331leo/Laftel
 * 
 * @author  Ji Yong, Kim <nemo@qroffle.com>
 * @version 1.0
 */
class Laftel
{
    private const ENDPOINT = [
        'animeItem' => 'https://laftel.net/api/items/v1/%s/',
        'searchAnime' => 'https://laftel.net/api/search/v1/keyword/?keyword=%s',
    ];

    private const TIMEOUT = 10;

    private const DAY_KOREAN = [
        '일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'
    ];
    
    /**
     * Create a new instance.
     * 
     * @throws \Exception
     */
    public function __construct()
    {
        if(!function_exists('curl_init') || !function_exists('curl_setopt'))
        {
            throw new \Exception('cURL support is required, but can\'t be found');
        }
    }

    /**
     * Get an animation info.
     * 
     * @param   int $id
     * 
     * @return  AnimeInfo|null
     */
    public function getAnimeInfo(int $id): ?AnimeInfo
    {
        $data = $this->requestApi(sprintf(self::ENDPOINT['animeItem'], $id));
        if(!$data || isset($data->code))
        {
            return null;
        }

        $obj = new AnimeInfo();
        $obj->id = $data->id;
        $obj->url = 'https://laftel.net/item/' . $data->id;
        $obj->name = $data->name;
        $obj->thumbnail = $data->img;
        $obj->content = $data->content;
        $obj->ended = $data->is_ending;
        $obj->awards = $data->awards;

        $obj->content_rating = $data->content_rating;
        $obj->adult = $data->is_adult;
        $obj->viewable = $data->viewable;
        $obj->genres = $data->genres;
        $obj->tags = $data->tags;

        $animation_info = $data->animation_info;
        $obj->air_year_quarter = $animation_info->air_year_quarter;

        $air_day = $animation_info->original_air_time ?: $animation_info->distributed_air_time;
        $obj->air_day = array_search($air_day, self::DAY_KOREAN);
        
        $meta_info = $data->meta_info;
        $obj->avg_rating = $meta_info->avg_rating;
        $obj->view_male = $meta_info->male;
        $obj->view_female = $meta_info->female;

        return $obj;
    }

    /**
     * Search animations with a query string.
     * 
     * @param   string  $query
     * 
     * @return  SearchResult[]
     */
    public function searchAnime(string $query): array
    {
        $data = $this->requestApi(sprintf(self::ENDPOINT['searchAnime'], $query));
        if(!$data || isset($data->code))
        {
            return [];
        }

        $results = $data->results;

        $ret_val = [];
        foreach($results as $res)
        {
            $obj = new SearchResult();
            $obj->id = $res->id;
            $obj->name = $res->name;
            $obj->thumbnail = $res->img;
            $obj->adult = $res->is_adult;
            $obj->genres = $res->genres;

            $ret_val[] = $obj;
        }

        return $ret_val;
    }

    /**
     * Request with cURL
     * 
     * @param   string  $url
     * 
     * @return  object  JSON object
     */
    private function requestApi(string $url): ?object
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [ 'laftel: TeJava' ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}