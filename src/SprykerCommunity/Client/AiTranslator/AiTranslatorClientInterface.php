<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;
use Generated\Shared\Transfer\AiTranslatorResponseTransfer;

/**
 * @method \SprykerCommunity\Client\AiTranslator\AiTranslatorFactory getFactory()
 */
interface AiTranslatorClientInterface
{
    /**
     * Specification:
     * - Translates a text from source locale to target locale.
     * - Text for translation, source and target locales are provided as properties of `AiTranslatorRequest`.
     * - Returns `AiTranslatorResponse`.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AiTranslatorResponseTransfer
     */
    public function translate(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): AiTranslatorResponseTransfer;
}
