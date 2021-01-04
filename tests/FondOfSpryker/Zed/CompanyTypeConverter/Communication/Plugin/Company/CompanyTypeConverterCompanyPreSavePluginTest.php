<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Communication\Plugin\Company;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\CompanyTypeConverterFacade;
use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyTypeConverterCompanyPreSavePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Business\CompanyTypeConverterFacade
     */
    protected $companyTypeConverterFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyResponseTransfer
     */
    protected $companyResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyTypeConverter\Communication\Plugin\Company\CompanyTypeConverterCompanyPreSavePlugin
     */
    protected $companyTypeConverterCompanyPreSavePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $currentCompanyTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyTypeConverterFacadeMock = $this->getMockBuilder(CompanyTypeConverterFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyResponseTransferMock = $this->getMockBuilder(CompanyResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getFkCompanyType','setIsCompanyTypeModified', 'setFkOldCompanyType'])
            ->getMock();

        $this->currentCompanyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterCompanyPreSavePlugin = new CompanyTypeConverterCompanyPreSavePlugin();
        $this->companyTypeConverterCompanyPreSavePlugin->setFacade($this->companyTypeConverterFacadeMock);
    }

    /**
     * @return void
     */
    public function testPreSaveValidation(): void
    {
        $idCompanyType = 2;
        $currentIdCompanyType = 1;
        $this->companyResponseTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyTransfer')
            ->willReturn($this->companyTransferMock);

        $this->companyTransferMock->expects($this->atLeastOnce())
            ->method('getFkCompanyType')
            ->willReturn($idCompanyType);

        $this->companyTypeConverterFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyById')
            ->willReturn($this->currentCompanyTransferMock);

        $this->currentCompanyTransferMock->expects($this->atLeastOnce())
            ->method('getFkCompanyType')
            ->willReturn($currentIdCompanyType);

        $companyResponseTransfer = $this->companyTypeConverterCompanyPreSavePlugin
            ->preSaveValidation($this->companyResponseTransferMock);

        $this->assertEquals($this->companyResponseTransferMock, $companyResponseTransfer);
    }
}
