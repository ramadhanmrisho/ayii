<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class RfqReferenceGenerator
{
    public function generate(): string
    {
        $year = now()->year;
        $key = "rfq:{$year}";

        $row = DB::selectOne(
            'insert into reference_sequences ("key", "value", "created_at", "updated_at")
             values (?, 1, now(), now())
             on conflict ("key") do update set "value" = reference_sequences."value" + 1, "updated_at" = now()
             returning "value"',
            [$key]
        );

        return sprintf('AYII-RFQ-%d-%04d', $year, $row->value);
    }
}
