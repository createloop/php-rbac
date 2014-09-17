<?php

namespace RBAC\Interfaces;

interface IRole
{
    public function getId();

    /**
     * 取得名稱
     * @return string
     */
    public function getName();

    /**
     * 取得擁有資源
     * @param string resourceName | callback | null
     * @return array
     */
    public function getResources($resource = null);

    /**
     * 設定擁有資源
     * @param IResource $resource
     */
    public function addResource(IResource $resource);

    /**
     * 移除擁有資源
     * @param string $resource->getName()
     */
    public function removeResource($resourceName);

    /**
     * 設定名稱
     * @param string name
     */
    public function setName($name);
}
