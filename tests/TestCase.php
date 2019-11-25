<?php

namespace Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use PHPUnit\Framework\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        TestResponse::macro('data', function($key) {
            return $this->original->getData()[$key];
        });

        Collection::macro('assertEquals', function ($other) {
            Assert::assertCount($this->count(), $other);
            $this->zip($other)->each(function ($pair) {
                Assert::assertTrue($pair[0]->is($pair[1]));
            });
        });

        Collection::macro('assertContains', function ($other) {
            Assert::assertLessThanOrEqual($this->count(), $other->count());
            Assert::assertTrue($other->diff($this)->isEmpty());
        });
    }
}
