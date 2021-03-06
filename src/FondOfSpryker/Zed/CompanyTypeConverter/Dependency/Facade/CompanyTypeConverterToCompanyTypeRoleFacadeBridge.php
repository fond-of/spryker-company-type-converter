<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade;

use FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\CompanyTypeTransfer;

class CompanyTypeConverterToCompanyTypeRoleFacadeBridge implements CompanyTypeConverterToCompanyTypeRoleFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface
     */
    protected $companyTypeRoleFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyTypeRole\Business\CompanyTypeRoleFacadeInterface $companyTypeRoleFacade
     */
    public function __construct(CompanyTypeRoleFacadeInterface $companyTypeRoleFacade)
    {
        $this->companyTypeRoleFacade = $companyTypeRoleFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTypeTransfer $companyTypeTransfer
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return array
     */
    public function getPermissionKeysByCompanyTypeAndCompanyRole(
        CompanyTypeTransfer $companyTypeTransfer,
        CompanyRoleTransfer $companyRoleTransfer
    ): array {
        return $this->companyTypeRoleFacade
            ->getPermissionKeysByCompanyTypeAndCompanyRole($companyTypeTransfer, $companyRoleTransfer);
    }
}
