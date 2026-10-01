<?php

namespace i3or1s\EFakture\Exception;

/**
 * An error response from SEF. SEF answers failures with
 * {"Message": "...", "FieldName": "...", "ErrorCode": "..."}; the parsed fields are kept
 * so callers can react to the code instead of matching message text.
 * The exception code is the HTTP status.
 */
final class SefApiException extends ResourceUnavailable
{
    public function __construct(
        public readonly int $httpStatus,
        public readonly ?string $errorCode,
        public readonly ?string $fieldName,
        public readonly string $sefMessage,
        public readonly string $body,
        ?\Throwable $previous = null,
    ) {
        parent::__construct('' !== $sefMessage ? $sefMessage : sprintf('SEF responded with HTTP %d', $httpStatus), $httpStatus, $previous);
    }

    public static function fromResponse(int $httpStatus, string $body, ?\Throwable $previous = null): self
    {
        $decoded = json_decode($body, true);
        if (!is_array($decoded)) {
            return new self($httpStatus, null, null, trim(mb_substr($body, 0, 500)), $body, $previous);
        }

        $text = static fn (mixed $value): ?string => is_string($value) && '' !== $value ? $value : null;

        return new self(
            $httpStatus,
            $text($decoded['ErrorCode'] ?? null),
            $text($decoded['FieldName'] ?? null),
            (string) ($text($decoded['Message'] ?? null) ?? ''),
            $body,
            $previous
        );
    }

    /** Network trouble, SEF overload or a server fault: worth retrying later. */
    public function isTransient(): bool
    {
        return 429 === $this->httpStatus || $this->httpStatus >= 500;
    }
}
