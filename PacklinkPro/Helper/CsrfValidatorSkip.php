<?php

namespace Packlink\PacklinkPro\Helper;

/**
 * Class CsrfValidatorSkip
 *
 * @package Packlink\PacklinkPro\Helper
 */
class CsrfValidatorSkip
{
    const WHITELISTED_ACTIONS = [
        'packlink_webhook_webhooks',
        'packlink_asyncprocess_asyncprocess',
    ];
    const PACKLINK_MODULE_NAME = 'packlink';

    /**
     * Validates csrf request.
     *
     * @param \Magento\Framework\App\Request\CsrfValidator $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\App\ActionInterface $action
     *
     * @noinspection PhpUnusedParameterInspection*/
    public function aroundValidate(
        $subject,
        \Closure $proceed,
        $request,
        $action
    ) {
        if ($request->getModuleName() === static::PACKLINK_MODULE_NAME
            && in_array($request->getFullActionName(), static::WHITELISTED_ACTIONS, true)
        ) {
            return;
        }

        $proceed($request, $action);
    }
}
