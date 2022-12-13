<?php

namespace i3or1s\EFakture\Model;

final class ValueAddedTaxExemptionReasonDto implements SEFStorageInterface
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

    /**
     * @return array{reasonId: int, key: ?string, law: ?string, article: int, paragraph: int, text: ?string, freeFormNote: ?string, activeFrom: string, activeTo: ?string, category: ?string}
     */
    public function jsonSerialize(): array
    {
        return [
            'reasonId' => $this->reasonId,
            'key' => $this->key,
            'law' => $this->law,
            'article' => $this->article,
            'paragraph' => $this->paragraph,
            'text' => $this->text,
            'freeFormNote' => $this->freeFormNote,
            'activeFrom' => $this->activeFrom->format('Y-m-d'),
            'activeTo' => $this->activeTo?->format('Y-m-d'),
            'category' => $this->category,
        ];
    }
}
