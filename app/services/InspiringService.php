<?php

namespace App\Services;

/**
 * Class InspiringService
 */
class InspiringService
{
    /**
     * @return string
     */
    public function inspire()
    {
        $inspireArray = [
            '「失敗為成功之母。」- 愛迪生',
            '「簡潔是最終的精密。」– 李奧納多‧達文西',
            '「好的開始是成功的一半」- 荷拉斯',
        ];
        $index = rand(0, count($inspireArray) - 1);
        return $inspireArray[$index];
    }
}