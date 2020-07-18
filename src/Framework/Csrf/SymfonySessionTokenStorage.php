<?php

namespace Vlog\Framework\Csrf;

use Symfony\Component\HttpFoundation\Session\Session;

class SymfonySessionTokenStorage implements TokenStorage{

    private Session $session;

    public function __construct(Session $session){
        $this->session = $session;
    }


    public function store(string $key, Token $token):void {

        $this->session->set($key, $token->toString());

    }

    public function retrieve(string $key): ?Token{
        $tokenValue = $this->session->get($key);

        if($tokenValue === null){
            return null;
        }

        return new Token($tokenValue);
    }
}
