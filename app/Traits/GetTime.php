<?php

namespace App\Traits;

trait GetTime
{
    public function fullDate()
    { return $this['created_at']->translatedFormat('d F Y à H\hi'); }

    public function shortDate()
    { return $this['created_at']->translatedFormat('d F Y'); }
}
