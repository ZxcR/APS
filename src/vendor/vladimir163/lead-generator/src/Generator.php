<?php

namespace LeadGenerator;

use LeadGenerator\Lead;

/**
 * Class Generator
 * @package LeadGenerator
 */
class Generator
{
    /**
     * @param int $count
     * @param callable $leadHandler
     */
    public function generateLeads(int $count, callable $leadHandler): void
    {
        for($i = 1; $i <= $count; $i++) {
            $lead = new Lead();
            $lead->id = $i;
            $lead->categoryName = $this->getRandCategory();
            $leadHandler($lead);
        }
    }

    /**
     * @return string
     */
    private function getRandCategory(): string
    {
        $categories = [
            'Buy auto',
            'Buy house',
            'Get loan',
            'Cleaning',
            'Learning',
            'Car wash',
            'Repair smth',
            'Barbershop',
            'Pizza',
            'Car insurance',
            'Life insurance'
        ];

        return $categories[array_rand($categories)];
    }
}
