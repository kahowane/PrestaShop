<?php
/**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class CurrencyNameByIsoCodeChoiceProvider is responsible for retrieving currency names from cldr library.
 */
final class CurrencyNameByIsoCodeChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var array
     */
    private $cldrAllCurrencies;

    /**
     * @param array $cldrAllCurrencies
     */
    public function __construct(array $cldrAllCurrencies)
    {
        $this->cldrAllCurrencies = $cldrAllCurrencies;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $result = [];
        foreach ($this->cldrAllCurrencies as $cldrCurrency) {
            $currencyNames = $cldrCurrency->getDisplayNames();
            $isoCode = $cldrCurrency->getIsoCode();
            $displayName = sprintf('%s (%s)', $currencyNames['default'], $isoCode);

            $result[$displayName] = $isoCode;
        }

        return $result;
    }
}