<?php

namespace App\Http\Controllers;

use App\Http\Requests\Url_validate;
use Pest\Support\Str;
use Illuminate\Http\Request;
use App\Models\ShortLink;
use App\Models\LinkVisit;
//use Symfony\Component\HttpKernel\Attribute\Cache;
use Illuminate\Support\Facades\Cache;

class ShortLinkController extends Controller
{
     public function shorten(Url_validate $request)
{ 
    do { $shortCode = Str::random(8);
    } while (
        ShortLink::where('short_code',
         $shortCode)->exists());

    
    $shortLink = ShortLink::create([
        'original_url' => $request->url, 'short_code' => $shortCode
    ]);

    return response()->json([
  'short_code' => $shortCode,
 'short_url' => url("/r/$shortCode")
    ]);

}
public function redirect($shortCode) {
    $chach_key = "shortLink:{$shortCode}";
    $chace_url = Cache::get($chach_key);

    if ($chace_url) {
        ShortLink::where('short_code', $shortCode)->increment('visit_count');
        return redirect($chace_url);
    }

    $shortLink = ShortLink::where('short_code', $shortCode)->first();

    if (!$shortLink) {
        return abort(404, 'Short link not found');
    }

    Cache::put($chach_key, $shortLink->original_url, now()->addHours(6));
    $shortLink->increment('visit_count');
    LinkVisit::create([ 
        'short_link_id' => $shortLink->id,
         'ip_address' => request()->ip(),
         'user_agent' => request()->header('User-Agent')
         ]);
    return redirect($shortLink->original_url);
}

    public function show(Request $request)
{
   
    $shortLinks = ShortLink::query();
    if ($request->search) {
        $shortLinks->where('original_url', 'like',
         '%' . $request->search . '%')
                   ->orWhere('short_code', 
                   'like', '%' . $request->search . '%');
    }
    if ($request->min_visits) {
        $shortLinks->where('visit_count',
         '>=', $request->min_visits);
    }

    $result = $shortLinks->paginate(3);
    return response()->json($result);
}
}