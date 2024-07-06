<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\VnUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function App\Helpers\getQuoteFromVnDb;

class LandingController extends Controller
{

    public function apiRefreshQuote(Request $request)
    {
        if (time() % 2 == 0) {
            $this->extracted();
        }
        $currentId = $request->get('id', 696969);
        $q = Quote::inRandomOrder()->where("id", '!=', $currentId)->limit(1)->get();
        $q = $this->getActualQuote($q);
        return response()->json($q);
    }

    public function apiGetQuotes(Request $request)
    {
        $page = $request->get("p", "1");
        try {
            $page = intval($page);
        } catch (\Exception) {
            $page = 1;
        }

        $pages = [1];
        $count = DB::table("quotes")->count("id");

        $maxPage = ceil($count / 10);
        if ($page > $maxPage) {
            $page = $maxPage;
        }
        for ($i = 2; $i <= $maxPage; $i++) {
            $pages[] = $i;
        }

        $rows = DB::select("SELECT * FROM quotes INNER JOIN (SELECT id FROM quotes ORDER BY quotes.vn_id LIMIT ? OFFSET ?) AS quotes2 USING (id) ORDER BY quotes.vn_id;", [
            10,
            ($page * 10) - 10
        ]);

        return response()->json([
            "ok" => true,
            "data" => [
                "rows" => [...$rows],
                "pages" => $pages,
                "count" => $count
            ],
            "error" => null
        ]);
    }

    public function index(): View
    {
        $q = Quote::inRandomOrder()->limit(1)->get();
        $q = $this->getActualQuote($q);
        return view('landing', [
            "quoteObject" => $q
        ]);

    }

    /**
     * @return bool
     */
    public function extracted(): bool
    {
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
            $check = Quote::where("vn_id", $call['data']['vn_id'])->where("quote", $call['data']['quote'])->first();
            if ($check === null) {
                Quote::insert($call['data']);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $q
     * @return Quote|mixed
     */
    public function getActualQuote($q): mixed
    {
        if (count($q) == 0) {
            $vo = $this->extracted();
            if ($vo) {
                $q = Quote::inRandomOrder()->limit(1)->get()[0];
            } else {
                $fallback = new Quote([
                    "vn_id" => 696969,
                    "quote" => "Sorry we cannot get quote from server :'("
                ]);
                $fallback->id = 696969;
                $q = $fallback;
            }
        } else {
            $q = $q->first();
        }
        return $q;
    }
}
