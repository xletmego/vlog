<?php declare(strict_types=1);

namespace Vlog\Framework\Csrf;

final class Token{

    private string $token;

    public function __construct(string $token){
        $this->token = $token;
    }

    public function toString(){
        return $this->token;
    }

    public static function generate():Token{
        $token = hex2bin(random_bytes(256));
        return new Token($token);
    }
}
