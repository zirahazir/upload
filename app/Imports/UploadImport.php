<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class UploadImport implements ToCollection, ShouldQueue, WithChunkReading, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        DB::table('uploads')->insert($rows->map(function ($row) {
            return [
                'mobile_number' => $row['mobile_number'],
                'text1'         => $row['text1'],
                'amount'        => $row['amount'],
                'text2'         => $row['text2'],
            ];
        })->toArray());
    }

    public function chunkSize(): int
    {
        return 6000;
    }
}
