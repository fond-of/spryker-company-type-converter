<?php

namespace FondOfSpryker\Zed\CompanyTypeConverter;

use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyRoleFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyTypeRoleFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyUserFacadeBridge;
use FondOfSpryker\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToPermissionFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CompanyTypeConverterDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_PERMISSION = 'FACADE_PERMISSION';
    public const FACADE_COMPANY = 'FACADE_COMPANY';
    public const FACADE_COMPANY_TYPE = 'FACADE_COMPANY_TYPE';
    public const FACADE_COMPANY_TYPE_ROLE = 'FACADE_COMPANY_TYPE_ROLE';
    public const FACADE_COMPANY_ROLE = 'FACADE_COMPANY_ROLE';
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';

    public const COMPANY_TYPE_CONVERTER_PRE_SAVE_PLUGINS = 'COMPANY_TYPE_CONVERTER_PRE_SAVE_PLUGINS';
    public const COMPANY_TYPE_CONVERTER_POST_SAVE_PLUGINS = 'COMPANY_TYPE_CONVERTER_POST_SAVE_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addPermissionFacade($container);
        $container = $this->addCompanyFacade($container);
        $container = $this->addCompanyTypeFacade($container);
        $container = $this->addCompanyTypeRoleFacade($container);
        $container = $this->addCompanyRoleFacade($container);
        $container = $this->addCompanyUserFacade($container);
        $container = $this->addCompanyTypeConverterPreSavePlugins($container);
        $container = $this->addCompanyTypeConverterPostSavePlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPermissionFacade(Container $container): Container
    {
        $container[static::FACADE_PERMISSION] = function (Container $container) {
            return new CompanyTypeConverterToPermissionFacadeBridge(
                $container->getLocator()->permission()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY] = function (Container $container) {
            return new CompanyTypeConverterToCompanyFacadeBridge(
                $container->getLocator()->company()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyTypeRoleFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_TYPE_ROLE] = function (Container $container) {
            return new CompanyTypeConverterToCompanyTypeRoleFacadeBridge(
                $container->getLocator()->companyTypeRole()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyRoleFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_ROLE] = function (Container $container) {
            return new CompanyTypeConverterToCompanyRoleFacadeBridge(
                $container->getLocator()->companyRole()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyTypeFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_TYPE] = function (Container $container) {
            return new CompanyTypeConverterToCompanyTypeFacadeBridge(
                $container->getLocator()->companyType()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container[static::FACADE_COMPANY_USER] = function (Container $container) {
            return new CompanyTypeConverterToCompanyUserFacadeBridge(
                $container->getLocator()->companyUser()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyTypeConverterPreSavePlugins(Container $container): Container
    {
        $container[static::COMPANY_TYPE_CONVERTER_PRE_SAVE_PLUGINS] = function () {
            return $this->getCompanyTypeConverterPreSavePlugins();
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyTypeConverterPostSavePlugins(Container $container): Container
    {
        $container[static::COMPANY_TYPE_CONVERTER_POST_SAVE_PLUGINS] = function () {
            return $this->getCompanyTypeConverterPostSavePlugins();
        };

        return $container;
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverterExtension\Dependency\Plugin\CompanyTypeConverterPreSavePluginInterface[]
     */
    protected function getCompanyTypeConverterPreSavePlugins(): array
    {
        return [];
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyTypeConverterExtension\Dependency\Plugin\CompanyTypeConverterPostSavePluginInterface[]
     */
    protected function getCompanyTypeConverterPostSavePlugins(): array
    {
        return [];
    }
}
