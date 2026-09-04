<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class YoutubeLiveController extends Controller
{
    public function status()
    {
        return Cache::remember('youtube_live_status', 60, function () { // cache 1 minute
            try {
                $response = Http::timeout(10)->get("https://www.youtube.com/@diskominfolebak2375/streams");
                $html = $response->body();
                
                $isLive = strpos($html, '"isLiveNow":true') !== false;
                
                return [
                    'is_live' => $isLive,
                    'channel_id' => 'UCF-ZLoJzm7dWAh7xotxwEQA',
                    'live_url' => 'https://www.youtube.com/embed/live_stream?channel=UCF-ZLoJzm7dWAh7xotxwEQA&autoplay=1',
                    'offline_url' => 'https://www.youtube.com/embed/videoseries?list=UUF-ZLoJzm7dWAh7xotxwEQA'
                ];
            } catch (\Exception $e) {
                return [
                    'is_live' => false,
                    'channel_id' => 'UCF-ZLoJzm7dWAh7xotxwEQA',
                    'live_url' => 'https://www.youtube.com/embed/live_stream?channel=UCF-ZLoJzm7dWAh7xotxwEQA&autoplay=1',
                    'offline_url' => 'https://www.youtube.com/embed/videoseries?list=UUF-ZLoJzm7dWAh7xotxwEQA'
                ];
            }
        });
    }
}
