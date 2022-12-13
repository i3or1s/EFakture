<?php

namespace i3or1s\EFakture\Model;

final class CirTicketChangeDto
{
    public readonly int $id;
    public readonly ?string $propertyName;
    public readonly ?string $oldValue;
    public readonly ?string $newValue;
    public readonly \DateTimeImmutable $dateChanged;
    public readonly ChangeUser $user;
    public readonly int $version;
    public readonly bool $serviceDesk;

    public function __construct(int $id, ?string $propertyName, ?string $oldValue, ?string $newValue, \DateTimeImmutable $dateChanged, ChangeUser $user, int $version, bool $serviceDesk)
    {
        $this->id = $id;
        $this->propertyName = $propertyName;
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
        $this->dateChanged = $dateChanged;
        $this->user = $user;
        $this->version = $version;
        $this->serviceDesk = $serviceDesk;
    }
}
