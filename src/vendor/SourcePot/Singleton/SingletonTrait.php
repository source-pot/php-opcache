<?php

namespace SourcePot\Singleton;

trait SingletonTrait {
    protected static ?self $instance = null;

    public static function getInstance(): self {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}