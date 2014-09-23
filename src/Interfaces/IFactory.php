<?php
namespace RBAC\Interfaces;

Interface IFactory
{
    /**
     * [getResourceProxy]
     * @param  string $resourceName
     * @param  string $resource
     * @return object ResourceProxy
     */
    public function getResourceProxy($resourceName, $resource);

    /**
     * [getRoleProxy]
     * @param  string $roleName
     * @return object RoleProxy
     */
    public function getRoleProxy($roleName);
}

