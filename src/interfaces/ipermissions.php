<?php

namespace RBAC\Interfaces;

interface IPermissions
{
    /**
     * 取得權限名稱
     * @return string
     */
    public function getName();

    /**
     * 增加資源
     * @param array( name => resource, ...)
     */
    public function addResource($resource);

    /**
     * 移除資源
     * @param callback
     */
    public function removeResource();

}

