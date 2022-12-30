<?php

class Offer
{
    private int $id;
    private string $title;
    private string $company;
    private string $localization;
    private int $salary;
    private string $requirements;
    private string $details;
    private string $contact;

    public function __construct(string $title,
                                string $company,
                                string $localization,
                                float $salary,
                                string $requirements,
                                string $details,
                                string $contact,
                                int $id = 0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->company = $company;
        $this->localization = $localization;
        $this->salary = $salary;
        $this->requirements = $requirements;
        $this->details = $details;
        $this->contact = $contact;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getCompany(): string
    {
        return $this->company;
    }
    public function getLocalization(): string
    {
        return $this->localization;
    }
    public function getSalary(): float
    {
        return $this->salary;
    }
    public function getRequirements(): string
    {
        return $this->requirements;
    }
    public function getDetails(): string
    {
        return $this->details;
    }

    public function getContact(): string {
        return $this->contact;
    }

}