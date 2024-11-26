<?php


namespace App\DTO;


class CountryDTO
{
    public string $name_en;
    public string $name_ar;
    public string $description_en;
    public string $description_ar;

    public function __construct(string $name_en, string $name_ar, string $description_en, string $description_ar)
    {
        $this->name_en = $name_en;
        $this->name_ar = $name_ar;
        $this->description_en = $description_en;
        $this->description_ar = $description_ar;
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
        ];
    }

    /**
     *
     * @param array $data
     * @return CountryDTO
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name_en'] ?? '',
            $data['name_ar'] ?? '',
            $data['description_en'] ?? '',
            $data['description_ar'] ?? ''
        );
    }
}

