<?php declare(strict_types=1);

namespace Vlog\Framework\Dbal;

final class DatabaseUrl{

    private string $url;

    public function __construct(string $url){
        $this->url = $url;
    }

    public function toString():string {
        return $this->url;
    }

}
