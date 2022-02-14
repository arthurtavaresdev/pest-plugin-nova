<?php

declare(strict_types=1);

namespace ArthurTavaresDev\PestPluginNova;

use Pest\Plugin;

// @codeCoverageIgnoreStart
Plugin::uses(NovaAssertions::class);
// @codeCoverageIgnoreEnd

require_once 'NovaExpectations.php';
