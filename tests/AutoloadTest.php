<?php

// @phpstan-ignore-next-line
it('loads nova assertations', fn () => $this->assertContains(\NovaTesting\NovaAssertions::class, class_uses($this)));
