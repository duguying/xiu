<?php
/**
UTF-8字符串截取函数
str 字符串
length 字符串长度
return 截取后的字符串
*/
function ngg_substr($str, $length) {
    $carr = subString_UTF8($str, 0, $length);
    $cstr = implode('', $carr);
    if (utf8_strlen($cstr) < utf8_strlen($str)) {
        $cstr .= '...';
    }
    return $cstr;
}

function subString_UTF8($str, $start, $lenth) {
    $len = strlen($str);
    $r = array();
    $n = 0;
    $m = 0;
    for ($i = 0; $i < $len; $i++) {
        $x = substr($str, $i, 1);
        $a = base_convert(ord($x), 10, 2);
        $a = substr('00000000' . $a, -8);
        if ($n < $start) {
            if (substr($a, 0, 1) == 0) {
                
            } elseif (substr($a, 0, 3) == 110) {
                $i += 1;
            } elseif (substr($a, 0, 4) == 1110) {
                $i += 2;
            }
            $n++;
        } else {
            if (substr($a, 0, 1) == 0) {
                $r[] = substr($str, $i, 1);
            } elseif (substr($a, 0, 3) == 110) {
                $r[] = substr($str, $i, 2);
                $i += 1;
            } elseif (substr($a, 0, 4) == 1110) {
                $r[] = substr($str, $i, 3);
                $i += 2;
            } else {
                $r[] = '';
            }
            if (++$m >= $lenth) {
                break;
            }
        }
    }
    return $r;
}

function utf8_strlen($str) {
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        $value = ord($str[$i]);
        if ($value > 127) {
            $count++;
            if ($value >= 192 && $value <= 223)
                $i++;
            elseif ($value >= 224 && $value <= 239)
                $i = $i + 2;
            elseif ($value >= 240 && $value <= 247)
                $i = $i + 3;
            else
                die('Not a UTF-8 compatible string');
        }
        $count++;
    }
    return $count;
}
?>
