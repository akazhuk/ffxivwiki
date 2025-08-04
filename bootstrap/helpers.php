<?php

use PHPUnit\Util\Json;

/**
 * 成功响应
 * @param mixed $result
 * @param string $msg
 * @return Array
 */
function success($result = null, string $msg = 'ok'): Array
{
    $data = [
        'code' => 0,
        'msg' => $msg,
        'result' => $result,
    ];
    return $data;
}
