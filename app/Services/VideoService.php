<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoService
{
    private $video;

    /**
     * @return Video
     */
    public function getVideo(): Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     */
    public function setVideo(Video $video): void
    {
        $this->video = $video;
    }

    public function save(
        $name,
        $url
    )
    {
        $this->video->name = $name;
        $this->video->url = $url;
        $this->video->save();

        return $this->video;
    }
}
