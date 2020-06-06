<?php

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;
use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

if (!function_exists('readable_datetime')) {
    /**
     * Melakukan formatting tanggal
     *
     * @param Carbon $carbon
     * @return string
     */
    function readable_datetime($datetime, $locale = null)
    {
        $format = 'dddd, MMMM Do YYYY, HH:mm:ss';
        $localeFormats = [
            'jv' => 'dddd, DD MMMM YYYY, HH:mm:ss',
            'id' => 'dddd, DD MMMM YYYY, HH:mm:ss',
            'en' => 'dddd, MMMM Do YYYY, HH:mm:ss'
        ];
        $locale = $locale ?? bakelang();
        $format = $localeFormats[$locale] ?? $format;

        return Carbon::parse($datetime)
            ->locale($locale)
            ->isoFormat($format);
    }

}

if (!function_exists('str_contains')){
    /**
     * re-init string helper laravel
     *
     * @param $haystack
     * @param $needle
     * @return bool
     */
    function str_contains($haystack, $needle){
        return Str::contains($haystack, $needle);
    }
}

if (!function_exists('upload_file')){
    /**
     * store file to storage then
     * return the path
     *
     * @param UploadedFile $file
     * @param $fileName
     * @param $folderName
     * @param bool $addUuid
     * @return string
     */
    function upload_file(UploadedFile $file, $fileName, $folderName, $addUuid = true){
        if (!Storage::exists('public/'.$folderName)){
            Storage::makeDirectory('public/'.$folderName);
        }

        $extension = $file->getClientOriginalExtension();
        if ($addUuid){
            $fileName = $fileName.'_'.uuidstr('_');
        }
        $path = $folderName.'/'.$fileName.'.'.$extension;

        $file->storeAs('public', $path);

        return 'storage/'.$path;
    }
}

if (!function_exists('upload_blob_file')){
    /**
     * store blob file to storage
     * then return the path
     *
     * @param $blob
     * @param $fileName
     * @param $folderName
     * @param bool $addUuid
     * @return string
     */
    function upload_blob_file($blob, $fileName, $folderName, $addUuid = true){
        if (!Storage::exists('public/'.$folderName)){
            Storage::makeDirectory('public/'.$folderName);
        }

        $explodes = explode('.', $fileName);
        $extension = end($explodes);
        $name = str_replace(".$extension", '', $fileName);
        if ($addUuid){
            $name = $name.'_'.uuidstr();
        }
        $path = $folderName.'/'.$name.'.'.$extension;

        Storage::put('public/'.$path, $blob);

        return 'storage/'.$path;
    }
}

if (!function_exists('delete_file')){
    /**
     * delete file
     *
     * @param $path
     */
    function delete_file($path){
        if (File::exists($path)){
            File::delete($path);
        }
    }
}

if (!function_exists('is_image')){
    /**
     * check filename is image or not
     *
     * @param $name
     * @return bool|void
     */
    function is_image($name)
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];

        $name = explode('.', $name);
        $extension = end($name);

        return in_array($extension, $imageExtensions);
    }
}

if (!function_exists('file_to_blob')) {
    /**
     * convert file to blob
     *
     * @param $path
     * @param null $extension
     * @return false|string
     */
    function file_to_blob($path){
        $contents = file_get_contents($path);
        if (is_image($path)){
            return base64_encode($contents);
        }

        return $contents;
    }
}

if (!function_exists('number_to_roman')) {
    /**
     * convert number to roman
     *
     * @param $number
     * @return string
     */
    function number_to_roman($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}

if (!function_exists('number_to_word')) {
    /**
     * readable number
     *
     * @param $number
     * @return false|string
     */
    function number_to_word($number, $locale = null)
    {
        $locale = empty($locale)
            ? bakelang()
            : $locale;

        return (new NumberFormatter($locale, NumberFormatter::SPELLOUT))
            ->format($number);
    }
}

if (!function_exists('array_to_string')) {
    /**
     * convert list to readable
     *
     * @param $array
     * @param string $splitter
     * @param string $lastSplitter
     * @return string|string[]
     */
    function array_to_string($array, $splitter = ', ', $lastSplitter = ' and ')
    {
        $string = implode($splitter, $array);
        $string = str_replace($splitter . last($array), $lastSplitter . last($array), $string);

        return $string;
    }
}

if (!function_exists('boolprint')) {
    /**
     * readable boolean
     *
     * @param $bool
     * @return mixed
     * @throws ErrorException
     */
    function boolprint($bool)
    {
        return $bool
            ? 'yes'
            : 'no';
    }
}

if (!function_exists('asset_exists')) {
    /**
     * check asset file
     *
     * @param $path
     * @return bool
     */
    function asset_exists($path)
    {
        if (empty($path)){
            return false;
        }

        return file_exists(public_path($path));
    }
}

if (!function_exists('str_singular')) {
    /**
     * re-init string helper laravel
     *
     * @param $value
     * @return string
     */
    function str_singular($value)
    {
        return Str::singular($value);
    }
}

if (!function_exists('camel_case')) {
    /**
     * re-init string helper laravel
     *
     * @param $value
     * @return string
     */
    function camel_case($value)
    {
        return Str::camel($value);
    }
}

if (!function_exists('is_current_route')){
    /**
     * check current route
     *
     * @param $routeName
     * @param bool $mustMatch
     * @return bool
     */
    function is_current_route($routeName, $mustMatch = true)
    {
        if ($mustMatch) {
            return Route::currentRouteName() == $routeName;
        }

        return Str::contains(Route::currentRouteName(), $routeName);
    }
}

if (!function_exists('scan_whole_dir')) {
    /**
     * scan directory recursively
     *
     * @param $path
     * @return \Illuminate\Support\Collection
     */
    function scan_whole_dir($path)
    {
        return collect(
            array_keys(
                iterator_to_array(
                    new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($path)
                    )
                )
            )
        );
    }
}

if (!function_exists('badge')) {
    /**
     * badge html
     *
     * @param $text
     * @param null $type
     * @return string
     */
    function badge($text, $type = null)
    {
        if (empty($type)){
            $badges = collect(['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark']);
            $type = $badges->random();
        }

        $type = 'badge-'.$type;

        return '<span class="badge '.$type.'">'.$text.'</span>';
    }
}

if (!function_exists('words_reverse')){
    /**
     * reverse words
     *
     * @param $text
     * @return string
     */
    function words_reverse($text)
    {
        return collect(explode(' ', $text))
            ->reverse()
            ->join(' ');
    }
}

if (!function_exists('builder_fields')){
    /**
     * get field names
     *
     * @param $builder
     * @param bool $fieldOnly
     * @return array|\Illuminate\Support\Collection
     */
    function builder_fields($builder, $fieldOnly = true)
    {
        $firstRow = (clone $builder)->first();
        $columns = collect($firstRow)
            ->keys()
            ->toArray();
        if (!empty($columns)){
            return $columns;
        }

        $uuid = uuidstr('_');
        $queryStatement = query_statement((clone $builder)->limit(0));
        if (env('DB_CONNECTION') == 'mysql'){
            DB::statement("create temporary table temp_$uuid as ($queryStatement)");
            $columns = collect(DB::select("show columns from temp_$uuid"));
            DB::statement("drop table temp_$uuid");

            if ($fieldOnly){
                return $columns->pluck('Field')
                    ->toArray();
            }

            return $columns;
        }

        return [];
    }
}

if (!function_exists('uuidstr')){
    /**
     * generate uuid
     *
     * @param string $delim
     * @return string|string[]
     */
    function uuidstr($delim = '-')
    {
        return str_replace('-', $delim, Str::uuid());
    }
}

if (!function_exists('bakelang')){
    /**
     * get current language
     *
     * @param null $language
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|null
     */
    function bakelang($language = null)
    {
        if (!empty($language)){
            session()->put('bakelang', $language);
        }

        if (!session()->has('bakelang')) {
            session()->put('bakelang', 'en');
        }

        $language = session('bakelang')[0];
        $language = (strlen($language) == 1) ? session('bakelang') : $language;

        return $language;
    }
}

if (!function_exists('route_name')){
    /**
     * get route name by url
     *
     * @param $url
     * @return string|null
     */
    function route_name($url){
        return Route::match([
            'get', 'post', 'delete', 'patch', 'put'
        ], $url)->getName();
    }
}

if (!function_exists('slugify')){
    /**
     * re-init string helper laravel
     *
     * @param $text
     * @return string
     */
    function slugify($text){
        return Str::slug($text);
    }
}

if (!function_exists('overview')){
    /**
     * text overview
     *
     * @param $text
     * @param int $maxAlphabet
     * @param string $addText
     * @return string
     */
    function overview($text, int $maxAlphabet = 20, $addText = ' ...'){
        if (strlen($text) <= $maxAlphabet){
            return $text;
        }

        return substr($text, 0, $maxAlphabet).$addText;
    }
}

if (!function_exists('query_statement')){
    /**
     * get query statement of builder
     *
     * @param $query
     * @param bool $dump
     * @return string
     */
    function query_statement($query, $dump = false)
    {
        $sql_str = $query->toSql();
        $bindings = $query->getBindings();

        $wrapped_str = str_replace('?', "'?'", $sql_str);

        return Str::replaceArray('?', $bindings, $wrapped_str);
    }
}

if (!function_exists('bakesetting')) {
    /**
     * wiresetting
     *
     * @param $key
     * @return |null
     */
    function bakesetting($key){
        $settings = DB::table('settings')
            ->where('id', $key)
            ->get();

        if ($settings->count() == 0){
            return null;
        }

        return $settings->first()
            ->value;
    }
}

if (!function_exists('baketranslate')){
    /**
     * translate words
     *
     * @param $sentence
     * @param $from
     * @param null $to
     * @param string $func
     * @return mixed
     * @throws ErrorException
     */
    function baketranslate($sentence, $from, $to = null, $func = null)
    {
        if (empty($to)){
            $to = bakelang();
        }

        if ($from == $to){
            return empty($func) ? $sentence : $func($sentence);
        }

        $newSentence = DB::table('dictionaries')
            ->when($from, function ($query) use ($from) {
                $query->where('from_id', $from);
            })->where('to_id', $to)
            ->where('from', $sentence)
            ->get();

        if ($newSentence->count() > 0){
            $newSentence = $newSentence->first()
                ->to;
            return $func($newSentence);
        }

        $dictionary = DB::table('dictionaries')
            ->insert([
                'from_id' => $from,
                'to_id' => $to,
                'from' => $sentence,
                'to' => null
            ]);

        return $sentence;
    }
}

if (!function_exists('form_data')){
    /**
     * manage form data
     *
     * @param $formData
     * @param bool $wholeDataToArray
     * @return array
     */
    function form_data($formData, $base64File = false, $wholeDataToArray = true)
    {
        return collect($formData)
            ->groupBy('name')
            ->map(function ($item) {
                $modified = $item->map(function ($data) {
                    $data['value'] = (empty(json_decode($data['value'])))
                        ? $data['value']
                        : json_decode($data['value']);

                    return $data;
                });

                return $modified;
            })->map(function ($item, $key) {
                if ($item->count() > 1) {
                    return $item->pluck('value')
                        ->toArray();
                } else {
                    return $item[0]['value'];
                }
            })->mapWithKeys(function ($item, $key) {
                return [str_replace('[]', '', $key) => $item];
            })->map(function ($item, $key) use ($base64File) {
                if (!($item instanceof \stdClass) and !is_array($item)) {
                    return $item;
                }

                if ($item instanceof \stdClass) {
                    return (object)[
                        'name' => $item->name,
                        'data' => $base64File
                            ? $item->data
                            : base64_decode(explode(',', $item->data, 2)[1])
                    ];
                } elseif (is_array($item)) {
                    if (!($item[0] instanceof \stdClass)) {
                        return $item;
                    }

                    $new = [];
                    foreach ($item as $data) {
                        $new[] = (object)[
                            'name' => $data->name,
                            'data' => $base64File
                                ? $data->data
                                : base64_decode(explode(',', $data->data, 2)[1])
                        ];
                    }

                    return $new;
                }

                return $item;
            })->map(function ($item) use ($wholeDataToArray) {
                if ($wholeDataToArray){
                    if ($item instanceof \stdClass){
                        return (array)$item;
                    } elseif (is_array($item)){
                        if ($item[0] instanceof \stdClass){
                            return collect($item)
                                ->map(function ($object) {
                                    return (array)$object;
                                })->toArray();
                        }

                        return $item;
                    }
                }

                return $item;
            })->toArray();
    }
}

if (!function_exists('bake')){
    function bake()
    {
        return new Radevlabs\Bake\Bake();
    }
}

if (!function_exists('ordinal')){
    function ordinal($number)
    {
        if (empty($number)) return null;

        // get first digit
        $digit = abs($number) % 10;
        $ext = 'th';
        // if the last two digits are between 4 and 21 add a th
        if(abs($number) %100 < 21 && abs($number) %100 > 4){
            $ext = 'th';
        }else{
            if($digit < 4){
                $ext = 'rd';
            }
            if($digit < 3){
                $ext = 'nd';
            }
            if($digit < 2){
                $ext = 'st';
            }
            if($digit < 1){
                $ext = 'th';
            }
        }

        return $number.$ext;
    }
}
