<?php

namespace Vlog\Framework\Csrf;

interface TokenStorage{
    public function store (string $key, Token $token);
    public function retrieve(string $key): ?Token;
}
