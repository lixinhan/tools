<?php

namespace Lixinhan;
/**
 *        File: Tools.php
 *      Author: XinHan.Li
 *     Version: 1.0.0
 *  Createtime: 2017-11-15 10:41
 * Description:工具大全
 */
class Tools
{

    /** 判断请求是否是AJAX请求
     * @return bool
     *
     */
    public static function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHTTPREQUEST') ? true : false;
    }

    /** 获取指定parentid的树状结构数据
     * @param $parentid  顶级ID
     * @param $data      列表数据
     * @param string $primaryIDKey 数据主键key
     * @param string $parenIDtKey 父级主键key
     * @param string $childrenKey 子节点数据key
     * @param string $levelKey 代表层级的key
     * @param int level  层级值
     * @return array
     */
    public static function getTree($parentid, $data, $primaryIDKey = 'id', $parenIDtKey = 'parent_id', $childrenKey = 'children', $levelKey = '_level', $level = 0)
    {
        $returnData = [];
        foreach ($data as $key => $value) {
            if ($parentid == $value[$parenIDtKey]) {
                unset($data[$key]);
                $children = self::getTree($value[$primaryIDKey], $data, $primaryIDKey, $parenIDtKey, $childrenKey, $levelKey, $level + 1);
                if (isset($children)) {
                    $value[$childrenKey] = $children;
                }
                $value[$levelKey] = $level;
                $returnData[] = $value;
            }
        }
        return $returnData;
    }

    /**
     * 获取文件保存的地址
     * @param $filename
     * @param string $pathPrefix
     * @return string
     */
    public static function getFileSavePath($filename, $pathPrefix = '')
    {
        $tempFile = explode('.', $filename);
        $extension = end($tempFile);
        $time = microtime(true);
        $hash = md5($filename . uniqid() . $time);
        $return = sprintf(
            '%s%s%s%s%s%s%s%s%s%s%s',
            rtrim($pathPrefix, DIRECTORY_SEPARATOR),
            DIRECTORY_SEPARATOR,
            date("Y-m-d", $time),
            DIRECTORY_SEPARATOR,
            rand(0, 9),
            DIRECTORY_SEPARATOR,
            substr($hash, 0, 2),
            DIRECTORY_SEPARATOR,
            $hash,
            '.',
            $extension
        );
        return $return;
    }
}