<?php

namespace App\Http\Controllers;
use Pest\Support\Str;
use Illuminate\Http\Request;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
     public function shorten(Request $request)
{ $request->validate([
    'url' => 'required|url|active_url'
    ]);
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
   
    public function redirect($shortCode)
    {
        $shortLink = ShortLink::where('short_code', $shortCode)->first();
    
        if (!$shortLink) {
        return abort(404, 'Short link not found');
        }
        $shortLink->increment('visit_count');
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