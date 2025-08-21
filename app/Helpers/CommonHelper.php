<?php
namespace App\Helpers;

class CommonHelper {
    public static function amountToText($input, $countryCode) {
        $input = abs($input);
        $countryCode = strtolower($countryCode);
        $string = '';
        $arrNumText = [
            'default' => ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven"],
            'id' => ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"],
        ];

        $arrMoreNumText = [
            'default' => [
                0 => [0 => '', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen'],
                1 => [0 => '', 10 => 'ten', 20 => 'twenty', 30 => 'thirty', 40 => 'fourty', 50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety'],
                'hundred',
                'thousand',
                'million',
                'billion',
                'trillion',
            ],
            'id' => ['belas', 'puluh', 'ratus', 'ribu', 'juta', 'miliyar', 'triliun'],
        ];

        $selectedNumText = empty($arrNumText[$countryCode]) ? $arrNumText['default'] : $arrNumText[$countryCode];
        $selectedMoreNumText = empty($arrMoreNumText[$countryCode]) ? $arrMoreNumText['default'] : $arrMoreNumText[$countryCode];

        if ($input < 12) {
            $string .= " ". $selectedNumText[$input];
        } else if ($input < 20) {
            if (is_array($selectedMoreNumText[0])) {
                $string .= " ". $selectedMoreNumText[0][$input];
            } else {
                $numMoreTen = $input - 10;
                $string .= " ". $selectedNumText[$numMoreTen]. " " . $selectedMoreNumText[0];
            }
        } else if ($input < 100) {
            $tens = ((int) ($input / 10)) * 10;
            $units = $input % 10;
            if (is_array($selectedMoreNumText[1])) {
                $string .= " ". $selectedMoreNumText[1][$tens] . ' ' . $selectedNumText[$units];
            } else {
                $string .= " ". $selectedNumText[($tens / 10)]. " " . $selectedMoreNumText[1]. ' ' . $selectedNumText[$units];
            }
        } else if ($input < 1000) {
            $hundreds = ((int) ($input / 100));
            $remainder = $input % 100;

            $string .= ' '. $selectedNumText[$hundreds]. ' '
                . $selectedMoreNumText[2]
                . self::amountToText($remainder, $countryCode);

            if (substr(trim($string), 0, 10) == 'satu ratus') {
                $string = str_replace('satu ratus', 'seratus', $string);
            }
            
        } else if ($input < 1000000) {
            $thousands = ((int) ($input / 1000));
            $remainder = $input % 1000;

            $string .= ' '. self::amountToText($thousands, $countryCode) . ' '
                . $selectedMoreNumText[3]
                . self::amountToText($remainder, $countryCode);

            if (substr(trim($string), 0, 9) == 'satu ribu') {
                $string = str_replace('satu ribu', 'seribu', $string);
            }
        } else if ($input < 1000000000) {
            $million = ((int) ($input / 1000000));
            $remainder = $input % 1000000;

            $string .= ' '. self::amountToText($million, $countryCode) . ' '
                . $selectedMoreNumText[4]
                . self::amountToText($remainder, $countryCode);

        } else if ($input < 1000000000000) {
            $million = ((int) ($input / 1000000000));
            $remainder = $input % 1000000000;

            $string .= ' '. self::amountToText($million, $countryCode) . ' '
                . $selectedMoreNumText[5]
                . self::amountToText($remainder, $countryCode);
        } else if ($input < 1000000000000000) {
            $million = ((int) ($input / 1000000000000));
            $remainder = $input % 1000000000000;

            $string .= ' '. self::amountToText($million, $countryCode) . ' '
                . $selectedMoreNumText[6]
                . self::amountToText($remainder, $countryCode);
        }
        return str_replace("  ", " ", ($string));
    }
}