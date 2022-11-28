<?php

namespace Boris\EFakture\Model;

final class ValueAddedTaxExemptionReasonDto
{
    public readonly int $reasonId;
    public readonly ?string $key;
    public readonly ?string $law;
    public readonly int $article;
    public readonly int $paragraph;
    public readonly ?string $text;
    public readonly ?string $freeFormNote;
    public readonly \DateTimeImmutable $activeFrom;
    public readonly ?\DateTimeImmutable $activeTo;
    public readonly ?string $category;

    public function __construct(int $reasonId, ?string $key, ?string $law, int $article, int $paragraph, ?string $text, ?string $freeFormNote, \DateTimeImmutable $activeFrom, ?\DateTimeImmutable $activeTo, ?string $category)
    {
        $this->reasonId = $reasonId;
        $this->key = $key;
        $this->law = $law;
        $this->article = $article;
        $this->paragraph = $paragraph;
        $this->text = $text;
        $this->freeFormNote = $freeFormNote;
        $this->activeFrom = $activeFrom;
        $this->activeTo = $activeTo;
        $this->category = $category;
    }
}
