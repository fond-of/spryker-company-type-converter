<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Business\Permission;

use Generated\Shared\Transfer\CompanyTransfer;

interface PermissionWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function findCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer;
}
