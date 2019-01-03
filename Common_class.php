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

    /**
     * nf_to_wf 全形半形轉換
     *
     * @param  mixed $strs
     * @param  mixed $types
     *
     * @return void
     */
    public function nf_to_wf($strs, $types)
    {

        ## 全形半形轉換
        $nft = array(
            "(", ")", "[", "]", "{", "}", ".", ",", ";", ":",
            "-", "?", "!", "@", "#", "$", "%", "&", "|", "\\",
            "/", "+", "=", "*", "~", "`", "'", "\"", "<", ">",
            "^", "_",
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
            "k", "l", "m", "n", "o", "p", "q", "r", "s", "t",
            "u", "v", "w", "x", "y", "z",
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
            "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T",
            "U", "V", "W", "X", "Y", "Z",
            " ",
        );
        $wft = array(
            "（", "）", "〔", "〕", "｛", "｝", "﹒", "，", "；", "：",
            "－", "？", "！", "＠", "＃", "＄", "％", "＆", "｜", "＼",
            "／", "＋", "＝", "＊", "～", "、", "、", "＂", "＜", "＞",
            "︿", "＿",
            "０", "１", "２", "３", "４", "５", "６", "７", "８", "９",
            "ａ", "ｂ", "ｃ", "ｄ", "ｅ", "ｆ", "ｇ", "ｈ", "ｉ", "ｊ",
            "ｋ", "ｌ", "ｍ", "ｎ", "ｏ", "ｐ", "ｑ", "ｒ", "ｓ", "ｔ",
            "ｕ", "ｖ", "ｗ", "ｘ", "ｙ", "ｚ",
            "Ａ", "Ｂ", "Ｃ", "Ｄ", "Ｅ", "Ｆ", "Ｇ", "Ｈ", "Ｉ", "Ｊ",
            "Ｋ", "Ｌ", "Ｍ", "Ｎ", "Ｏ", "Ｐ", "Ｑ", "Ｒ", "Ｓ", "Ｔ",
            "Ｕ", "Ｖ", "Ｗ", "Ｘ", "Ｙ", "Ｚ",
            "　",
        );

        if ($types == '1') {
            // 轉全形
            $strtmp = str_replace($nft, $wft, $strs);
        } else {
            // 轉半形
            $strtmp = str_replace($wft, $nft, $strs);
        }
        return $strtmp;
    }

    /**
     * chk_pid 驗證 身分證字號 格式
     *
     * @param  mixed $id
     *
     * @return void
     */
    public function chk_pid($id)
    {
        if (!$id) {
            return false;
        }

        if (!$id) {
            return false;
        }

        $id = strtoupper(trim($id)); //將英文字母全部轉成大寫，消除前後空白
        //檢查第一個字母是否為英文字，第二個字元1 2 A~D 其餘為數字共十碼
        $ereg_pattern = "/^[A-Z]{1}[12ABCD]{1}[[:digit:]]{8}$/";
        if (!preg_match($ereg_pattern, $id)) {
            return false;
        }

        $wd_str = "BAKJHGFEDCNMLVUTSRQPZWYX0000OI"; //關鍵在這行字串
        $d1 = strpos($wd_str, $id[0]) % 10;
        $sum = 0;
        if ($id[1] >= 'A') {
            $id[1] = chr($id[1]) - 65;
        }
        //第2碼非數字轉換依[4]說明處理
        for ($ii = 1; $ii < 9; $ii++) {
            $sum += (int) $id[$ii] * (9 - $ii);
        }

        $sum += $d1 + (int) $id[9];
        if ($sum % 10 != 0) {
            return false;
        }

        return true;
    }

    /**
     * isDate 判斷日期
     *
     * @param  mixed $str
     *
     * @return void
     */
    public function isDate($str)
    {
        return strtotime(date('Y-m-d', strtotime($str))) === strtotime($str);

        // $__y = substr($str, 0, 4);
        // $__m = substr($str, 5, 2);
        // $__d = substr($str, 8, 2);
        // return checkdate($__m, $__d, $__y);
    }

    /**
     * isEmail 判斷 Email
     *
     * @param  mixed $str
     *
     * @return void
     */
    public function isEmail($str)
    {
        return preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $str);
    }

}

/* End of file Common_class.php */
