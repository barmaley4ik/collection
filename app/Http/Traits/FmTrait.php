<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Facades\Request;
trait FmTrait {



    public function getFolders($directory = 'public')
    {
        $directories = Storage::directories($directory);
        $new_d = [];
        $i=0;
        foreach ($directories as &$value) {
            while(Str::contains($value, '/'))
            {
                $value = Str::after($value, '/');
            }
            $new_d[$i]['name'] = $value;
            $new_d[$i]['type'] = 'folder';
            $i++;
        }

        return $new_d;
    }    

    public function getFiles($directory = 'public')
    {
        $allowedFiles = array('png', 'gif', 'jpg', 'bmp','jpeg', 'ico');
        $files = Storage::files($directory);
        $new_f = [];
        $i=0;
        foreach ($files as &$value) {

            if (preg_match('/\.('.implode('|', $allowedFiles).')$/', $value)) {
                $tempValue= $value;
                $tempValue = Str::replaceFirst('public','/storage',$tempValue);
                $new_f[$i]['path'] = $tempValue;
                while(Str::contains($value, '/'))
                {
                    $value = Str::after($value, '/');
                }
                $new_f[$i]['name'] = $value;
                $new_f[$i]['type'] = 'file';
                $i++;
            }            
        }

        return $new_f;
    }

    public function links($view = null, $data = [], $request, $pagination)
    {
        $this->appends($request->all());

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
            'label' => 'Назад',
            'active' => false,
        ])->push([
            'url' => $this->nextPageUrl(),
            'label' => 'Вперед',
            'active' => false,
        ]);
    }
}