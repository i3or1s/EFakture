<?php

namespace Boris\EFakture\Model;

final class StatusChangeRequest
{
    public readonly ?string $requestId;
    public readonly ?string $integratorId;
    public readonly ?string $authorizationToken;
    public readonly ?Payload $payload;

    public function __construct(?string $requestId, ?string $integratorId, ?string $authorizationToken, ?Payload $payload)
    {
        $this->requestId = $requestId;
        $this->integratorId = $integratorId;
        $this->authorizationToken = $authorizationToken;
        $this->payload = $payload;
    }
}
