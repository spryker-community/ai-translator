<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerCommunity\Client\AiTranslator\Translator\StorageKeyBuilder;

use Generated\Shared\Transfer\AiTranslatorRequestTransfer;

interface StorageKeyBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\AiTranslatorRequestTransfer $aiTranslatorRequestTransfer
     *
     * @return string
     */
    public function buildStorageKey(AiTranslatorRequestTransfer $aiTranslatorRequestTransfer): string;
}
