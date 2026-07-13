<?php

declare(strict_types=1);

// Shared setup for the manual SEF test scripts in this folder.
// Run scripts directly, e.g.: php tests/send_invoice_test.php

require_once __DIR__.'/../vendor/autoload.php';

/**
 * Loads a simple KEY=VALUE file into the environment.
 * Existing environment values are never overwritten, so .env.local
 * (loaded second) takes priority over .env, and real shell env vars
 * take priority over both.
 */
function loadEnvFile(string $path): void
{
    if (!is_file($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ('' === $line || str_starts_with($line, '#')) {
            continue;
        }

        [$name, $value] = array_pad(explode('=', $line, 2), 2, '');
        $name = trim($name);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        $existing = getenv($name);
        if ('' === $name || (false !== $existing && '' !== $existing)) {
            continue;
        }

        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
    }
}

loadEnvFile(__DIR__.'/.env.local');
loadEnvFile(__DIR__.'/.env');

/**
 * @return array<string, string|null|int>
 */
function sefTestConfig(): array
{
    $get = static fn (string $name): ?string => '' !== ($value = (string) getenv($name)) ? $value : null;

    return [
        'apiKey' => $get('SEF_API_KEY'),
        'rootUri' => $get('SEF_ROOT_URI') ?? 'https://demoefaktura.mfin.gov.rs/',

        'sellerPib' => $get('SEF_SELLER_PIB'),
        'sellerName' => $get('SEF_SELLER_NAME'),
        'sellerCity' => $get('SEF_SELLER_CITY'),
        'sellerIdentification' => $get('SEF_SELLER_IDENTIFICATION'),
        'sellerEmail' => $get('SEF_SELLER_EMAIL'),
        'sellerBankAccount' => $get('SEF_SELLER_BANK_ACCOUNT'),

        'buyerPib' => $get('SEF_BUYER_PIB'),
        'buyerName' => $get('SEF_BUYER_NAME'),
        'buyerAddress' => $get('SEF_BUYER_ADDRESS'),
        'buyerCity' => $get('SEF_BUYER_CITY'),
        'buyerIdentification' => $get('SEF_BUYER_IDENTIFICATION'),
        'buyerEmail' => $get('SEF_BUYER_EMAIL'),

        'contractNumber' => $get('SEF_CONTRACT_NUMBER'),

        'pullDirection' => $get('SEF_PULL_DIRECTION') ?? 'Outbound',
        'pullStatus' => $get('SEF_PULL_STATUS'),
        'pullDateFrom' => $get('SEF_PULL_DATE_FROM'),
        'pullDateTo' => $get('SEF_PULL_DATE_TO'),
        'pullLimit' => (int) ($get('SEF_PULL_LIMIT') ?? '5'),
    ];
}

/**
 * Exits with an error message if any of the given config keys are missing.
 *
 * @param array<string, string|null|int> $config
 * @param string[] $requiredKeys
 */
function assertConfigured(array $config, array $requiredKeys): void
{
    $missing = array_filter($requiredKeys, static fn (string $key): bool => null === ($config[$key] ?? null));

    if ([] !== $missing) {
        fwrite(STDERR, sprintf(
            "Missing required configuration: %s\nCopy tests/.env to tests/.env.local and fill in the values.\n",
            implode(', ', $missing)
        ));
        exit(1);
    }
}
