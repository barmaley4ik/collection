<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Stichoza\GoogleTranslate\GoogleTranslate;
//use JoggApp\GoogleTranslate\GoogleTranslate;
class Translation extends Controller
{
    protected $maxLenght = 4900;
    protected $sp = [
        ['false' => '</ ', 'true' => '</'],
        ['false' => '< / ', 'true' => '</'],
        ['false' => '& ', 'true' => '&'],
        ['false' => '# ', 'true' => '#'],
        ['false' => '&Nbsp;', 'true' => '&nbsp;'],
        ['false' => '&Ldquo; ', 'true' => '&ldquo;'],
        ['false' => '&Rdquo; ', 'true' => '&rdquo;'],
        ['false' => '&Bdquo; ', 'true' => '&bdquo;'],
        ['false' => '&Gt; ', 'true' => '&gt;'],
        ['false' => '&Laquo; ', 'true' => '&laquo;'],
        ['false' => '&Raquo; ', 'true' => '&raquo;'],
        ['false' => '&Ndash; ', 'true' => '&ndash;'],
        ['false' => '&Mdash; ', 'true' => '&mdash;'],
        ['false' => '&nbsp;', 'true' => ' '],
        ['false' => '&mdash;', 'true' => '—'],
        ['false' => '&quot;', 'true' => '"'],
        ['false' => '&lt;/ p&gt;', 'true' => '</p>'],
        ['false' => '&lt;Р&gt;', 'true' => '<p>'],
        ['false' => '&lt;сильный&gt;', 'true' => '<strong>'],

    ];
    protected $sp2 = [
        ['false' => '&nbsp;', 'true' => ' '],
        ['false' => '&laquo;', 'true' => '“'],
        ['false' => '&raquo;', 'true' => '”'],
        ['false' => '&amp;', 'true' => '&'],
        ['false' => '&quot;', 'true' => '"'],
        ['false' => '&mdash;', 'true' => '—'],
        ['false' => '&ndash;', 'true' => '–'],
        ['false' => '&quot;', 'true' => '"'],
        ['false' => '&lt;', 'true' => '<'],
        ['false' => '&gt;', 'true' => '>'],
    ];
    protected $translate = '';
    protected $arrayToTranslate = [];

    public function index(Request $request)
    {
    	($request->defaultLang == 'ua') ? $defaultLang = 'uk' : $defaultLang = $request->defaultLang;
    	($request->currentLang == 'ua') ? $currentLang = 'uk' : $currentLang = $request->currentLang;
    	$translate = '';
/*     	$tr = new GoogleTranslate();
        $tr->setSource($defaultLang)->setTarget($currentLang)->setOptions(['timeout' => '10']); */
       // dd(GoogleTranslate::translate('Привет мир First Item', 'en', 'html'));
        if(strlen($request->textTranslate) > $this->maxLenght) {
            $text = $this->spRepeat2($request->textTranslate, $this->sp2);
            $optimalLenght = $this->calcMax($text, $this->maxLenght);
            $textArray = $this->longTextToArray($text, $optimalLenght, strlen($text));
            foreach ($textArray as $string) {
                // dd($text2);
                try {
                    $arrayTrans = \GoogleTranslate::translate($string, $currentLang);
                    $translate .= $arrayTrans['translated_text'];//$tr->translate($string);
                } catch (\Exception $e){
                    dd($translate, $e);
                }
            }
        } else {
            $forTranslate = $this->spRepeat($request->textTranslate);
            $arrayTrans = \GoogleTranslate::translate($forTranslate, $currentLang);
            $translate = $arrayTrans['translated_text'];
        }
    	return response()->json(ucfirst($this->spRepeat($translate)));
    }

    protected function spRepeat2($string, $sp)
    {
		
        $text = $string;
        foreach ($sp as $item) {
            $text = str_ireplace($item['false'], strtolower($item['true']), $text);
        }
        return $text;
    }
    protected function spRepeat($string)
    {
		$sp = [
				['false' => '</ ', 'true' => '</'],
				['false' => '< / ', 'true' => '</'],
				['false' => '& ', 'true' => '&'],
				['false' => '# ', 'true' => '#'],
				['false' => '&Nbsp;', 'true' => '&nbsp;'],
				['false' => '&Ldquo; ', 'true' => '&ldquo;'],
				['false' => '&Rdquo; ', 'true' => '&rdquo;'],
				['false' => '&Bdquo; ', 'true' => '&bdquo;'],
				['false' => '&Gt; ', 'true' => '&gt;'],
				['false' => '&Laquo; ', 'true' => '&laquo;'],
				['false' => '&Raquo; ', 'true' => '&raquo;'],
				['false' => '&Ndash; ', 'true' => '&ndash;'],
				['false' => '&Mdash; ', 'true' => '&mdash;'],
				['false' => '&nbsp;', 'true' => ' '],
				['false' => '&mdash;', 'true' => '-'],
				['false' => '&ndash;', 'true' => '-'],
				['false' => '&hellip;', 'true' => ' ...'],
                ['false' => '&quot;', 'true' => '"'],
                ['false' => '&lt;/ p&gt;', 'true' => '</p>'],
                ['false' => '&lt;Р&gt;', 'true' => '<p>'],
                ['false' => '&lt;сильный&gt;', 'true' => '<strong>'],
                ['false' => '<сильный>', 'true' => '<strong>'],
                ['false' => '&lt;/STRONG&gt;', 'true' => '</strong>'],
                ['false' => '</STRONG>', 'true' => '</strong>'],
                ['false' => '&lt;/čega', 'true' => '</strong>'],
                ['false' => '</čega', 'true' => '</strong>'],
                ['false' => '<bilje', 'true' => '<strong>'],
			];		
        $text = $string;
        foreach ($sp as $item) {
            $text = str_ireplace($item['false'], strtolower($item['true']), $text);
        }
        return $text;
    }

    protected function calcMax($string, $max){
        $first = substr($string, 0, $max);
        if(substr($first, -1) != ' ') {
            $max = $max - 1;
            return $this->calcMax($string, $max);
        } else {
            return $max;
        }
    }

    protected function longTextToArray($string, $lenght, $stringLenght)
    {
        $firstString = substr($string, 0, $lenght);
        $this->arrayToTranslate[] = mb_convert_encoding($firstString, 'UTF-8');
        $secondString = substr($string, $lenght, $stringLenght);
        $secondString = mb_convert_encoding($secondString, 'UTF-8');
        $secondStringLenght = strlen($secondString);
        if($secondStringLenght > $this->maxLenght){
            return $this->longTextToArray($secondString, $this->maxLenght, $secondStringLenght);
        } else {
            $this->arrayToTranslate[] = $secondString;
            return $this->arrayToTranslate;
        }
    }
}
