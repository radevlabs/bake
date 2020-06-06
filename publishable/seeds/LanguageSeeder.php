<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getData() as $name => $code){
            DB::table('languages')
                ->insert([
                    'id' => $code,
                    'name' => $name,
                    'created_at' => $createdAt = now(),
                    'updated_at' => $createdAt
                ]);
        }

        DB::table('languages')
            ->whereNotIn('id', ['ar', 'de', 'en', 'es', 'hi', 'id', 'it', 'ja', 'jv', 'ko', 'la', 'ms', 'pa', 'ro', 'ru', 'sv', 'th', 'tr', 'zh'])
            ->delete();
    }

    private function getData()
    {
        return ['Afrikaans' => 'af', 'Albanian' => 'sq', 'Amharic' => 'am', 'Arabic' => 'ar', 'Armenian' => 'hy', 'Azerbaijani' => 'az', 'Basque' => 'eu', 'Belarusian' => 'be', 'Bengali' => 'bn', 'Bosnian' => 'bs', 'Bulgarian' => 'bg', 'Catalan' => 'ca', 'Cebuano' => 'ceb', 'Chinese (Simplified)' => 'zh', 'Corsican' => 'co', 'Croatian' => 'hr', 'Czech' => 'cs', 'Danish' => 'da', 'Dutch' => 'nl', 'English' => 'en', 'Esperanto' => 'eo', 'Estonian' => 'et', 'Finnish' => 'fi', 'French' => 'fr', 'Frisian' => 'fy', 'Galician' => 'gl', 'Georgian' => 'ka', 'German' => 'de', 'Greek' => 'el', 'Gujarati' => 'gu', 'Haitian Creole' => 'ht', 'Hausa' => 'ha', 'Hawaiian' => 'haw', 'Hebrew' => 'he', 'Hindi' => 'hi', 'Hmong' => 'hmn', 'Hungarian' => 'hu', 'Icelandic' => 'is', 'Igbo' => 'ig', 'Indonesian' => 'id', 'Irish' => 'ga', 'Italian' => 'it', 'Japanese' => 'ja', 'Javanese' => 'jv', 'Kannada' => 'kn', 'Kazakh' => 'kk', 'Khmer' => 'km', 'Korean' => 'ko', 'Kurdish' => 'ku', 'Kyrgyz' => 'ky', 'Lao' => 'lo', 'Latin' => 'la', 'Latvian' => 'lv', 'Lithuanian' => 'lt', 'Luxembourgish' => 'lb', 'Macedonian' => 'mk', 'Malagasy' => 'mg', 'Malay' => 'ms', 'Malayalam' => 'ml', 'Maltese' => 'mt', 'Maori' => 'mi', 'Marathi' => 'mr', 'Mongolian' => 'mn', 'Myanmar (Burmese)' => 'my', 'Nepali' => 'ne', 'Norwegian' => 'no', 'Nyanja (Chichewa)' => 'ny', 'Pashto' => 'ps', 'Persian' => 'fa', 'Polish' => 'pl', 'Portuguese (Portugal & Brazil)' => 'pt', 'Punjabi' => 'pa', 'Romanian' => 'ro', 'Russian' => 'ru', 'Samoan' => 'sm', 'Scots Gaelic' => 'gd', 'Serbian' => 'sr', 'Sesotho' => 'st', 'Shona' => 'sn', 'Sindhi' => 'sd', 'Sinhala (Sinhalese)' => 'si', 'Slovak' => 'sk', 'Slovenian' => 'sl', 'Somali' => 'so', 'Spanish' => 'es', 'Sundanese' => 'su', 'Swahili' => 'sw', 'Swedish' => 'sv', 'Tagalog (Filipino)' => 'tl', 'Tajik' => 'tg', 'Tamil' => 'ta', 'Telugu' => 'te', 'Thai' => 'th', 'Turkish' => 'tr', 'Ukrainian' => 'uk', 'Urdu' => 'ur', 'Uzbek' => 'uz', 'Vietnamese' => 'vi', 'Welsh' => 'cy', 'Xhosa' => 'xh', 'Yiddish' => 'yi', 'Yoruba' => 'yo', 'Zulu' => 'zu'];
    }
}
