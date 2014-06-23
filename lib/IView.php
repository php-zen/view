<?php
/**
 * 声明视图组件规范。
 *
 * @author    Snakevil Zen <zsnakevil@gmail.com>
 * @copyright © 2014 SZen.in
 * @license   LGPL-3.0+
 */

namespace Zen\View;

use ArrayAccess;

/**
 * 视图组件规范。
 *
 * @package    Zen\View
 * @version    0.1.0
 * @since      0.1.0
 */
interface IView extends ArrayAccess
{
    /**
     * 构造函数
     *
     * @param mixed[] $params 可选。初始参数集合
     */
    public function __construct($params = array());

    /**
     * 渲染并返回结果。
     *
     * @param  mixed  $params 可选。渲染参数集合
     * @return string
     */
    public function render($params = array());

    /**
     * 获取渲染结果。
     *
     * @return string
     */
    public function __toString();
}
