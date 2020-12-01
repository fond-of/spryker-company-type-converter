<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter\Business;

use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverter;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterPluginExecutor;
use FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterPluginExecutorInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\CompanyTypeConverterDependencyProvider;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeInterface;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyTypeConverter\CompanyTypeConverterConfig getConfig()
 * @method \FondOfSpryker\Zed\CompanyTypeConverter\Persistence\CompanyTypeConverterRepositoryInterface getRepository()
 */
class CompanyTypeConverterBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverter
     */
    public function createCompanyTypeConverter(): CompanyTypeConverter
    {
        return new CompanyTypeConverter(
            $this->getCompanyTypeFacade(),
            $this->getCompanyRoleFacade(),
            $this->getCompanyUserFacade(),
            $this->createCompanyTypeRoleWriter(),
            $this->getConfig(),
            $this->createPluginExecutor()
        );
    }

    protected function createCompanyTypeRoleWriter(): CompanyTypeRoleWriterInterface
    {
        return new CompanyTypeRoleWriter(
            $this->getCompanyRoleFacade(),
            $this->getCompanyTypeFacade(),
            $this->getCompanyTypeRoleFacade(),
            $this->getPermissionFacade(),
            $this->getConfig()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Business\Model\CompanyTypeConverterPluginExecutorInterface
     */
    protected function createPluginExecutor(): CompanyTypeConverterPluginExecutorInterface
    {
        return new CompanyTypeConverterPluginExecutor(
            $this->getCompanyTypeConverterPreSavePlugins(),
            $this->getCompanyTypeConverterPostSavePlugins()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverterExtension\Dependency\Plugin\CompanyTypeConverterPostSavePluginInterface[]
     */
    protected function getCompanyTypeConverterPreSavePlugins(): array
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::COMPANY_TYPE_CONVERTER_PRE_SAVE_PLUGINS);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverterExtension\Dependency\Plugin\CompanyTypeConverterPostSavePluginInterface[]
     */
    protected function getCompanyTypeConverterPostSavePlugins(): array
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::COMPANY_TYPE_CONVERTER_POST_SAVE_PLUGINS);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeInterface
     */
    protected function getPermissionFacade(): CompanyTypeConverterToPermissionFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_PERMISSION);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeInterface
     */
    protected function getCompanyRoleFacade(): CompanyTypeConverterToCompanyRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_ROLE);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeInterface
     */
    protected function getCompanyUserFacade(): CompanyTypeConverterToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeInterface
     */
    protected function getCompanyTypeFacade(): CompanyTypeConverterToCompanyTypeFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE);
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeInterface
     */
    protected function getCompanyTypeRoleFacade(): CompanyTypeConverterToCompanyTypeRoleFacadeInterface
    {
        return $this->getProvidedDependency(CompanyTypeConverterDependencyProvider::FACADE_COMPANY_TYPE_ROLE);
    }
}
