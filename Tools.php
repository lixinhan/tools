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
    public static function isAjax(){
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&strtoupper($_SERVER['HTTP_X_REQUESTED_WITH'])==='XMLHTTPREQUEST')?true:false;
    }

}