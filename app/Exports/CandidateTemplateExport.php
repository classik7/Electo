<?php

namespace App\Exports;

use App\Models\Election;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CandidateTemplateExport implements
    FromArray,
    WithHeadings
{
    protected Election $election;

    public function __construct(Election $election)
    {
        $this->election = $election->load([
            'positions',
        ]);
    }

    /**
     * Spreadsheet headings.
     */
    public function headings(): array
    {
        return [
            'name',
            'position',
            'bio',
            'photo',
        ];
    }

    /**
     * Example rows.
     */
    public function array(): array
    {
        $rows = [];

        foreach ($this->election->positions as $position) {

            $rows[] = [
                '',
                $position->name,
                '',
                '',
            ];
        }

        return $rows;
    }
}