<?php

/**
 * Contao Open Source CMS
 *
 * @package   qfLayoutSectionsExtender
 * @author    Enrico Schiller
 * @license   GPL-3.0+
 * @copyright querformat GmbH & Co. KG
 */

/**
 * Costum Column Hack
 */
$GLOBALS['TL_DCA']['tl_article']['fields']['inColumn']['options_callback'] = array('tl_article_qf', 'addCustomLayoutSectionsHook');

class tl_article_qf extends tl_article
{
    /**
     * add hook logic
     *
     * method awaits array of minimum one section key
     * translations should be provided by using
     * $GLOBALS['TL_LANG']['COLS']['your-col-key-name'] = translation
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function addCustomLayoutSectionsHook(DataContainer $dc)
    {
        $arrSections = $this->getActiveLayoutSections($dc);
        if (isset($GLOBALS['TL_HOOKS']['addLayoutSections']) && is_array($GLOBALS['TL_HOOKS']['addLayoutSections'])) {
            foreach ($GLOBALS['TL_HOOKS']['addLayoutSections'] as $callback) {
                if (($val = \System::importStatic($callback[0])->{$callback[1]}()) !== false) {
                    if (is_array($val) && count($val) > 0) {
                        $newSections = Backend::convertLayoutSectionIdsToAssociativeArray($val);
                        foreach ($newSections as $k => $v) {
                            if (empty($v))
                                $newSections[$k] = $k;
                        }
                        $arrSections = array_merge($arrSections, $newSections);
                    } else {
                        \System::log('"addLayoutSections" failed in method: ' . $callback[0] . '::' . $callback[1], __METHOD__, TL_ERROR);
                    }
                }
            }
        }
        return $arrSections;
    }
}