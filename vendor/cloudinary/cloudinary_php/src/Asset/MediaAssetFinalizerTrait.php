<?php
/**
 * This file is part of the Cloudinary PHP package.
 *
 * (c) Cloudinary
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cloudinary\Asset;

use Cloudinary\ArrayUtils;
use Cloudinary\StringUtils;
use Cloudinary\Transformation\CommonTransformation;
use Cloudinary\Utils;

/**
 * Trait MediaAssetFinalizerTrait
 *
 * @property AssetDescriptor      $asset
 * @property AuthToken            $authToken
 * @property CommonTransformation $transformation
 */
trait MediaAssetFinalizerTrait
{
    /**
     * Finalizes asset transformation.
     *
     * @param string|CommonTransformation $withTransformation Additional transformation
     * @param bool                        $append             Whether to append transformation or set in instead of the
     *                                                        asset transformation
     *
     * @return string
     */
    protected function finalizeTransformation($withTransformation = null, $append = true)
    {
        if ($withTransformation === null && ! $this->urlConfig->responsiveWidth) {
            return (string)$this->transformation;
        }

        if (! $append || $this->transformation === null) {
            return (string)$withTransformation;
        }

        $resultingTransformation = clone $this->transformation;

        if ($this->urlConfig->responsiveWidth) {
            $resultingTransformation->addTransformation($this->urlConfig->responsiveWidthTransformation);
        }

        $resultingTransformation->addTransformation($withTransformation);

        return (string)$resultingTransformation;
    }

    /**
     * Sign both transformation and asset parts of the URL.
     *
     * @return string
     */
    protected function finalizeSimpleSignature()
    {
        if (! $this->urlConfig->signUrl || $this->authToken->isEnabled()) {
            return '';
        }

        $toSign    = ArrayUtils::implodeUrl([$this->transformation, $this->asset->publicId()]);
        $signature = StringUtils::base64UrlEncode(
            Utils::sign(
                $toSign,
                $this->cloud->apiSecret,
                true,
                $this->urlConfig->longUrlSignature ? Utils::ALGO_SHA256 : Utils::ALGO_SHA1
            )
        );

        return Utils::formatSimpleSignature(
            $signature,
            $this->urlConfig->longUrlSignature ? Utils::LONG_URL_SIGNATURE_LENGTH : Utils::SHORT_URL_SIGNATURE_LENGTH
        );
    }

    /**
     * Finalizes 'shorten' functionality.
     *
     * Currently only image/upload is supported.
     *
     * @param null|string $assetType The asset type to finalize.
     *
     * @return null|string The finalized asset type.
     */
    protected function finalizeShorten($assetType)
    {
        if ($this->urlConfig->shorten
            && $this->asset->deliveryType === DeliveryType::UPLOAD
            && $this->asset->assetType === AssetType::IMAGE) {
            $assetType = Image::SHORTEN_ASSET_TYPE;
        }

        if ($this->urlConfig->useRootPath) {
            $assetType = null;
        }

        return $assetType;
    }
}
