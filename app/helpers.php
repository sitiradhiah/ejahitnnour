<?php

use Illuminate\Support\Str;

if (!function_exists('renderReadMore')) {
    function renderReadMore($id, $fullText, $shortText = null, $limit = 60) {
        $shortText = $shortText ?? Str::limit($fullText, $limit);

        if (strlen($fullText) <= $limit) {
            return e($fullText);
        }

        return '
            <span id="'.$id.'_short">
                '.e($shortText).'
                <a href="#" onclick="toggleReadMore(\''.$id.'\'); return false;">Read more</a>
            </span>
            <span id="'.$id.'_full" style="display:none;">
                '.e($fullText).'
                <a href="#" onclick="toggleReadMore(\''.$id.'\'); return false;">Read less</a>
            </span>
        ';
    }
}
