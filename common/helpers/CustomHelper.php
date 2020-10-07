<?php


namespace common\helpers;


class CustomHelper
{
    public function renderRating ($rating) {
        for ($i = 0; $i < 5; $i++) {
            $rating_class = $rating >= $i + 1 ? '' : 'star-disabled';
            echo '<span class="' . $rating_class . '"></span>';
        }
    }
}
