<?php

declare(strict_types=1);

try {
    throw new RuntimeException();
} catch (Error $foo) {
}
