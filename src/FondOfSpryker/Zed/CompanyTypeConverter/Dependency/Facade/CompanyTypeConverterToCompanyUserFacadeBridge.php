<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserCriteriaFilterTransfer;
use Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface;

class CompanyTypeConverterToCompanyUserFacadeBridge implements CompanyTypeConverterToCompanyUserFacadeInterface
{
    /**
     * @var \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterfac
     */
    protected $companyUserFacade;

    /**
     * @param \Spryker\Zed\CompanyUser\Business\CompanyUserFacadeInterface $companyUserFacade
     */
    public function __construct(CompanyUserFacadeInterface $companyUserFacade)
    {
        $this->companyUserFacade = $companyUserFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    public function getCompanyUserCollection(
        CompanyUserCriteriaFilterTransfer $companyUserCriteriaFilterTransfer
    ): CompanyUserCollectionTransfer {
        return $this->companyUserFacade->getCompanyUserCollection($companyUserCriteriaFilterTransfer);
    }
}
