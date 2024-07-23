<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ContactsImport implements ToModel, WithHeadingRow, 
// WithBatchInserts,
    WithChunkReading, ShouldQueue, WithValidation, SkipsEmptyRows
{
    use SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'id'        => (string) Str::orderedUuid(),
            'username'  => $row['username'] ?? $row[0],
            'email'     => $row['email'] ?? $row[1],
        ]);
    }

    // public function batchSize(): int
    // {
    //     return 100;
    // }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
             '*.username' => [
                'required',
                'min:3',
                'max:255'
            ],
             '*.email' => [
                'required',
                'email',
                'distinct',
                Rule::unique(Contact::class, 'email'),
             ],
        ];
    }
}
