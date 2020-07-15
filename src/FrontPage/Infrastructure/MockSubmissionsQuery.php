<?php

namespace Vlog\FrontPage\Infrastructure;

use Vlog\FrontPage\Application\Submission;
use Vlog\FrontPage\Application\SubmissionsQuery;

final class MockSubmissionsQuery implements SubmissionsQuery {

    private array $submissions;

    public function __construct(){

        $this->submissions = [
            new Submission('https//google.com','google'),
            new Submission('https//yandex.ru','yandex'),
        ];

    }

    public function execute ():array {
        return $this->submissions;
    }

}
