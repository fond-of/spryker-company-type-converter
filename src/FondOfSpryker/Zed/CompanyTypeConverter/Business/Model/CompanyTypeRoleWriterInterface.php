<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Business;

use Generated\Shared\Transfer\CompanyRoleCollectionTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

interface CompanyTypeRoleWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    public function updateCompanyRoles(CompanyTransfer $companyTransfer): CompanyRoleCollectionTransfer;
}
