<?php

use CSite;

/**
 * Хелпер, применяемый при работе с датой и временем
 *
 * Class DateHelper
 *
 * @author Sergey Starovoyt <starovoyt.s@gmail.com>
 */
class DateHelper
{
    /**
     * Конвертирует дату и время в формате сайта в указанный формат
     *
     * @param string $dateTime
     * @param string $format
     *
     * @return string
     */
    public static function formatSiteDateTime($dateTime, $format)
    {
        $unixDateTime = MakeTimeStamp($dateTime);

        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $format = preg_replace('#(?<!%)((?:%%)*)%e#', '\1%#d', $format);
        }

        $formattedDateTime = strftime($format, $unixDateTime);

        return iconv('windows-1251', 'utf-8', $formattedDateTime);
    }

    /**
     * Возвращает текущую дату и время в формате текущего сайта
     *
     * @param string $type - Тип формата. Допустимы следующие значения:
     * FULL - дата и время
     * SHORT - дата
     *
     * @return string
     */
    public static function getCurDateTime($type = 'FULL')
    {
        global $DB;

        return date($DB->DateFormatToPHP(CSite::GetDateFormat($type)), time());
    }
}
