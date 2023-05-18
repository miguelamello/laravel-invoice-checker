<?php

declare(strict_types=1);

namespace App\Modules\Approval\Api\Events;

use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Models\Invoices;

final class EntityApproved
{
    public function __construct(
        public ApprovalDto $approvalDto
    ) {
        Handle();
    }

    private function Handle()
    {
        echo $approvalDto
    }
}