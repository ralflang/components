<?php
/**
 * Components_Config_Bootstrap:: class provides simple options for the bootstrap
 * process.
 *
 * PHP version 5
 *
 * @category Horde
 * @package  Components
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */

/**
 * Components_Config_Bootstrap:: class provides simple options for the bootstrap
 * process.
 *
 * Copyright 2011-2017 Horde LLC (http://www.horde.org/)
 *
 * See the enclosed file LICENSE for license information (LGPL). If you
 * did not receive this file, see http://www.horde.org/licenses/lgpl21.
 *
 * @category Horde
 * @package  Components
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.horde.org/licenses/lgpl21 LGPL 2.1
 */
class Components_Config_Bootstrap
extends Components_Config_Base
{
    /**
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->_options = array(
            'instructions' => array(
                'ALL' => array('include' => true),
                'channel:pecl.php.net' => array('exclude' => true),
            ),
            'force' => true,
            'symlink' => true,
        );
        $this->_arguments = array();
    }
}
