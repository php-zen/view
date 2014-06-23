<?php
/**
 * 定义抽象视图组件。
 *
 * @author    Snakevil Zen <zsnakevil@gmail.com>
 * @copyright © 2014 SZen.in
 * @license   LGPL-3.0+
 */

namespace Zen\View;

use Zen\Core;

/**
 * 抽象视图组件。
 *
 * @package    Zen\View
 * @version    0.1.0
 * @since      0.1.0
 */
abstract class View extends Core\Component implements IView
{
    /**
     * 参数集合。
     *
     * @internal
     *
     * @var mixed[]
     */
    protected $params;

    /**
     * 判断参数是否存在。
     *
     * @internal
     *
     * @param  scalar $offset 参数名
     * @return bool
     */
    final public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->params);
    }

    /**
     * 获取参数值。
     *
     * @internal
     *
     * @param  scalar $offset 参数名
     * @return mixed
     */
    final public function offsetGet($offset)
    {
        return @$this->params[$offset];
    }

    /**
     * 渲染结果。
     *
     * @internal
     *
     * @var string
     */
    protected $result;

    /**
     * 设置参数。
     *
     * @internal
     *
     * @param  scalar $offset 参数名
     * @param  mixed  $value  新值
     * @return void
     */
    final public function offsetSet($offset, $value)
    {
        $this->params[$offset] = $value;
        $this->result = '';
    }

    /**
     * 删除参数。
     *
     * @inter
     *
     * @param  scalar $offset 参数名
     * @return void
     */
    final public function offsetUnset($offset)
    {
        unset($this->params[$offset]);
        $this->result = '';
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed[] $params 可选。初始参数集合
     */
    final public function __construct($params = array())
    {
        $this->params = $params;
        $this->result = '';
    }

    /**
     * {@inheritdoc}
     *
     * @param  mixed  $params 可选。渲染参数集合
     * @return string
     */
    final public function render($params = array())
    {
        if (!empty($params)) {
            $this->params = array_merge($this->params, $params);
            $this->result = '';
        }
        if ('' == $this->result) {
            $this->result = $this->onRender($this->params);
        }

        return $this->result;
    }

    /**
     * 渲染事件。
     *
     * @param  mixed[] $params 渲染参数集合
     * @return string
     */
    protected function onRender($params)
    {
        return '';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    final public function __toString()
    {
        return $this->render();
    }
}
