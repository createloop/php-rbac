<?php

namespace RBAC\Interfaces;

interface IResource
{

    /**
     * 資料動作常數定義
     */
    const ACTION_GET = 'get';
    const ACTION_POST = 'pot';
    const ACTION_DELETE = 'delete';
    const ACTION_PUT = 'put';

    /**
     * 取得資源唯一id
     * @return int id
     */
    public function getId();

    /**
     * 取得資源名稱
     * @return string
     */
    public function getName();

    /**
     * 設定資源名稱
     * @param string
     */
    public function setName($name);

    /**
     * 取得資源
     * @return array
     */
    public function getResource();

    /**
     * 設定資源
     * @param string $resource
     */
    public function setResource($resource);

    /**
     * 取得資源存取動作
     * @return array
     */
    public function getAction();

    /**
     * 設定資源存取動作
     * @param string
     */
    public function setAction(IResource $action);

    /**
     * 儲存資源設定
     * @return bool
     */
    public function save();
}
