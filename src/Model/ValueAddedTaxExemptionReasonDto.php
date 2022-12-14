<?php

namespace i3or1s\EFakture\Model;

final class ValueAddedTaxExemptionReasonDto implements SEFStorageInterface
{
    public readonly int $reasonId;
    public readonly ?string $key;
    public readonly ?string $law;
    public readonly ?string $article;
    public readonly ?string $paragraph;
    public readonly ?string $point;
    public readonly ?string $subpoint;
    public readonly ?string $text;
    public readonly ?string $freeFormNote;
    public readonly \DateTimeImmutable $activeFrom;
    public readonly ?\DateTimeImmutable $activeTo;
    public readonly ?string $category;

    public function __construct(int $reasonId, ?string $key, ?string $law, ?string $article, ?string $paragraph, ?string $point, ?string $subpoint, ?string $text, ?string $freeFormNote, string $activeFrom, ?string $activeTo, ?string $category)
    {
        $this->reasonId = $reasonId;
        $this->key = $key;
        $this->law = $law;
        $this->article = $article;
        $this->paragraph = $paragraph;
        $this->point = $point;
        $this->subpoint = $subpoint;
        $this->text = $text;
        $this->freeFormNote = $freeFormNote;
        $this->activeFrom = new \DateTimeImmutable($activeFrom);
        $this->activeTo = null !== $activeTo ? new \DateTimeImmutable($activeTo) : null;
        $this->category = $category;
    }

    /**
     * @return array{reasonId: int, key: ?string, law: ?string, article: ?string, paragraph: ?string, point: ?string, subpoint: ?string,  text: ?string, freeFormNote: ?string, activeFrom: string, activeTo: ?string, category: ?string}
     */
    public function jsonSerialize(): array
    {
        return [
            'reasonId' => $this->reasonId,
            'key' => $this->key,
            'law' => $this->law,
            'article' => $this->article,
            'paragraph' => $this->paragraph,
            'point' => $this->point,
            'subpoint' => $this->subpoint,
            'text' => $this->text,
            'freeFormNote' => $this->freeFormNote,
            'activeFrom' => $this->activeFrom->format('Y-m-d'),
            'activeTo' => $this->activeTo?->format('Y-m-d'),
            'category' => $this->category,
        ];
    }
}
