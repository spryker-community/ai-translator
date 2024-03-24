<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;
use Generated\Shared\Transfer\AiTranslatorResponseTransfer;

interface TranslatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AiTranslatorResponseTransfer
     */
    public function translate(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): AiTranslatorResponseTransfer;
}
