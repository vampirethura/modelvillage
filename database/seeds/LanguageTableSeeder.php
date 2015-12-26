<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();

        DB::table('languages')->insert(array('language_name' => 'English', 'language_code' => 'en'));
        DB::table('languages')->insert(array('language_name' => 'German', 'language_code' => 'de'));
        DB::table('languages')->insert(array('language_name' => 'French', 'language_code' => 'fr'));
        DB::table('languages')->insert(array('language_name' => 'Dutch', 'language_code' => 'nl'));
        DB::table('languages')->insert(array('language_name' => 'Italian', 'language_code' => 'it'));
        DB::table('languages')->insert(array('language_name' => 'Spanish', 'language_code' => 'es'));
        DB::table('languages')->insert(array('language_name' => 'Polish', 'language_code' => 'pl'));
        DB::table('languages')->insert(array('language_name' => 'Russian', 'language_code' => 'ru'));
        DB::table('languages')->insert(array('language_name' => 'Japanese', 'language_code' => 'ja'));
        DB::table('languages')->insert(array('language_name' => 'Portuguese', 'language_code' => 'pt'));
        DB::table('languages')->insert(array('language_name' => 'Swedish', 'language_code' => 'sv'));
        DB::table('languages')->insert(array('language_name' => 'Chinese', 'language_code' => 'zh'));
        DB::table('languages')->insert(array('language_name' => 'Catalan', 'language_code' => 'ca'));
        DB::table('languages')->insert(array('language_name' => 'Ukrainian', 'language_code' => 'uk'));
        DB::table('languages')->insert(array('language_name' => 'Norwegian (Bokmål)', 'language_code' => 'no'));
        DB::table('languages')->insert(array('language_name' => 'Finnish', 'language_code' => 'fi'));
        DB::table('languages')->insert(array('language_name' => 'Vietnamese', 'language_code' => 'vi'));
        DB::table('languages')->insert(array('language_name' => 'Czech', 'language_code' => 'cs'));
        DB::table('languages')->insert(array('language_name' => 'Hungarian', 'language_code' => 'hu'));
        DB::table('languages')->insert(array('language_name' => 'Korean', 'language_code' => 'ko'));
        DB::table('languages')->insert(array('language_name' => 'Indonesian', 'language_code' => 'id'));
        DB::table('languages')->insert(array('language_name' => 'Turkish', 'language_code' => 'tr'));
        DB::table('languages')->insert(array('language_name' => 'Romanian', 'language_code' => 'ro'));
        DB::table('languages')->insert(array('language_name' => 'Persian', 'language_code' => 'fa'));
        DB::table('languages')->insert(array('language_name' => 'Arabic', 'language_code' => 'ar'));
        DB::table('languages')->insert(array('language_name' => 'Danish', 'language_code' => 'da'));
        DB::table('languages')->insert(array('language_name' => 'Esperanto', 'language_code' => 'eo'));
        DB::table('languages')->insert(array('language_name' => 'Serbian', 'language_code' => 'sr'));
        DB::table('languages')->insert(array('language_name' => 'Lithuanian', 'language_code' => 'lt'));
        DB::table('languages')->insert(array('language_name' => 'Slovak', 'language_code' => 'sk'));
        DB::table('languages')->insert(array('language_name' => 'Malay', 'language_code' => 'ms'));
        DB::table('languages')->insert(array('language_name' => 'Hebrew', 'language_code' => 'he'));
        DB::table('languages')->insert(array('language_name' => 'Bulgarian', 'language_code' => 'bg'));
        DB::table('languages')->insert(array('language_name' => 'Slovenian', 'language_code' => 'sl'));
        DB::table('languages')->insert(array('language_name' => 'Volapük', 'language_code' => 'vo'));
        DB::table('languages')->insert(array('language_name' => 'Kazakh', 'language_code' => 'kk'));
        DB::table('languages')->insert(array('language_name' => 'Waray-Waray', 'language_code' => 'war'));
        DB::table('languages')->insert(array('language_name' => 'Basque', 'language_code' => 'eu'));
        DB::table('languages')->insert(array('language_name' => 'Croatian', 'language_code' => 'hr'));
        DB::table('languages')->insert(array('language_name' => 'Hindi', 'language_code' => 'hi'));
        DB::table('languages')->insert(array('language_name' => 'Estonian', 'language_code' => 'et'));
        DB::table('languages')->insert(array('language_name' => 'Azerbaijani', 'language_code' => 'az'));
        DB::table('languages')->insert(array('language_name' => 'Galician', 'language_code' => 'gl'));
        DB::table('languages')->insert(array('language_name' => 'Simple English', 'language_code' => 'simple'));
        DB::table('languages')->insert(array('language_name' => 'Norwegian (Nynorsk)', 'language_code' => 'nn'));
        DB::table('languages')->insert(array('language_name' => 'Thai', 'language_code' => 'th'));
        DB::table('languages')->insert(array('language_name' => 'Newar / Nepal Bhasa', 'language_code' => 'new'));
        DB::table('languages')->insert(array('language_name' => 'Greek', 'language_code' => 'el'));
        DB::table('languages')->insert(array('language_name' => 'Aromanian', 'language_code' => 'roa-rup'));
        DB::table('languages')->insert(array('language_name' => 'Latin', 'language_code' => 'la'));
        DB::table('languages')->insert(array('language_name' => 'Occitan', 'language_code' => 'oc'));
        DB::table('languages')->insert(array('language_name' => 'Tagalog', 'language_code' => 'tl'));
        DB::table('languages')->insert(array('language_name' => 'Haitian', 'language_code' => 'ht'));
        DB::table('languages')->insert(array('language_name' => 'Macedonian', 'language_code' => 'mk'));
        DB::table('languages')->insert(array('language_name' => 'Georgian', 'language_code' => 'ka'));
        DB::table('languages')->insert(array('language_name' => 'Serbo-Croatian', 'language_code' => 'sh'));
        DB::table('languages')->insert(array('language_name' => 'Telugu', 'language_code' => 'te'));
        DB::table('languages')->insert(array('language_name' => 'Piedmontese', 'language_code' => 'pms'));
        DB::table('languages')->insert(array('language_name' => 'Cebuano', 'language_code' => 'ceb'));
        DB::table('languages')->insert(array('language_name' => 'Tamil', 'language_code' => 'ta'));
        DB::table('languages')->insert(array('language_name' => 'Belarusian (Taraškievica)', 'language_code' => 'be-x-old'));
        DB::table('languages')->insert(array('language_name' => 'Breton', 'language_code' => 'br'));
        DB::table('languages')->insert(array('language_name' => 'Latvian', 'language_code' => 'lv'));
        DB::table('languages')->insert(array('language_name' => 'Javanese', 'language_code' => 'jv'));
        DB::table('languages')->insert(array('language_name' => 'Albanian', 'language_code' => 'sq'));
        DB::table('languages')->insert(array('language_name' => 'Belarusian', 'language_code' => 'be'));
        DB::table('languages')->insert(array('language_name' => 'Marathi', 'language_code' => 'mr'));
        DB::table('languages')->insert(array('language_name' => 'Welsh', 'language_code' => 'cy'));
        DB::table('languages')->insert(array('language_name' => 'Luxembourgish', 'language_code' => 'lb'));
        DB::table('languages')->insert(array('language_name' => 'Icelandic', 'language_code' => 'is'));
        DB::table('languages')->insert(array('language_name' => 'Bosnian', 'language_code' => 'bs'));
        DB::table('languages')->insert(array('language_name' => 'Yoruba', 'language_code' => 'yo'));
        DB::table('languages')->insert(array('language_name' => 'Malagasy', 'language_code' => 'mg'));
        DB::table('languages')->insert(array('language_name' => 'Aragonese', 'language_code' => 'an'));
        DB::table('languages')->insert(array('language_name' => 'Bishnupriya Manipuri', 'language_code' => 'bpy'));
        DB::table('languages')->insert(array('language_name' => 'Lombard', 'language_code' => 'lmo'));
        DB::table('languages')->insert(array('language_name' => 'West Frisian', 'language_code' => 'fy'));
        DB::table('languages')->insert(array('language_name' => 'Bengali', 'language_code' => 'bn'));
        DB::table('languages')->insert(array('language_name' => 'Ido', 'language_code' => 'io'));
        DB::table('languages')->insert(array('language_name' => 'Swahili', 'language_code' => 'sw'));
        DB::table('languages')->insert(array('language_name' => 'Gujarati', 'language_code' => 'gu'));
        DB::table('languages')->insert(array('language_name' => 'Malayalam', 'language_code' => 'ml'));
        DB::table('languages')->insert(array('language_name' => 'Western Panjabi', 'language_code' => 'pnb'));
        DB::table('languages')->insert(array('language_name' => 'Afrikaans', 'language_code' => 'af'));
        DB::table('languages')->insert(array('language_name' => 'Low Saxon', 'language_code' => 'nds'));
        DB::table('languages')->insert(array('language_name' => 'Sicilian', 'language_code' => 'scn'));
        DB::table('languages')->insert(array('language_name' => 'Urdu', 'language_code' => 'ur'));
        DB::table('languages')->insert(array('language_name' => 'Kurdish', 'language_code' => 'ku'));
        DB::table('languages')->insert(array('language_name' => 'Cantonese', 'language_code' => 'zh-yue'));
        DB::table('languages')->insert(array('language_name' => 'Armenian', 'language_code' => 'hy'));
        DB::table('languages')->insert(array('language_name' => 'Quechua', 'language_code' => 'qu'));
        DB::table('languages')->insert(array('language_name' => 'Sundanese', 'language_code' => 'su'));
        DB::table('languages')->insert(array('language_name' => 'Nepali', 'language_code' => 'ne'));
        DB::table('languages')->insert(array('language_name' => 'Zazaki', 'language_code' => 'diq'));
        DB::table('languages')->insert(array('language_name' => 'Asturian', 'language_code' => 'ast'));
        DB::table('languages')->insert(array('language_name' => 'Tatar', 'language_code' => 'tt'));
        DB::table('languages')->insert(array('language_name' => 'Neapolitan', 'language_code' => 'nap'));
        DB::table('languages')->insert(array('language_name' => 'Irish', 'language_code' => 'ga'));
        DB::table('languages')->insert(array('language_name' => 'Chuvash', 'language_code' => 'cv'));
        DB::table('languages')->insert(array('language_name' => 'Samogitian', 'language_code' => 'bat-smg'));
        DB::table('languages')->insert(array('language_name' => 'Walloon', 'language_code' => 'wa'));
        DB::table('languages')->insert(array('language_name' => 'Amharic', 'language_code' => 'am'));
        DB::table('languages')->insert(array('language_name' => 'Kannada', 'language_code' => 'kn'));
        DB::table('languages')->insert(array('language_name' => 'Alemannic', 'language_code' => 'als'));
        DB::table('languages')->insert(array('language_name' => 'Buginese', 'language_code' => 'bug'));
        DB::table('languages')->insert(array('language_name' => 'Burmese', 'language_code' => 'my'));
        DB::table('languages')->insert(array('language_name' => 'Interlingua', 'language_code' => 'ia'));
    }
}
