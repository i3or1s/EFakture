<?php

namespace i3or1s\EFakture\Model;

final class CompanySettingsDto
{
    public readonly ?string $homeRoute;
    public readonly ?SspModules $modules;

    public function __construct(?string $homeRoute, ?SspModules $modules)
    {
        $this->homeRoute = $homeRoute;
        $this->modules = $modules;
    }
}
