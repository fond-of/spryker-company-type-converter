<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Business\Model;

use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * CompanyReader constructor.
     * @param \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface $companyFacade
     */
    public function __construct(
        CompanyTypeConverterToCompanyFacadeInterface $companyFacade
    ) {
        $this->companyFacade = $companyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleCollectionTransfer
     */
    public function findCompanyById(
        CompanyTransfer $companyTransfer
    ): CompanyTransfer {
        return $this->companyFacade->getCompanyById($companyTransfer);
    }
}
