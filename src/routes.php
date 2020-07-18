<?php declare(strict_types=1);
return [
    [
        'GET',
        '/',
        'Vlog\FrontPage\Presentation\FrontPageController#show'
    ],
    [
        'GET',
        '/submit',
        'Vlog\Submission\Presentation\SubmissionController#show'
    ],
    [
        'POST',
        '/submit',
        'Vlog\Submission\Presentation\SubmissionController#submit'
    ]
];