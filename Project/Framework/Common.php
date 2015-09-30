<?php
/**
 * Created by PhpStorm.
 * User: Stoyko
 * Date: 9/29/2015
 * Time: 9:38 PM
 */

namespace FW;


class Common
{
    public static function normalize($data, $types)
    {
        if ($types == null) {
            return htmlentities($data);
        }

        if (strpos($types, '|') === false) {
            $types .= "|";
        }

        $types = array_filter(explode('|', $types));

        if (!in_array('noescape', $types)) {
            $data = htmlentities($data);
        }

        if (is_array($types)) {
            foreach ($types as $type) {
                switch ($type) {
                    case 'int':
                        $data = (int)$data;
                        break;
                    case 'float':
                        $data = (float)$data;
                        break;
                    case 'double':
                        $data = (double)$data;
                        break;
                    case 'bool':
                        $data = (bool)$data;
                        break;
                    case 'string':
                        $data = (string)$data;
                        break;
                    case 'trim':
                        $data = trim($data);
                        break;
                    default:
                        if ($type != 'noescape') {
                            throw new \Exception('Unsupported normalize type : ' . $type, 500);
                        }
                        break;
                }
            }
        }

        return $data;
    }
}