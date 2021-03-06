<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Theme Customization Path
 */
namespace Magento\View\Design\Theme\Customization;

/**
 * Theme Customization Path
 */
class Path
{
    /**
     * Customization directory name
     */
    const DIR_NAME = 'theme_customization';

    /**
     * @var string
     */
    protected $filename;

    /**
     * @var \Magento\Filesystem
     */
    protected $filesystem;

    /**
     * @var \Magento\Filesystem\Directory\Read
     */
    protected $mediaDirectoryRead;

    /**
     * @var \Magento\Filesystem\Directory\Read
     */
    protected $themeDirectoryRead;

    /**
     * Constructor
     *
     * @param \Magento\Filesystem $filesystem
     * @param $filename
     */
    public function __construct(
        \Magento\Filesystem $filesystem,
        $filename = \Magento\View\ConfigInterface::CONFIG_FILE_NAME
    ) {
        $this->filesystem           = $filesystem;
        $this->filename             = $filename;
        $this->mediaDirectoryRead   = $this->filesystem->getDirectoryRead(\Magento\Filesystem::MEDIA);
        $this->themeDirectoryRead   = $this->filesystem->getDirectoryRead(\Magento\Filesystem::THEMES);
    }

    /**
     * Returns customization absolute path
     *
     * @param \Magento\View\Design\ThemeInterface $theme
     * @return string|null
     */
    public function getCustomizationPath(\Magento\View\Design\ThemeInterface $theme)
    {
        $path = null;
        if ($theme->getId()) {
            $path = $this->mediaDirectoryRead->getAbsolutePath(self::DIR_NAME . '/' . $theme->getId());
        }
        return $path;
    }

    /**
     * Get directory where themes files are stored
     *
     * @param \Magento\View\Design\ThemeInterface $theme
     * @return string|null
     */
    public function getThemeFilesPath(\Magento\View\Design\ThemeInterface $theme)
    {
        $path = null;
        if ($theme->getFullPath()) {
            $path = $this->themeDirectoryRead->getAbsolutePath($theme->getFullPath());
        }
        return $path;
    }

    /**
     * Get path to custom view configuration file
     *
     * @param \Magento\View\Design\ThemeInterface $theme
     * @return string|null
     */
    public function getCustomViewConfigPath(\Magento\View\Design\ThemeInterface $theme)
    {
        $path = null;
        if ($theme->getId()) {
            $path = $this->mediaDirectoryRead
                ->getAbsolutePath(self::DIR_NAME . '/' . $theme->getId() . '/' . $this->filename);

        }
        return $path;
    }
}
