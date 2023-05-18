<?php

declare(strict_types=1);

namespace App\Modules\Approval\Application;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Approval\Api\Events\EntityRejected;
use Illuminate\Contracts\Events\Dispatcher;
use LogicException;

final class ApprovalFacade implements ApprovalFacadeInterface
{
    public function __construct(
        private Dispatcher $dispatcher
    ) {
    }

    public function approve(ApprovalDto $dto): bool
    {
        $this->eligible($dto) !== '' ?: throw new LogicException('Approval status is already assigned to ' . $dto->status->value);
        $this->dispatcher->dispatch(new EntityApproved($dto));
        return true;
    }

    public function reject(ApprovalDto $dto): bool
    {
        //$this->validate($dto);
        $this->dispatcher->dispatch(new EntityRejected($dto));
        return false;
    }

    public function eligible(ApprovalDto $dto): string
    {
        if (StatusEnum::DRAFT !== StatusEnum::tryFrom($dto->status->value)) {
            return 'Approval status is already assigned to ' . $dto->status->value;
        }

        return '';
    }
}
