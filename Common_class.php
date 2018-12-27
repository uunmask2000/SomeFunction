<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/***
 * 共用 函式庫
 *
 *
 *
 *
 *
 */
class Common_class
{

    /**
     * replace_symbol_text  將字串部分內容替換成星號或其他符號
     *
     * author：wesley
     *
     * editor : Jim
     *
     * @param string $len 長度
     * @param string $string 原始字串
     * @param string $symbol 替換的符號
     * @param int $begin_num 顯示開頭幾個字元
     * @param int $end_num 顯示結尾幾個字元
     *
     * @return string
     */
    public function replace_symbol_text($len, $string, $symbol, $begin_num = 0, $end_num = 0)
    {

        if ($len > 2) {
            #多字模式
            $string_length = mb_strlen($string);
            $begin_num = (int) $begin_num;
            $end_num = (int) $end_num;
            $string_middle = '';
            $symbol_num = $string_length - ($begin_num + $end_num);
            $string_begin = mb_substr($string, 0, $begin_num);
            $string_end = mb_substr($string, -1, $end_num);

            for ($i = 0; $i < $symbol_num; $i++) {
                $string_middle .= $symbol;
            }

            return $string_begin . $string_middle . $string_end;
        }

        if ($len == 2) {
            #兩字模式

            return str_replace(mb_substr($string, -1), $symbol, $string);
        }

    }

    /**
     * _array_diff 多維比較
     *
     * @param  mixed $array_1
     * @param  mixed $array_2
     *
     * @return void
     */
    public function _array_diff($array_1, $array_2)
    {
        foreach ($array_1 as $key => $item) {

            if (in_array($item, $array_2, true)) {
                unset($array_1[$key]);
            }
        }

        return $array_1;

    }

}

/* End of file Common_class.php */
