<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlValidate;
use App\Models\LinkVisit;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function shorten(UrlValidate $request)
{
    do {
        $shortCode = Str::random(8);
    } while (ShortLink::where('short_code', $shortCode)->exists());

    $shortLink = ShortLink::create([
        'original_url' => $request->url,
        'short_code' => $shortCode,
    ]);

    $shortUrl = url("/r/$shortCode");

    return view('shortened', compact('shortUrl', 'shortCode'));
}


    public function redirect($shortCode)
    {
        $cacheKey = "shortLink:{$shortCode}";
        $cachedUrl = Cache::get($cacheKey);

        if ($cachedUrl) {
            ShortLink::where('short_code', $shortCode)->increment('visit_count');

            return redirect($cachedUrl);
        }

        $shortLink = ShortLink::where('short_code', $shortCode)->first();

        if (! $shortLink) {
            return abort(404, 'Short link not found');
        }

        Cache::put($cacheKey, $shortLink->original_url, now()->addHours(6));
        $shortLink->increment('visit_count');
        LinkVisit::create([
            'short_link_id' => $shortLink->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);

        return redirect($shortLink->original_url);
    }

    public function show(Request $request)
    {

        $shortLinks = ShortLink::query();
        if ($request->search) {
            $shortLinks->where('original_url', 'like',
                '%'.$request->search.'%')
                ->orWhere('short_code',
                    'like', '%'.$request->search.'%');
        }
        if ($request->min_visits) {
            $shortLinks->where('visit_count',
                '>=', $request->min_visits);
        }

        $result = $shortLinks->paginate(3);

        return response()->json($result);
    }
}
