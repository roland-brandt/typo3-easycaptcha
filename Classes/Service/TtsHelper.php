<?php
declare(strict_types=1);

use ColumbusInteractive\EasyCaptcha\Service\Captcha;
use TYPO3\CMS\Core\Core\Bootstrap;
use TYPO3\CMS\Core\Core\SystemEnvironmentBuilder;

call_user_func(static function () {
    $isComposerMode = defined('TYPO3_COMPOSER_MODE') && TYPO3_COMPOSER_MODE;
    
    $isComposerMode = defined('TYPO3_COMPOSER_MODE') && TYPO3_COMPOSER_MODE;
    
    if(!$isComposerMode) {
        $classLoader = require dirname(__DIR__, 5) . '/typo3_src/vendor/autoload.php';
        SystemEnvironmentBuilder::run(5, SystemEnvironmentBuilder::REQUESTTYPE_FE);
        Bootstrap::init($classLoader);
    } else {
        $classLoader = require dirname(__DIR__, 6) . '/vendor/autoload.php';
        SystemEnvironmentBuilder::run(5, SystemEnvironmentBuilder::REQUESTTYPE_FE);
        Bootstrap::init($classLoader);
    }

    $captcha = Captcha::getInstance();

    header('Content-Type: application/json');
    echo json_encode([
        'word' => implode(' ', str_split($captcha->getCaptcha()->getWord()))
    ]);
});
