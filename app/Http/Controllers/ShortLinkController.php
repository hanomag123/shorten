<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortLink;
use App\Models\ShortLink;
use Illuminate\Support\Facades\Cache;
use Str;
use Inertia\Inertia;

class ShortLinkController extends Controller
{
  public function index()
  {
    return Inertia::render('Welcome', [
      'code' => '',
    ]);
  }

  public function store(StoreShortLink $request)
  {
    $data = $request->validated();

    $result = Cache::get($data['link'], false);

    if ($result) {
      return inertia('Welcome', [
        'code' => $result,
      ]);
    }

    $shortlink = ShortLink::where($data)->first();

    if (isset($shortlink)) {
      Cache::put($shortlink->link, $shortlink->code, 60);
      return inertia('Welcome', [
        'code' => $shortlink->code,
      ]);
    }

    $data['code'] = $this->getRandomString(6);
    $shortlink = ShortLink::create($data);

    return inertia('Welcome', [
      'code' => $shortlink['code'],
    ]);
  }

  public function shortLink($code)
  {
    $shortlink = ShortLink::where('code', $code)->first();
    if (isset($shortlink)) {
      return redirect($shortlink->link);
    }
  }

  private function getRandomString($number)
  {
    // Создаем рандомный код и проверяем на уникальность, если код не уникальный, то вызываем код повторно с увеличенным числом рандомных символов
    $code = Str::random($number);
    $oldLink = ShortLink::where('code', $code)->first();
    if ($oldLink === null) {
      return $code;
    } else {
      $this->getRandomString($number + 1);
    }
  }
}
