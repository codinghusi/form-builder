<?php

namespace App\Common;

use GrahamCampbell\Markdown\Facades\Markdown;

const REG_TEXT = '/@text\((\d+)\)/gm';
const REG_BIGTEXT = '/@freitext/gm';
const REG_TABLE = '/@table\((\[[^\)]*\])\)/gm';

const REG = '/@text\((\d+)\)|@freitext|@table\((\[[^\)]*\])\)/m';

class FormText {
    public static function parse(?string $formText): array {
        if (!$formText) {
            return [];
        }
        $markdown = Markdown::convert($formText)->getContent();

        preg_match_all(REG, $markdown, $matches, PREG_OFFSET_CAPTURE | PREG_UNMATCHED_AS_NULL);

        $result = [];
        $pos = 0;
        $count = 0;
        foreach ($matches[0] as $i => $match) {
            $str = $match[0];
            $mpos = $match[1];
            $result[] = [
                'type' => 'plain',
                'value' => substr($markdown, $pos, $mpos - $pos)
            ];

            if ($matches[1][$i][0]) {
                // @text
                $result[] = [
                    'type' => 'text',
                    'value' => $matches[1][$i][0]
                ];
            } else if ($matches[2][$i][0]) {
                // @table
                $result[] = [
                    'type' => 'table',
                    'value' => json_decode($matches[2][$i][0])
                ];
            } else {
                // @freitext
                $result[] = [
                    'type' => 'freitext'
                ];
            }

            $count += 1;
            $pos = $mpos + strlen($str);
        }

        $result[] = [
            'type' => 'plain',
            'value' => substr($markdown, $pos)
        ];

        $result['count'] = $count;
        return $result;
    }
}
