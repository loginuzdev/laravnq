<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\VnUrl;
use Tests\TestCase;
use function App\Helpers\getQuoteFromVnDb;
use function PHPUnit\Framework\assertTrue;

class GetQuoteTest extends TestCase
{

    public function testGetQuote(): void
    {
        for ($i = 0; $i < 40; $i++) {
            $call = getQuoteFromVnDb();
            if ($call['ok']) {
                $v = VnUrl::find($call['data']['vn_id']);
                if ($v === null) {
                    $vn = new VnUrl([
                        "id" => $call['data']['vn_id'],
                        "insert_at" => time()
                    ]);
                    $vn->save();
                }
                $call['data']['insert_at'] = time();

                //check quote
                $check = Quote::where("vn_id", $call['data']['vn_id'])->where("quote", $call['data']['quote'])->first();
                if ($check === null) {
                    Quote::insert($call['data']);
                }
            }
        }

        assertTrue(true);
    }
}
