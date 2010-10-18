<?php
/**
 * Components_Runner_CiSetup:: prepares a continuous integration setup for a
 * component.
 *
 * PHP version 5
 *
 * @category Horde
 * @package  Components
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Components
 */

/**
 * Components_Runner_CiSetup:: prepares a continuous integration setup for a
 * component.
 *
 * Copyright 2010 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @category Horde
 * @package  Components
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Components
 */
class Components_Runner_CiSetup
{
    /**
     * The configuration for the current job.
     *
     * @var Components_Config
     */
    private $_config;

    /**
     * The application configuration.
     *
     * @var Components_Config_Application
     */
    private $_config_application;

    /**
     * The factory for PEAR handlers.
     *
     * @var Components_Factory
     */
    private $_factory;

    /**
     * Constructor.
     *
     * @param Components_Config             $config  The configuration for the
     *                                               current job.
     * @param Components_Config_Application $cfgapp  The application
     *                                               configuration.
     * @param Components_Pear_Factory       $factory Generator for all
     *                                               required PEAR components.
     */
    public function __construct(
        Components_Config $config,
        Components_Config_Application $cfgapp,
        Components_Pear_Factory $factory
    ) {
        $this->_config             = $config;
        $this->_config_application = $cfgapp;
        $this->_factory            = $factory;
    }

    public function run()
    {
        $options = $this->_config->getOptions();
        $arguments = $this->_config->getArguments();

        if (!isset($options['toolsdir'])) {
            throw new Components_Exception(
                'You are required to set the path to a PEAR tool environment.'
            );
        }
        if (!isset($options['pearrc'])) {
            throw new Components_Exception(
                'You are required to set the path to a PEAR environment for this package'
            );
        }

        if (basename(dirname($arguments[0])) == 'framework') {
            $origin = 'framework' . DIRECTORY_SEPARATOR . basename($arguments[0]);
        } else {
            $origin = basename($arguments[0]);
        }

        file_put_contents(
            $options['cisetup'] . DIRECTORY_SEPARATOR . 'config.xml',
            sprintf(
                file_get_contents(
                    $this->_config_application->getTemplateDirectory()
                    . DIRECTORY_SEPARATOR . 'hudson-component-config.xml.template',
                    'r'
                ),
                $origin,
                'horde',
                $options['toolsdir'],
                $this->_factory->createPackageForInstallLocation(
                    $arguments[0] . DIRECTORY_SEPARATOR . 'package.xml',
                    $options['pearrc']
                )->getDescription()
            )
        );
    }
}