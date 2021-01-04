<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Company\CompanyDependencyProvider;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyReaderInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverter;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeRoleWriterInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\CompanyTypeConverterConfig;
use FondOfSpryker\Zed\CompanyTypeConverter\CompanyTypeConverterDependencyProvider;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Container;

class CompanyTypeConverterBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\CompanyTypeConverterConfig
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyTypeConverter\Business\CompanyTypeConverterBusinessFactory
     */
    protected $companyTypeConverterBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface
     */
    protected $companyTypeConverterToCompanyFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeInterface
     */
    protected $companyTypeConverterToCompanyTypeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeInterface
     */
    protected $companyTypeConverterToCompanyTypeRoleFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeInterface
     */
    protected $companyTypeConverterToCompanyRoleFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeInterface
     */
    protected $companyTypeConverterToCompanyUserFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeInterface
     */
    protected $companyTypeConverterToPermissionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeRoleWriterInterface
     */
    protected $companyTypeRolewriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanyTypeConverterConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToCompanyTypeFacadeMock = $this->getMockBuilder(CompanyTypeConverterToCompanyTypeFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToCompanyRoleFacadeMock = $this->getMockBuilder(CompanyTypeConverterToCompanyRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToCompanyUserFacadeMock = $this->getMockBuilder(CompanyTypeConverterToCompanyUserFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToCompanyFacadeMock = $this->getMockBuilder(CompanyTypeConverterToCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToCompanyTypeRoleFacadeMock = $this->getMockBuilder(CompanyTypeConverterToCompanyTypeRoleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterToPermissionFacadeMock = $this->getMockBuilder(CompanyTypeConverterToPermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeRolewriter = $this->getMockBuilder(CompanyTypeRoleWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTypeConverterBusinessFactory = new CompanyTypeConverterBusinessFactory();
        $this->companyTypeConverterBusinessFactory->setContainer($this->containerMock);
        $this->companyTypeConverterBusinessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyTypeConverter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE],
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY_ROLE],
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY_USER],
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY_ROLE],
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE],
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE_ROLE],
                [CompanyTypeConverterDependencyProvider::FACADE_PERMISSION],
                [CompanyTypeConverterDependencyProvider::COMPANY_TYPE_CONVERTER_PRE_SAVE_PLUGINS],
                [CompanyTypeConverterDependencyProvider::COMPANY_TYPE_CONVERTER_POST_SAVE_PLUGINS]
            )->willReturnOnConsecutiveCalls(
                $this->companyTypeConverterToCompanyTypeFacadeMock,
                $this->companyTypeConverterToCompanyRoleFacadeMock,
                $this->companyTypeConverterToCompanyUserFacadeMock,
                $this->companyTypeConverterToCompanyRoleFacadeMock,
                $this->companyTypeConverterToCompanyTypeFacadeMock,
                $this->companyTypeConverterToCompanyTypeRoleFacadeMock,
                $this->companyTypeConverterToPermissionFacadeMock,
                [],
                []
            );

        $this->assertInstanceOf(
            CompanyTypeConverter::class,
            $this->companyTypeConverterBusinessFactory->createCompanyTypeConverter()
        );
    }

    /**
     * @return void
     */
    public function testCreateCompanyReader(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyTypeConverterDependencyProvider::FACADE_COMPANY],
            )->willReturnOnConsecutiveCalls(
                $this->companyTypeConverterToCompanyFacadeMock
            );


        $this->assertInstanceOf(
            CompanyReaderInterface::class,
            $this->companyTypeConverterBusinessFactory->createCompanyReader());
    }
}
