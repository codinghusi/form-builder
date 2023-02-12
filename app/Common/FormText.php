<?php

namespace App\Common;

use GrahamCampbell\Markdown\Facades\Markdown;

const REG = '/@text\((\d+)\)|@freitext|@table\((\[(?:"[^"]*"|[^"\)]*)*\])\)/m';

class FormText {
    public static function parse(?string $formText): array {
        if (!$formText) {
            return [];
        }

        preg_match_all(REG, $formText, $matches, PREG_OFFSET_CAPTURE | PREG_UNMATCHED_AS_NULL);

        $result = [];
        $pos = 0;
        $count = 0;
        foreach ($matches[0] as $i => $match) {
            $str = $match[0];
            $mpos = $match[1];
            $raw = substr($formText, $pos, $mpos - $pos);
            $markdown = Markdown::convert($raw)->getContent();
            $result[] = [
                'type' => 'plain',
                'value' => $markdown
            ];

            if ($matches[1][$i][0]) {
                // @text
                $result[] = [
                    'type' => 'text',
                    'value' => $matches[1][$i][0]
                ];
            } else if ($matches[2][$i][0]) {
                // @table
                $json = $matches[2][$i][0];
                $json = htmlspecialchars_decode($json);
                $data = json_decode($json);
                if (!$data || !is_array($data) || !is_array($data[0])) {
                    continue;
                }
                $result[] = [
                    'type' => 'table',
                    'value' => $data
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
            'value' => substr($formText, $pos)
        ];

        $result['count'] = $count;
        return $result;
    }
}
