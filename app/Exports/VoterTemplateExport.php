<?php

namespace App\Exports;

use App\Models\Election;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoterTemplateExport implements
    FromArray,
    WithHeadings
{
    protected Election $election;

    public function __construct(Election $election)
    {
        $this->election = $election;
    }

    public function headings(): array
    {
        return [
            'name',
            'voter_id',
            'email',
            'phone',
        ];
    }

    public function array(): array
    {
        return [
            [
                'John Doe',
                'VTR-000101',
                'john@example.com',
                '08012345678',
            ],
            [
                'Jane Doe',
                'VTR-000102',
                'jane@example.com',
                '08098765432',
            ],
        ];
    }
}