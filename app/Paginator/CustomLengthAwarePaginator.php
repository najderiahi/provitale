<?php
/**
 * Created by IntelliJ IDEA.
 * User: emmanuel
 * Date: 21/11/19
 * Time: 22:18
 */

namespace App\Paginator;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Collection;

class CustomLengthAwarePaginator extends LengthAwarePaginator
{

    public function toArray()
    {
        return [
            'data' => $this->items->toArray(),
            'links' => $this->urlLinks(),
        ];
    }

    public function urlLinks($view = null, $data = [])
    {
        $window = UrlWindow::make($this);
        $elements = array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);
        return Collection::make($elements)->flatMap(function ($item) {
            if (is_array($item)) {
                return Collection::make($item)->map(function ($url, $page) {
                    return [
                        'url' => $url,
                        'label' => $page,
                        'active' => $this->currentPage() === $page,
                    ];
                });
            } else {
                return [
                    [
                        'url' => null,
                        'label' => '...',
                        'active' => false,
                    ],
                ];
            }
        })->prepend([
            'url' => $this->previousPageUrl(),
            'label' => 'Previous',
            'active' => false,
        ])->push([
            'url' => $this->nextPageUrl(),
            'label' => 'Next',
            'active' => false,
        ]);
    }
}
