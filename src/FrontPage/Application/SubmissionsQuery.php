<?php

namespace Vlog\FrontPage\Application;

interface SubmissionsQuery{

    /** @return Submission[]*/
    public function execute():array;
}
