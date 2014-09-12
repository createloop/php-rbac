<?php

namespace RBAC\Interfaces;

interface IRole
{
    /**
     * 取得名稱
     * @return string
     */
    public function getName();

    /**
     * 取得擁有資源
     * @return array
     */
    public function getResource();

    /**
     * 設定擁有資源
     * @param IResource $resource
     */
    public function setResource(IResource $resource);

    /**
     * 設定名稱
     */
    public function setName($name);
}
