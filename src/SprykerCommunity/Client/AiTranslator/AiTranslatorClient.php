<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;
use Generated\Shared\Transfer\AiTranslatorResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \SprykerCommunity\Client\AiTranslator\AiTranslatorFactory getFactory()
 */
class AiTranslatorClient extends AbstractClient implements AiTranslatorClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AiTranslatorResponseTransfer
     */
    public function translate(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): AiTranslatorResponseTransfer
    {
        return $this->getFactory()->createTranslator()->translate($aiTranslatorRequestTransfer);
    }
}
