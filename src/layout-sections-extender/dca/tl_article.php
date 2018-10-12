<?php

/**
 * Contao Open Source CMS
 *
 * @package   qfLayoutSectionsExtender
 * @author    Enrico Schiller
 * @license   GPL-3.0+
 * @copyright querformat GmbH & Co. KG
 *
 * https://github.com/querformat/contao-layout-sections-extender
 */

$GLOBALS['TL_DCA']['tl_article']['fields']['inColumn']['options_callback'] = array('tl_article_qf', 'addCustomLayoutSectionsHook');

class tl_article_qf extends tl_article
{
    /**
     * Costum Column Hack
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function addCustomLayoutSectionsHook(DataContainer $dc)
    {
        $arrSections = $this->getActiveLayoutSections($dc);
        if (isset($GLOBALS['TL_HOOKS']['addLayoutSections']) && is_array($GLOBALS['TL_HOOKS']['addLayoutSections'])) {
            foreach ($GLOBALS['TL_HOOKS']['addLayoutSections'] as $arrCustomSections) {
                if (is_array($arrCustomSections) && count($arrCustomSections) > 0) {
                    foreach ($arrCustomSections as $k => $v) {
                        if (empty($v))
                            $arrCustomSections[$k] = $k;
                    }
                    $arrSections = array_merge($arrSections, $arrCustomSections);
                }
            }
        }
        return $arrSections;
    }
}