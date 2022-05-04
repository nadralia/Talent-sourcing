<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $list = [
            0 => 
            [
                'id'          => 'AD',
                'name'        => 'Andorra',
                'code'        => 'AND',
                'currency_id' => 'EUR',
                'phone_code'  => 376,
                'timezone'    => 'Europe/Andorra',
                'enabled'     => 1,
            ],
            1 => 
            [
                'id'          => 'AE',
                'name'        => 'United Arab Emirates',
                'code'        => 'ARE',
                'currency_id' => 'AED',
                'phone_code'  => 971,
                'timezone'    => 'Asia/Dubai',
                'enabled'     => 1,
            ],
            2 => 
            [
                'id'          => 'AF',
                'name'        => 'Afghanistan',
                'code'        => 'AFG',
                'currency_id' => 'AFN',
                'phone_code'  => 93,
                'timezone'    => 'Asia/Kabul',
                'enabled'     => 1,
            ],
            3 => 
            [
                'id'          => 'AG',
                'name'        => 'Antigua and Barbuda',
                'code'        => 'ATG',
                'currency_id' => 'XCD',
                'phone_code'  => 1268,
                'timezone'    => 'America/Antigua',
                'enabled'     => 1,
            ],
            4 => 
            [
                'id'          => 'AI',
                'name'        => 'Anguilla',
                'code'        => 'AIA',
                'currency_id' => 'XCD',
                'phone_code'  => 1264,
                'timezone'    => 'America/Anguilla',
                'enabled'     => 1,
            ],
            5 => 
            [
                'id'          => 'AL',
                'name'        => 'Albania',
                'code'        => 'ALB',
                'currency_id' => 'ALL',
                'phone_code'  => 355,
                'timezone'    => 'Europe/Tirane',
                'enabled'     => 1,
            ],
            6 => 
            [
                'id'          => 'AM',
                'name'        => 'Armenia',
                'code'        => 'ARM',
                'currency_id' => 'AMD',
                'phone_code'  => 374,
                'timezone'    => 'Asia/Yerevan',
                'enabled'     => 1,
            ],
            7 => 
            [
                'id'          => 'AN',
                'name'        => 'Netherlands Antilles',
                'code'        => 'ANT',
                'currency_id' => 'ANG',
                'phone_code'  => 599,
                'timezone'    => 'America/Curacao',
                'enabled'     => 1,
                'deleted_at'  => NULL,
                'created_at'  => NULL,
                'updated_at'  => NULL,
            ],
            8 => 
            [
                'id'          => 'AO',
                'name'        => 'Angola',
                'code'        => 'AGO',
                'currency_id' => 'AOA',
                'phone_code'  => 244,
                'timezone'    => 'Africa/Luanda',
                'enabled'     => 1,
            ],
            9 => 
            [
                'id'          => 'AQ',
                'name'        => 'Antarctica',
                'code'        => 'ATA',
                'currency_id' => 'AUD',
                'phone_code'  => 672,
                'timezone'    => 'Antarctica/South_Pole',
                'enabled'     => 1,
            ],
            10 => 
            [
                'id'          => 'AR',
                'name'        => 'Argentina',
                'code'        => 'ARG',
                'currency_id' => 'ARS',
                'phone_code'  => 54,
                'timezone'    => 'America/Argentina/Buenos_Aires',
                'enabled'     => 1,
            ],
            11 => 
            [
                'id'          => 'AS',
                'name'        => 'American Samoa',
                'code'        => 'ASM',
                'currency_id' => 'USD',
                'phone_code'  => 1684,
                'timezone'    => 'Pacific/Pago_Pago',
                'enabled'     => 1,
            ],
            12 => 
            [
                'id'          => 'AT',
                'name'        => 'Austria',
                'code'        => 'AUT',
                'currency_id' => 'EUR',
                'phone_code'  => 43,
                'timezone'    => 'Europe/Vienna',
                'enabled'     => 1,
            ],
            13 => 
            [
                'id'          => 'AU',
                'name'        => 'Australia',
                'code'        => 'AUS',
                'currency_id' => 'AUD',
                'phone_code'  => 61,
                'timezone'    => 'Australia/Melbourne',
                'enabled'     => 1,
            ],
            14 => 
            [
                'id'          => 'AW',
                'name'        => 'Aruba',
                'code'        => 'ABW',
                'currency_id' => 'AWG',
                'phone_code'  => 297,
                'timezone'    => 'America/Aruba',
                'enabled'     => 1,
            ],
            15 => 
            [
                'id'          => 'AX',
                'name'        => 'Åland Islands',
                'code'        => 'ALA',
                'currency_id' => 'EUR',
                'phone_code'  => 358,
                'timezone'    => 'Europe/Mariehamn',
                'enabled'     => 1,
            ],
            16 => 
            [
                'id'          => 'AZ',
                'name'        => 'Azerbaijan',
                'code'        => 'AZE',
                'currency_id' => 'AZN',
                'phone_code'  => 994,
                'timezone'    => 'Asia/Baku',
                'enabled'     => 1,
            ],
            17 => 
            [
                'id'          => 'BA',
                'name'        => 'Bosnia and Herzegovina',
                'code'        => 'BIH',
                'currency_id' => 'BAM',
                'phone_code'  => 387,
                'timezone'    => 'Europe/Sarajevo',
                'enabled'     => 1,
            ],
            18 => 
            [
                'id'          => 'BB',
                'name'        => 'Barbados',
                'code'        => 'BRB',
                'currency_id' => 'BBD',
                'phone_code'  => 1246,
                'timezone'    => 'America/Barbados',
                'enabled'     => 1,
            ],
            19 => 
            [
                'id'          => 'BD',
                'name'        => 'Bangladesh',
                'code'        => 'BGD',
                'currency_id' => 'BDT',
                'phone_code'  => 880,
                'timezone'    => 'Asia/Dhaka',
                'enabled'     => 1,
            ],
            20 => 
            [
                'id'          => 'BE',
                'name'        => 'Belgium',
                'code'        => 'BEL',
                'currency_id' => 'EUR',
                'phone_code'  => 32,
                'timezone'    => 'Europe/Brussels',
                'enabled'     => 1,
            ],
            21 => 
            [
                'id'          => 'BF',
                'name'        => 'Burkina Faso',
                'code'        => 'BFA',
                'currency_id' => 'XOF',
                'phone_code'  => 226,
                'timezone'    => 'Africa/Ouagadougou',
                'enabled'     => 1,
            ],
            22 => 
            [
                'id'          => 'BG',
                'name'        => 'Bulgaria',
                'code'        => 'BGR',
                'currency_id' => 'BGN',
                'phone_code'  => 359,
                'timezone'    => 'Europe/Sofia',
                'enabled'     => 1,
            ],
            23 => 
            [
                'id'          => 'BH',
                'name'        => 'Bahrain',
                'code'        => 'BHR',
                'currency_id' => 'BHD',
                'phone_code'  => 973,
                'timezone'    => 'Asia/Bahrain',
                'enabled'     => 1,
            ],
            24 => 
            [
                'id'          => 'BI',
                'name'        => 'Burundi',
                'code'        => 'BDI',
                'currency_id' => 'BIF',
                'phone_code'  => 257,
                'timezone'    => 'Africa/Bujumbura',
                'enabled'     => 1,
            ],
            25 => 
            [
                'id'          => 'BJ',
                'name'        => 'Benin',
                'code'        => 'BEN',
                'currency_id' => 'XOF',
                'phone_code'  => 229,
                'timezone'    => 'Africa/Porto-Novo',
                'enabled'     => 1,
            ],
            26 => 
            [
                'id'          => 'BL',
                'name'        => 'Saint Barthélemy',
                'code'        => 'BLM',
                'currency_id' => 'EUR',
                'phone_code'  => 590,
                'timezone'    => 'America/St_Barthelemy',
                'enabled'     => 1,
            ],
            27 => 
            [
                'id'          => 'BM',
                'name'        => 'Bermuda',
                'code'        => 'BMU',
                'currency_id' => 'BMD',
                'phone_code'  => 1441,
                'timezone'    => 'Atlantic/Bermuda',
                'enabled'     => 1,
            ],
            28 => 
            [
                'id'          => 'BN',
                'name'        => 'Brunei Darussalam',
                'code'        => 'BRN',
                'currency_id' => 'BND',
                'phone_code'  => 673,
                'timezone'    => 'Asia/Brunei',
                'enabled'     => 1,
            ],
            29 => 
            [
                'id'          => 'BO',
                'name'        => 'Bolivia (Plurinational State of)',
                'code'        => 'BOL',
                'currency_id' => 'BOB',
                'phone_code'  => 591,
                'timezone'    => 'America/La_Paz',
                'enabled'     => 1,
            ],
            30 => 
            [
                'id'          => 'BQ',
                'name'        => 'Bonaire Sint Eustatius and Saba',
                'code'        => 'BES',
                'currency_id' => 'USD',
                'phone_code'  => 5997,
                'timezone'    => 'America/Curacao',
                'enabled'     => 1,
            ],
            31 => 
            [
                'id'          => 'BR',
                'name'        => 'Brazil',
                'code'        => 'BRA',
                'currency_id' => 'BRL',
                'phone_code'  => 55,
                'timezone'    => 'America/Sao_Paulo',
                'enabled'     => 1,
            ],
            32 => 
            [
                'id'          => 'BS',
                'name'        => 'Bahamas',
                'code'        => 'BHS',
                'currency_id' => 'BSD',
                'phone_code'  => 1242,
                'timezone'    => 'America/Nassau',
                'enabled'     => 1,
            ],
            33 => 
            [
                'id'          => 'BT',
                'name'        => 'Bhutan',
                'code'        => 'BTN',
                'currency_id' => 'BTN',
                'phone_code'  => 975,
                'timezone'    => 'Asia/Thimphu',
                'enabled'     => 1,
            ],
            34 => 
            [
                'id'          => 'BV',
                'name'        => 'Bouvet Island',
                'code'        => 'BVT',
                'currency_id' => 'NOK',
                'phone_code'  => NULL,
                'timezone'    => 'Antarctica/Syowa',
                'enabled'     => 1,
            ],
            35 => 
            [
                'id'          => 'BW',
                'name'        => 'Botswana',
                'code'        => 'BWA',
                'currency_id' => 'BWP',
                'phone_code'  => 267,
                'timezone'    => 'Africa/Gaborone',
                'enabled'     => 1,
            ],
            36 => 
            [
                'id'          => 'BY',
                'name'        => 'Belarus',
                'code'        => 'BLR',
                'currency_id' => 'BYN',
                'phone_code'  => 375,
                'timezone'    => 'Europe/Minsk',
                'enabled'     => 1,
            ],
            37 => 
            [
                'id'          => 'BZ',
                'name'        => 'Belize',
                'code'        => 'BLZ',
                'currency_id' => 'BZD',
                'phone_code'  => 501,
                'timezone'    => 'America/Belize',
                'enabled'     => 1,
            ],
            38 => 
            [
                'id'          => 'CA',
                'name'        => 'Canada',
                'code'        => 'CAN',
                'currency_id' => 'CAD',
                'phone_code'  => 1,
                'timezone'    => 'America/Toronto',
                'enabled'     => 1,
            ],
            39 => 
            [
                'id'          => 'CC',
                'name'        => 'Cocos (Keeling) Islands',
                'code'        => 'CCK',
                'currency_id' => 'AUD',
                'phone_code'  => 61,
                'timezone'    => 'Indian/Cocos',
                'enabled'     => 1,
            ],
            40 => 
            [
                'id'          => 'CD',
                'name'        => 'Congo (Democratic Republic of the)',
                'code'        => 'COD',
                'currency_id' => 'CDF',
                'phone_code'  => 243,
                'timezone'    => 'Africa/Kinshasa',
                'enabled'     => 1,
            ],
            41 => 
            [
                'id'          => 'CF',
                'name'        => 'Central African Republic',
                'code'        => 'CAF',
                'currency_id' => 'XAF',
                'phone_code'  => 236,
                'timezone'    => 'Africa/Bangui',
                'enabled'     => 1,
            ],
            42 => 
            [
                'id'          => 'CG',
                'name'        => 'Congo',
                'code'        => 'COG',
                'currency_id' => 'XAF',
                'phone_code'  => 242,
                'timezone'    => 'Africa/Brazzaville',
                'enabled'     => 1,
            ],
            43 => 
            [
                'id'          => 'CH',
                'name'        => 'Switzerland',
                'code'        => 'CHE',
                'currency_id' => 'CHF',
                'phone_code'  => 41,
                'timezone'    => 'Europe/Zurich',
                'enabled'     => 1,
            ],
            44 => 
            [
                'id'          => 'CI',
                'name'        => 'Côte d\'Ivoire',
                'code'        => 'CIV',
                'currency_id' => 'XOF',
                'phone_code'  => 225,
                'timezone'    => 'Africa/Abidjan',
                'enabled'     => 1,
            ],
            45 => 
            [
                'id'          => 'CK',
                'name'        => 'Cook Islands',
                'code'        => 'COK',
                'currency_id' => 'NZD',
                'phone_code'  => 682,
                'timezone'    => 'Pacific/Rarotonga',
                'enabled'     => 1,
            ],
            46 => 
            [
                'id'          => 'CL',
                'name'        => 'Chile',
                'code'        => 'CHL',
                'currency_id' => 'CLP',
                'phone_code'  => 56,
                'timezone'    => 'America/Santiago',
                'enabled'     => 1,
            ],
            47 => 
            [
                'id'          => 'CM',
                'name'        => 'Cameroon',
                'code'        => 'CMR',
                'currency_id' => 'XAF',
                'phone_code'  => 237,
                'timezone'    => 'Africa/Lagos',
                'enabled'     => 1,
            ],
            48 => 
            [
                'id'          => 'CN',
                'name'        => 'China',
                'code'        => 'CHN',
                'currency_id' => 'CNY',
                'phone_code'  => 86,
                'timezone'    => 'Asia/Shanghai',
                'enabled'     => 1,
            ],
            49 => 
            [
                'id'          => 'CO',
                'name'        => 'Colombia',
                'code'        => 'COL',
                'currency_id' => 'COP',
                'phone_code'  => 57,
                'timezone'    => 'America/Bogota',
                'enabled'     => 1,
            ],
            50 => 
            [
                'id'          => 'CR',
                'name'        => 'Costa Rica',
                'code'        => 'CRI',
                'currency_id' => 'CRC',
                'phone_code'  => 506,
                'timezone'    => 'America/Costa_Rica',
                'enabled'     => 1,
            ],
            51 => 
            [
                'id'          => 'CU',
                'name'        => 'Cuba',
                'code'        => 'CUB',
                'currency_id' => 'CUP',
                'phone_code'  => 53,
                'timezone'    => 'America/Havana',
                'enabled'     => 1,
            ],
            52 => 
            [
                'id'          => 'CV',
                'name'        => 'Cabo Verde',
                'code'        => 'CPV',
                'currency_id' => 'CVE',
                'phone_code'  => 238,
                'timezone'    => 'Atlantic/Cape_Verde',
                'enabled'     => 1,
            ],
            53 => 
            [
                'id'          => 'CW',
                'name'        => 'Curaçao',
                'code'        => 'CUW',
                'currency_id' => 'ANG',
                'phone_code'  => 599,
                'timezone'    => 'America/Curacao',
                'enabled'     => 1,
            ],
            54 => 
            [
                'id'          => 'CX',
                'name'        => 'Christmas Island',
                'code'        => 'CXR',
                'currency_id' => 'AUD',
                'phone_code'  => 61,
                'timezone'    => 'Indian/Christmas',
                'enabled'     => 1,
            ],
            55 => 
            [
                'id'          => 'CY',
                'name'        => 'Cyprus',
                'code'        => 'CYP',
                'currency_id' => 'EUR',
                'phone_code'  => 357,
                'timezone'    => 'Asia/Nicosia',
                'enabled'     => 1,
            ],
            56 => 
            [
                'id'          => 'CZ',
                'name'        => 'Czech Republic',
                'code'        => 'CZE',
                'currency_id' => 'CZK',
                'phone_code'  => 420,
                'timezone'    => 'Europe/Prague',
                'enabled'     => 1,
            ],
            57 => 
            [
                'id'          => 'DE',
                'name'        => 'Germany',
                'code'        => 'DEU',
                'currency_id' => 'EUR',
                'phone_code'  => 49,
                'timezone'    => 'Europe/Berlin',
                'enabled'     => 1,
            ],
            58 => 
            [
                'id'          => 'DJ',
                'name'        => 'Djibouti',
                'code'        => 'DJI',
                'currency_id' => 'DJF',
                'phone_code'  => 253,
                'timezone'    => 'Africa/Djibouti',
                'enabled'     => 1,
            ],
            59 => 
            [
                'id'          => 'DK',
                'name'        => 'Denmark',
                'code'        => 'DNK',
                'currency_id' => 'DKK',
                'phone_code'  => 45,
                'timezone'    => 'Europe/Copenhagen',
                'enabled'     => 1,
            ],
            60 => 
            [
                'id'          => 'DM',
                'name'        => 'Dominica',
                'code'        => 'DMA',
                'currency_id' => 'XCD',
                'phone_code'  => 1767,
                'timezone'    => 'America/Dominica',
                'enabled'     => 1,
            ],
            61 => 
            [
                'id'          => 'DO',
                'name'        => 'Dominican Republic',
                'code'        => 'DOM',
                'currency_id' => 'DOP',
                'phone_code'  => 1849,
                'timezone'    => 'America/Santo_Domingo',
                'enabled'     => 1,
            ],
            62 => 
            [
                'id'          => 'DZ',
                'name'        => 'Algeria',
                'code'        => 'DZA',
                'currency_id' => 'DZD',
                'phone_code'  => 213,
                'timezone'    => 'Africa/Algiers',
                'enabled'     => 1,
            ],
            63 => 
            [
                'id'          => 'EC',
                'name'        => 'Ecuador',
                'code'        => 'ECU',
                'currency_id' => 'USD',
                'phone_code'  => 593,
                'timezone'    => 'America/Guayaquil',
                'enabled'     => 1,
            ],
            64 => 
            [
                'id'          => 'EE',
                'name'        => 'Estonia',
                'code'        => 'EST',
                'currency_id' => 'EUR',
                'phone_code'  => 372,
                'timezone'    => 'Europe/Tallinn',
                'enabled'     => 1,
            ],
            65 => 
            [
                'id'          => 'EG',
                'name'        => 'Egypt',
                'code'        => 'EGY',
                'currency_id' => 'EGP',
                'phone_code'  => 20,
                'timezone'    => 'Africa/Cairo',
                'enabled'     => 1,
            ],
            66 => 
            [
                'id'          => 'EH',
                'name'        => 'Western Sahara',
                'code'        => 'ESH',
                'currency_id' => 'MAD',
                'phone_code'  => 212,
                'timezone'    => 'Africa/El_Aaiun',
                'enabled'     => 1,
            ],
            67 => 
            [
                'id'          => 'ER',
                'name'        => 'Eritrea',
                'code'        => 'ERI',
                'currency_id' => 'ERN',
                'phone_code'  => 291,
                'timezone'    => 'Africa/Asmara',
                'enabled'     => 1,
            ],
            68 => 
            [
                'id'          => 'ES',
                'name'        => 'Spain',
                'code'        => 'ESP',
                'currency_id' => 'EUR',
                'phone_code'  => 34,
                'timezone'    => 'Europe/Madrid',
                'enabled'     => 1,
            ],
            69 => 
            [
                'id'          => 'ET',
                'name'        => 'Ethiopia',
                'code'        => 'ETH',
                'currency_id' => 'ETB',
                'phone_code'  => 251,
                'timezone'    => 'Africa/Addis_Ababa',
                'enabled'     => 1,
            ],
            70 => 
            [
                'id'          => 'FI',
                'name'        => 'Finland',
                'code'        => 'FIN',
                'currency_id' => 'EUR',
                'phone_code'  => 358,
                'timezone'    => 'Europe/Helsinki',
                'enabled'     => 1,
            ],
            71 => 
            [
                'id'          => 'FJ',
                'name'        => 'Fiji',
                'code'        => 'FJI',
                'currency_id' => 'FJD',
                'phone_code'  => 679,
                'timezone'    => 'Pacific/Fiji',
                'enabled'     => 1,
            ],
            72 => 
            [
                'id'          => 'FK',
                'name'        => 'Falkland Islands (Malvinas)',
                'code'        => 'FLK',
                'currency_id' => 'FKP',
                'phone_code'  => 500,
                'timezone'    => 'Atlantic/Stanley',
                'enabled'     => 1,
            ],
            73 => 
            [
                'id'          => 'FM',
                'name'        => 'Micronesia (Federated States of)',
                'code'        => 'FSM',
                'currency_id' => 'USD',
                'phone_code'  => 691,
                'timezone'    => 'Pacific/Pohnpei',
                'enabled'     => 1,
            ],
            74 => 
            [
                'id'          => 'FO',
                'name'        => 'Faroe Islands',
                'code'        => 'FRO',
                'currency_id' => 'DKK',
                'phone_code'  => 298,
                'timezone'    => 'Atlantic/Faroe',
                'enabled'     => 1,
            ],
            75 => 
            [
                'id'          => 'FR',
                'name'        => 'France',
                'code'        => 'FRA',
                'currency_id' => 'EUR',
                'phone_code'  => 33,
                'timezone'    => 'Europe/Paris',
                'enabled'     => 1,
            ],
            76 => 
            [
                'id'          => 'GA',
                'name'        => 'Gabon',
                'code'        => 'GAB',
                'currency_id' => 'XAF',
                'phone_code'  => 241,
                'timezone'    => 'Africa/Libreville',
                'enabled'     => 1,
            ],
            77 => 
            [
                'id'          => 'GB',
                'name'        => 'United Kingdom of Great Britain and Northern Ireland',
                'code'        => 'GBR',
                'currency_id' => 'GBP',
                'phone_code'  => 44,
                'timezone'    => 'Europe/London',
                'enabled'     => 1,
            ],
            78 => 
            [
                'id'          => 'GD',
                'name'        => 'Grenada',
                'code'        => 'GRD',
                'currency_id' => 'XCD',
                'phone_code'  => 1473,
                'timezone'    => 'America/Grenada',
                'enabled'     => 1,
            ],
            79 => 
            [
                'id'          => 'GE',
                'name'        => 'Georgia',
                'code'        => 'GEO',
                'currency_id' => 'GEL',
                'phone_code'  => 995,
                'timezone'    => 'Asia/Tbilisi',
                'enabled'     => 1,
            ],
            80 => 
            [
                'id'          => 'GF',
                'name'        => 'French Guiana',
                'code'        => 'GUF',
                'currency_id' => 'EUR',
                'phone_code'  => 594,
                'timezone'    => 'America/Cayenne',
                'enabled'     => 1,
            ],
            81 => 
            [
                'id'          => 'GG',
                'name'        => 'Guernsey',
                'code'        => 'GGY',
                'currency_id' => 'GBP',
                'phone_code'  => 44,
                'timezone'    => 'Europe/Guernsey',
                'enabled'     => 1,
            ],
            82 => 
            [
                'id'          => 'GH',
                'name'        => 'Ghana',
                'code'        => 'GHA',
                'currency_id' => 'GHS',
                'phone_code'  => 233,
                'timezone'    => 'Africa/Accra',
                'enabled'     => 1,
            ],
            83 => 
            [
                'id'          => 'GI',
                'name'        => 'Gibraltar',
                'code'        => 'GIB',
                'currency_id' => 'GIP',
                'phone_code'  => 350,
                'timezone'    => 'Europe/Gibraltar',
                'enabled'     => 1,
            ],
            84 => 
            [
                'id'          => 'GL',
                'name'        => 'Greenland',
                'code'        => 'GRL',
                'currency_id' => 'DKK',
                'phone_code'  => 299,
                'timezone'    => 'America/Godthab',
                'enabled'     => 1,
            ],
            85 => 
            [
                'id'          => 'GM',
                'name'        => 'Gambia',
                'code'        => 'GMB',
                'currency_id' => 'GMD',
                'phone_code'  => 220,
                'timezone'    => 'Africa/Banjul',
                'enabled'     => 1,
            ],
            86 => 
            [
                'id'          => 'GN',
                'name'        => 'Guinea',
                'code'        => 'GIN',
                'currency_id' => 'GNF',
                'phone_code'  => 224,
                'timezone'    => 'Africa/Conakry',
                'enabled'     => 1,
            ],
            87 => 
            [
                'id'          => 'GP',
                'name'        => 'Guadeloupe',
                'code'        => 'GLP',
                'currency_id' => 'EUR',
                'phone_code'  => 590,
                'timezone'    => 'America/Guadeloupe',
                'enabled'     => 1,
            ],
            88 => 
            [
                'id'          => 'GQ',
                'name'        => 'Equatorial Guinea',
                'code'        => 'GNQ',
                'currency_id' => 'XAF',
                'phone_code'  => 240,
                'timezone'    => 'Africa/Malabo',
                'enabled'     => 1,
            ],
            89 => 
            [
                'id'          => 'GR',
                'name'        => 'Greece',
                'code'        => 'GRC',
                'currency_id' => 'EUR',
                'phone_code'  => 30,
                'timezone'    => 'Europe/Athens',
                'enabled'     => 1,
            ],
            90 => 
            [
                'id'          => 'GS',
                'name'        => 'South Georgia and the South Sandwich Islands',
                'code'        => 'SGS',
                'currency_id' => 'GBP',
                'phone_code'  => 500,
                'timezone'    => 'Atlantic/South_Georgia',
                'enabled'     => 1,
            ],
            91 => 
            [
                'id'          => 'GT',
                'name'        => 'Guatemala',
                'code'        => 'GTM',
                'currency_id' => 'GTQ',
                'phone_code'  => 502,
                'timezone'    => 'America/Guatemala',
                'enabled'     => 1,
            ],
            92 => 
            [
                'id'          => 'GU',
                'name'        => 'Guam',
                'code'        => 'GUM',
                'currency_id' => 'USD',
                'phone_code'  => 1671,
                'timezone'    => 'Pacific/Guam',
                'enabled'     => 1,
            ],
            93 => 
            [
                'id'          => 'GW',
                'name'        => 'Guinea-Bissau',
                'code'        => 'GNB',
                'currency_id' => 'XOF',
                'phone_code'  => 245,
                'timezone'    => 'Africa/Bissau',
                'enabled'     => 1,
            ],
            94 => 
            [
                'id'          => 'GY',
                'name'        => 'Guyana',
                'code'        => 'GUY',
                'currency_id' => 'GYD',
                'phone_code'  => 595,
                'timezone'    => 'America/Guyana',
                'enabled'     => 1,
            ],
            95 => 
            [
                'id'          => 'HK',
                'name'        => 'Hong Kong',
                'code'        => 'HKG',
                'currency_id' => 'HKD',
                'phone_code'  => 852,
                'timezone'    => 'Asia/Hong_Kong',
                'enabled'     => 1,
            ],
            96 => 
            [
                'id'          => 'HM',
                'name'        => 'Heard Island and McDonald Islands',
                'code'        => 'HMD',
                'currency_id' => 'AUD',
                'phone_code'  => NULL,
                'timezone'    => 'Indian/Kerguelen',
                'enabled'     => 1,
            ],
            97 => 
            [
                'id'          => 'HN',
                'name'        => 'Honduras',
                'code'        => 'HND',
                'currency_id' => 'HNL',
                'phone_code'  => 504,
                'timezone'    => 'America/Tegucigalpa',
                'enabled'     => 1,
            ],
            98 => 
            [
                'id'          => 'HR',
                'name'        => 'Croatia',
                'code'        => 'HRV',
                'currency_id' => 'HRK',
                'phone_code'  => 385,
                'timezone'    => 'Europe/Zagreb',
                'enabled'     => 1,
            ],
            99 => 
            [
                'id'          => 'HT',
                'name'        => 'Haiti',
                'code'        => 'HTI',
                'currency_id' => 'HTG',
                'phone_code'  => 509,
                'timezone'    => 'America/Port-au-Prince',
                'enabled'     => 1,
            ],
            100 => 
            [
                'id'          => 'HU',
                'name'        => 'Hungary',
                'code'        => 'HUN',
                'currency_id' => 'HUF',
                'phone_code'  => 36,
                'timezone'    => 'Europe/Budapest',
                'enabled'     => 1,
            ],
            101 => 
            [
                'id'          => 'ID',
                'name'        => 'Indonesia',
                'code'        => 'IDN',
                'currency_id' => 'IDR',
                'phone_code'  => 62,
                'timezone'    => 'Asia/Jakarta',
                'enabled'     => 1,
            ],
            102 => 
            [
                'id'          => 'IE',
                'name'        => 'Ireland',
                'code'        => 'IRL',
                'currency_id' => 'EUR',
                'phone_code'  => 353,
                'timezone'    => 'Europe/Dublin',
                'enabled'     => 1,
            ],
            103 => 
            [
                'id'          => 'IL',
                'name'        => 'Israel',
                'code'        => 'ISR',
                'currency_id' => 'ILS',
                'phone_code'  => 972,
                'timezone'    => 'Asia/Jerusalem',
                'enabled'     => 1,
            ],
            104 => 
            [
                'id'          => 'IM',
                'name'        => 'Isle of Man',
                'code'        => 'IMN',
                'currency_id' => 'GBP',
                'phone_code'  => 44,
                'timezone'    => 'Europe/Isle_of_Man',
                'enabled'     => 1,
            ],
            105 => 
            [
                'id'          => 'IN',
                'name'        => 'India',
                'code'        => 'IND',
                'currency_id' => 'INR',
                'phone_code'  => 91,
                'timezone'    => 'Asia/Kolkata',
                'enabled'     => 1,
            ],
            106 => 
            [
                'id'          => 'IO',
                'name'        => 'British Indian Ocean Territory',
                'code'        => 'IOT',
                'currency_id' => 'USD',
                'phone_code'  => 246,
                'timezone'    => 'Indian/Chagos',
                'enabled'     => 1,
            ],
            107 => 
            [
                'id'          => 'IQ',
                'name'        => 'Iraq',
                'code'        => 'IRQ',
                'currency_id' => 'IQD',
                'phone_code'  => 964,
                'timezone'    => 'Asia/Baghdad',
                'enabled'     => 1,
            ],
            108 => 
            [
                'id'          => 'IR',
                'name'        => 'Iran (Islamic Republic of)',
                'code'        => 'IRN',
                'currency_id' => 'IRR',
                'phone_code'  => 98,
                'timezone'    => 'Asia/Tehran',
                'enabled'     => 1,
            ],
            109 => 
            [
                'id'          => 'IS',
                'name'        => 'Iceland',
                'code'        => 'ISL',
                'currency_id' => 'ISK',
                'phone_code'  => 354,
                'timezone'    => 'Atlantic/Reykjavik',
                'enabled'     => 1,
            ],
            110 => 
            [
                'id'          => 'IT',
                'name'        => 'Italy',
                'code'        => 'ITA',
                'currency_id' => 'EUR',
                'phone_code'  => 39,
                'timezone'    => 'Europe/Rome',
                'enabled'     => 1,
            ],
            111 => 
            [
                'id'          => 'JE',
                'name'        => 'Jersey',
                'code'        => 'JEY',
                'currency_id' => 'GBP',
                'phone_code'  => 44,
                'timezone'    => 'Europe/Jersey',
                'enabled'     => 1,
            ],
            112 => 
            [
                'id'          => 'JM',
                'name'        => 'Jamaica',
                'code'        => 'JAM',
                'currency_id' => 'JMD',
                'phone_code'  => 1876,
                'timezone'    => 'America/Jamaica',
                'enabled'     => 1,
            ],
            113 => 
            [
                'id'          => 'JO',
                'name'        => 'Jordan',
                'code'        => 'JOR',
                'currency_id' => 'JOD',
                'phone_code'  => 962,
                'timezone'    => 'Asia/Amman',
                'enabled'     => 1,
            ],
            114 => 
            [
                'id'          => 'JP',
                'name'        => 'Japan',
                'code'        => 'JPN',
                'currency_id' => 'JPY',
                'phone_code'  => 81,
                'timezone'    => 'Asia/Tokyo',
                'enabled'     => 1,
            ],
            115 => 
            [
                'id'          => 'KE',
                'name'        => 'Kenya',
                'code'        => 'KEN',
                'currency_id' => 'KES',
                'phone_code'  => 254,
                'timezone'    => 'Africa/Nairobi',
                'enabled'     => 1,
            ],
            116 => 
            [
                'id'          => 'KG',
                'name'        => 'Kyrgyzstan',
                'code'        => 'KGZ',
                'currency_id' => 'KGS',
                'phone_code'  => 996,
                'timezone'    => 'Asia/Bishkek',
                'enabled'     => 1,
            ],
            117 => 
            [
                'id'          => 'KH',
                'name'        => 'Cambodia',
                'code'        => 'KHM',
                'currency_id' => 'KHR',
                'phone_code'  => 855,
                'timezone'    => 'Asia/Phnom_Penh',
                'enabled'     => 1,
            ],
            118 => 
            [
                'id'          => 'KI',
                'name'        => 'Kiribati',
                'code'        => 'KIR',
                'currency_id' => 'AUD',
                'phone_code'  => 686,
                'timezone'    => 'Pacific/Tarawa',
                'enabled'     => 1,
            ],
            119 => 
            [
                'id'          => 'KM',
                'name'        => 'Comoros',
                'code'        => 'COM',
                'currency_id' => 'KMF',
                'phone_code'  => 269,
                'timezone'    => 'Indian/Comoro',
                'enabled'     => 1,
            ],
            120 => 
            [
                'id'          => 'KN',
                'name'        => 'Saint Kitts and Nevis',
                'code'        => 'KNA',
                'currency_id' => 'XCD',
                'phone_code'  => 1869,
                'timezone'    => 'America/St_Kitts',
                'enabled'     => 1,
            ],
            121 => 
            [
                'id'          => 'KP',
                'name'        => 'Korea (Democratic People\'s Republic of)',
                'code'        => 'PRK',
                'currency_id' => 'KPW',
                'phone_code'  => 850,
                'timezone'    => 'Asia/Pyongyang',
                'enabled'     => 1,
            ],
            122 => 
            [
                'id'          => 'KR',
                'name'        => 'Korea (Republic of)',
                'code'        => 'KOR',
                'currency_id' => 'KRW',
                'phone_code'  => 82,
                'timezone'    => 'Asia/Seoul',
                'enabled'     => 1,
            ],
            123 => 
            [
                'id'          => 'KW',
                'name'        => 'Kuwait',
                'code'        => 'KWT',
                'currency_id' => 'KWD',
                'phone_code'  => 965,
                'timezone'    => 'Asia/Kuwait',
                'enabled'     => 1,
            ],
            124 => 
            [
                'id'          => 'KY',
                'name'        => 'Cayman Islands',
                'code'        => 'CYM',
                'currency_id' => 'KYD',
                'phone_code'  => 345,
                'timezone'    => 'America/Cayman',
                'enabled'     => 1,
            ],
            125 => 
            [
                'id'          => 'KZ',
                'name'        => 'Kazakhstan',
                'code'        => 'KAZ',
                'currency_id' => 'KZT',
                'phone_code'  => 77,
                'timezone'    => 'Asia/Almaty',
                'enabled'     => 1,
            ],
            126 => 
            [
                'id'          => 'LA',
                'name'        => 'Lao People\'s Democratic Republic',
                'code'        => 'LAO',
                'currency_id' => 'LAK',
                'phone_code'  => 856,
                'timezone'    => 'Asia/Vientiane',
                'enabled'     => 1,
            ],
            127 => 
            [
                'id'          => 'LB',
                'name'        => 'Lebanon',
                'code'        => 'LBN',
                'currency_id' => 'LBP',
                'phone_code'  => 961,
                'timezone'    => 'Asia/Beirut',
                'enabled'     => 1,
            ],
            128 => 
            [
                'id'          => 'LC',
                'name'        => 'Saint Lucia',
                'code'        => 'LCA',
                'currency_id' => 'XCD',
                'phone_code'  => 1758,
                'timezone'    => 'America/St_Lucia',
                'enabled'     => 1,
            ],
            129 => 
            [
                'id'          => 'LI',
                'name'        => 'Liechtenstein',
                'code'        => 'LIE',
                'currency_id' => 'CHF',
                'phone_code'  => 423,
                'timezone'    => 'Europe/Vaduz',
                'enabled'     => 1,
            ],
            130 => 
            [
                'id'          => 'LK',
                'name'        => 'Sri Lanka',
                'code'        => 'LKA',
                'currency_id' => 'LKR',
                'phone_code'  => 94,
                'timezone'    => 'Asia/Colombo',
                'enabled'     => 1,
            ],
            131 => 
            [
                'id'          => 'LR',
                'name'        => 'Liberia',
                'code'        => 'LBR',
                'currency_id' => 'LRD',
                'phone_code'  => 231,
                'timezone'    => 'Africa/Monrovia',
                'enabled'     => 1,
            ],
            132 => 
            [
                'id'          => 'LS',
                'name'        => 'Lesotho',
                'code'        => 'LSO',
                'currency_id' => 'LSL',
                'phone_code'  => 266,
                'timezone'    => 'Africa/Maseru',
                'enabled'     => 1,
            ],
            133 => 
            [
                'id'          => 'LT',
                'name'        => 'Lithuania',
                'code'        => 'LTU',
                'currency_id' => 'EUR',
                'phone_code'  => 370,
                'timezone'    => 'Europe/Vilnius',
                'enabled'     => 1,
            ],
            134 => 
            [
                'id'          => 'LU',
                'name'        => 'Luxembourg',
                'code'        => 'LUX',
                'currency_id' => 'EUR',
                'phone_code'  => 352,
                'timezone'    => 'Europe/Luxembourg',
                'enabled'     => 1,
            ],
            135 => 
            [
                'id'          => 'LV',
                'name'        => 'Latvia',
                'code'        => 'LVA',
                'currency_id' => 'EUR',
                'phone_code'  => 371,
                'timezone'    => 'Europe/Riga',
                'enabled'     => 1,
            ],
            136 => 
            [
                'id'          => 'LY',
                'name'        => 'Libya',
                'code'        => 'LBY',
                'currency_id' => 'LYD',
                'phone_code'  => 218,
                'timezone'    => 'Africa/Tripoli',
                'enabled'     => 1,
            ],
            137 => 
            [
                'id'          => 'MA',
                'name'        => 'Morocco',
                'code'        => 'MAR',
                'currency_id' => 'MAD',
                'phone_code'  => 212,
                'timezone'    => 'Africa/Casablanca',
                'enabled'     => 1,
            ],
            138 => 
            [
                'id'          => 'MC',
                'name'        => 'Monaco',
                'code'        => 'MCO',
                'currency_id' => 'EUR',
                'phone_code'  => 377,
                'timezone'    => 'Europe/Monaco',
                'enabled'     => 1,
            ],
            139 => 
            [
                'id'          => 'MD',
                'name'        => 'Moldova (Republic of)',
                'code'        => 'MDA',
                'currency_id' => 'MDL',
                'phone_code'  => 373,
                'timezone'    => 'Europe/Chisinau',
                'enabled'     => 1,
            ],
            140 => 
            [
                'id'          => 'ME',
                'name'        => 'Montenegro',
                'code'        => 'MNE',
                'currency_id' => 'EUR',
                'phone_code'  => 382,
                'timezone'    => 'Europe/Podgorica',
                'enabled'     => 1,
            ],
            141 => 
            [
                'id'          => 'MF',
                'name'        => 'Saint Martin (French part)',
                'code'        => 'MAF',
                'currency_id' => 'EUR',
                'phone_code'  => 590,
                'timezone'    => 'America/Marigot',
                'enabled'     => 1,
            ],
            142 => 
            [
                'id'          => 'MG',
                'name'        => 'Madagascar',
                'code'        => 'MDG',
                'currency_id' => 'MGA',
                'phone_code'  => 261,
                'timezone'    => 'Indian/Antananarivo',
                'enabled'     => 1,
            ],
            143 => 
            [
                'id'          => 'MH',
                'name'        => 'Marshall Islands',
                'code'        => 'MHL',
                'currency_id' => 'USD',
                'phone_code'  => 692,
                'timezone'    => 'Pacific/Kwajalein',
                'enabled'     => 1,
            ],
            144 => 
            [
                'id'          => 'MK',
                'name'        => 'Macedonia (the former Yugoslav Republic of)',
                'code'        => 'MKD',
                'currency_id' => 'MKD',
                'phone_code'  => 389,
                'timezone'    => 'Europe/Skopje',
                'enabled'     => 1,
            ],
            145 => 
            [
                'id'          => 'ML',
                'name'        => 'Mali',
                'code'        => 'MLI',
                'currency_id' => 'XOF',
                'phone_code'  => 223,
                'timezone'    => 'Africa/Bamako',
                'enabled'     => 1,
            ],
            146 => 
            [
                'id'          => 'MM',
                'name'        => 'Myanmar',
                'code'        => 'MMR',
                'currency_id' => 'MMK',
                'phone_code'  => 95,
                'timezone'    => 'Asia/Rangoon',
                'enabled'     => 1,
            ],
            147 => 
            [
                'id'          => 'MN',
                'name'        => 'Mongolia',
                'code'        => 'MNG',
                'currency_id' => 'MNT',
                'phone_code'  => 976,
                'timezone'    => 'Asia/Ulaanbaatar',
                'enabled'     => 1,
            ],
            148 => 
            [
                'id'          => 'MO',
                'name'        => 'Macao',
                'code'        => 'MAC',
                'currency_id' => 'MOP',
                'phone_code'  => 853,
                'timezone'    => 'Asia/Macau',
                'enabled'     => 1,
            ],
            149 => 
            [
                'id'          => 'MP',
                'name'        => 'Northern Mariana Islands',
                'code'        => 'MNP',
                'currency_id' => 'USD',
                'phone_code'  => 1670,
                'timezone'    => 'Pacific/Saipan',
                'enabled'     => 1,
            ],
            150 => 
            [
                'id'          => 'MQ',
                'name'        => 'Martinique',
                'code'        => 'MTQ',
                'currency_id' => 'EUR',
                'phone_code'  => 596,
                'timezone'    => 'America/Martinique',
                'enabled'     => 1,
            ],
            151 => 
            [
                'id'          => 'MR',
                'name'        => 'Mauritania',
                'code'        => 'MRT',
                'currency_id' => 'MRO',
                'phone_code'  => 222,
                'timezone'    => 'Africa/Nouakchott',
                'enabled'     => 1,
            ],
            152 => 
            [
                'id'          => 'MS',
                'name'        => 'Montserrat',
                'code'        => 'MSR',
                'currency_id' => 'XCD',
                'phone_code'  => 1664,
                'timezone'    => 'America/Montserrat',
                'enabled'     => 1,
            ],
            153 => 
            [
                'id'          => 'MT',
                'name'        => 'Malta',
                'code'        => 'MLT',
                'currency_id' => 'EUR',
                'phone_code'  => 356,
                'timezone'    => 'Europe/Malta',
                'enabled'     => 1,
            ],
            154 => 
            [
                'id'          => 'MU',
                'name'        => 'Mauritius',
                'code'        => 'MUS',
                'currency_id' => 'MUR',
                'phone_code'  => 230,
                'timezone'    => 'Indian/Mauritius',
                'enabled'     => 1,
            ],
            155 => 
            [
                'id'          => 'MV',
                'name'        => 'Maldives',
                'code'        => 'MDV',
                'currency_id' => 'MVR',
                'phone_code'  => 960,
                'timezone'    => 'Indian/Maldives',
                'enabled'     => 1,
            ],
            156 => 
            [
                'id'          => 'MW',
                'name'        => 'Malawi',
                'code'        => 'MWI',
                'currency_id' => 'MWK',
                'phone_code'  => 265,
                'timezone'    => 'Africa/Blantyre',
                'enabled'     => 1,
            ],
            157 => 
            [
                'id'          => 'MX',
                'name'        => 'Mexico',
                'code'        => 'MEX',
                'currency_id' => 'MXN',
                'phone_code'  => 52,
                'timezone'    => 'America/Mexico_City',
                'enabled'     => 1,
            ],
            158 => 
            [
                'id'          => 'MY',
                'name'        => 'Malaysia',
                'code'        => 'MYS',
                'currency_id' => 'MYR',
                'phone_code'  => 60,
                'timezone'    => 'Asia/Kuala_Lumpur',
                'enabled'     => 1,
            ],
            159 => 
            [
                'id'          => 'MZ',
                'name'        => 'Mozambique',
                'code'        => 'MOZ',
                'currency_id' => 'MZN',
                'phone_code'  => 258,
                'timezone'    => 'Africa/Maputo',
                'enabled'     => 1,
            ],
            160 => 
            [
                'id'          => 'NA',
                'name'        => 'Namibia',
                'code'        => 'NAM',
                'currency_id' => 'NAD',
                'phone_code'  => 264,
                'timezone'    => 'Africa/Windhoek',
                'enabled'     => 1,
            ],
            161 => 
            [
                'id'          => 'NC',
                'name'        => 'New Caledonia',
                'code'        => 'NCL',
                'currency_id' => 'XPF',
                'phone_code'  => 687,
                'timezone'    => 'Pacific/Noumea',
                'enabled'     => 1,
            ],
            162 => 
            [
                'id'          => 'NE',
                'name'        => 'Niger',
                'code'        => 'NER',
                'currency_id' => 'XOF',
                'phone_code'  => 227,
                'timezone'    => 'Africa/Niamey',
                'enabled'     => 1,
            ],
            163 => 
            [
                'id'          => 'NF',
                'name'        => 'Norfolk Island',
                'code'        => 'NFK',
                'currency_id' => 'AUD',
                'phone_code'  => 672,
                'timezone'    => 'Pacific/Norfolk',
                'enabled'     => 1,
            ],
            164 => 
            [
                'id'          => 'NG',
                'name'        => 'Nigeria',
                'code'        => 'NGA',
                'currency_id' => 'NGN',
                'phone_code'  => 234,
                'timezone'    => 'Africa/Lagos',
                'enabled'     => 1,
            ],
            165 => 
            [
                'id'          => 'NI',
                'name'        => 'Nicaragua',
                'code'        => 'NIC',
                'currency_id' => 'NIO',
                'phone_code'  => 505,
                'timezone'    => 'America/Managua',
                'enabled'     => 1,
            ],
            166 => 
            [
                'id'          => 'NL',
                'name'        => 'Netherlands',
                'code'        => 'NLD',
                'currency_id' => 'EUR',
                'phone_code'  => 31,
                'timezone'    => 'Europe/Amsterdam',
                'enabled'     => 1,
            ],
            167 => 
            [
                'id'          => 'NO',
                'name'        => 'Norway',
                'code'        => 'NOR',
                'currency_id' => 'NOK',
                'phone_code'  => 47,
                'timezone'    => 'Europe/Oslo',
                'enabled'     => 1,
            ],
            168 => 
            [
                'id'          => 'NP',
                'name'        => 'Nepal',
                'code'        => 'NPL',
                'currency_id' => 'NPR',
                'phone_code'  => 977,
                'timezone'    => 'Asia/Kathmandu',
                'enabled'     => 1,
            ],
            169 => 
            [
                'id'          => 'NR',
                'name'        => 'Nauru',
                'code'        => 'NRU',
                'currency_id' => 'AUD',
                'phone_code'  => 674,
                'timezone'    => 'Pacific/Nauru',
                'enabled'     => 1,
            ],
            170 => 
            [
                'id'          => 'NU',
                'name'        => 'Niue',
                'code'        => 'NIU',
                'currency_id' => 'NZD',
                'phone_code'  => 683,
                'timezone'    => 'Pacific/Niue',
                'enabled'     => 1,
            ],
            171 => 
            [
                'id'          => 'NZ',
                'name'        => 'New Zealand',
                'code'        => 'NZL',
                'currency_id' => 'NZD',
                'phone_code'  => 64,
                'timezone'    => 'Pacific/Auckland',
                'enabled'     => 1,
            ],
            172 => 
            [
                'id'          => 'OM',
                'name'        => 'Oman',
                'code'        => 'OMN',
                'currency_id' => 'OMR',
                'phone_code'  => 968,
                'timezone'    => 'Asia/Muscat',
                'enabled'     => 1,
            ],
            173 => 
            [
                'id'          => 'PA',
                'name'        => 'Panama',
                'code'        => 'PAN',
                'currency_id' => 'PAB',
                'phone_code'  => 507,
                'timezone'    => 'America/Panama',
                'enabled'     => 1,
            ],
            174 => 
            [
                'id'          => 'PE',
                'name'        => 'Peru',
                'code'        => 'PER',
                'currency_id' => 'PEN',
                'phone_code'  => 51,
                'timezone'    => 'America/Lima',
                'enabled'     => 1,
            ],
            175 => 
            [
                'id'          => 'PF',
                'name'        => 'French Polynesia',
                'code'        => 'PYF',
                'currency_id' => 'XPF',
                'phone_code'  => 689,
                'timezone'    => 'Pacific/Marquesas',
                'enabled'     => 1,
            ],
            176 => 
            [
                'id'          => 'PG',
                'name'        => 'Papua New Guinea',
                'code'        => 'PNG',
                'currency_id' => 'PGK',
                'phone_code'  => 675,
                'timezone'    => 'Pacific/Port_Moresby',
                'enabled'     => 1,
            ],
            177 => 
            [
                'id'          => 'PH',
                'name'        => 'Philippines',
                'code'        => 'PHL',
                'currency_id' => 'PHP',
                'phone_code'  => 63,
                'timezone'    => 'Asia/Manila',
                'enabled'     => 1,
            ],
            178 => 
            [
                'id'          => 'PK',
                'name'        => 'Pakistan',
                'code'        => 'PAK',
                'currency_id' => 'PKR',
                'phone_code'  => 92,
                'timezone'    => 'Asia/Karachi',
                'enabled'     => 1,
            ],
            179 => 
            [
                'id'          => 'PL',
                'name'        => 'Poland',
                'code'        => 'POL',
                'currency_id' => 'PLN',
                'phone_code'  => 48,
                'timezone'    => 'Europe/Warsaw',
                'enabled'     => 1,
            ],
            180 => 
            [
                'id'          => 'PM',
                'name'        => 'Saint Pierre and Miquelon',
                'code'        => 'SPM',
                'currency_id' => 'EUR',
                'phone_code'  => 508,
                'timezone'    => 'America/Miquelon',
                'enabled'     => 1,
            ],
            181 => 
            [
                'id'          => 'PN',
                'name'        => 'Pitcairn',
                'code'        => 'PCN',
                'currency_id' => 'NZD',
                'phone_code'  => 872,
                'timezone'    => 'Pacific/Pitcairn',
                'enabled'     => 1,
            ],
            182 => 
            [
                'id'          => 'PR',
                'name'        => 'Puerto Rico',
                'code'        => 'PRI',
                'currency_id' => 'USD',
                'phone_code'  => 1939,
                'timezone'    => 'America/Puerto_Rico',
                'enabled'     => 1,
            ],
            183 => 
            [
                'id'          => 'PS',
                'name'        => 'Palestine State of',
                'code'        => 'PSE',
                'currency_id' => 'ILS',
                'phone_code'  => 970,
                'timezone'    => 'Asia/Gaza',
                'enabled'     => 1,
            ],
            184 => 
            [
                'id'          => 'PT',
                'name'        => 'Portugal',
                'code'        => 'PRT',
                'currency_id' => 'EUR',
                'phone_code'  => 351,
                'timezone'    => 'Atlantic/Madeira',
                'enabled'     => 1,
            ],
            185 => 
            [
                'id'          => 'PW',
                'name'        => 'Palau',
                'code'        => 'PLW',
                'currency_id' => 'USD',
                'phone_code'  => 680,
                'timezone'    => 'Pacific/Palau',
                'enabled'     => 1,
            ],
            186 => 
            [
                'id'          => 'PY',
                'name'        => 'Paraguay',
                'code'        => 'PRY',
                'currency_id' => 'PYG',
                'phone_code'  => 595,
                'timezone'    => 'America/Asuncion',
                'enabled'     => 1,
            ],
            187 => 
            [
                'id'          => 'QA',
                'name'        => 'Qatar',
                'code'        => 'QAT',
                'currency_id' => 'QAR',
                'phone_code'  => 974,
                'timezone'    => 'Asia/Qatar',
                'enabled'     => 1,
            ],
            188 => 
            [
                'id'          => 'RE',
                'name'        => 'Réunion',
                'code'        => 'REU',
                'currency_id' => 'EUR',
                'phone_code'  => 262,
                'timezone'    => 'Indian/Reunion',
                'enabled'     => 1,
            ],
            189 => 
            [
                'id'          => 'RO',
                'name'        => 'Romania',
                'code'        => 'ROU',
                'currency_id' => 'RON',
                'phone_code'  => 40,
                'timezone'    => 'Europe/Bucharest',
                'enabled'     => 1,
            ],
            190 => 
            [
                'id'          => 'RS',
                'name'        => 'Serbia',
                'code'        => 'SRB',
                'currency_id' => 'RSD',
                'phone_code'  => 381,
                'timezone'    => 'Europe/Belgrade',
                'enabled'     => 1,
            ],
            191 => 
            [
                'id'          => 'RU',
                'name'        => 'Russian Federation',
                'code'        => 'RUS',
                'currency_id' => 'RUB',
                'phone_code'  => 7,
                'timezone'    => 'Europe/Moscow',
                'enabled'     => 1,
            ],
            192 => 
            [
                'id'          => 'RW',
                'name'        => 'Rwanda',
                'code'        => 'RWA',
                'currency_id' => 'RWF',
                'phone_code'  => 250,
                'timezone'    => 'Africa/Kigali',
                'enabled'     => 1,
            ],
            193 => 
            [
                'id'          => 'SA',
                'name'        => 'Saudi Arabia',
                'code'        => 'SAU',
                'currency_id' => 'SAR',
                'phone_code'  => 966,
                'timezone'    => 'Asia/Riyadh',
                'enabled'     => 1,
            ],
            194 => 
            [
                'id'          => 'SB',
                'name'        => 'Solomon Islands',
                'code'        => 'SLB',
                'currency_id' => 'SBD',
                'phone_code'  => 677,
                'timezone'    => 'Pacific/Guadalcanal',
                'enabled'     => 1,
            ],
            195 => 
            [
                'id'          => 'SC',
                'name'        => 'Seychelles',
                'code'        => 'SYC',
                'currency_id' => 'SCR',
                'phone_code'  => 248,
                'timezone'    => 'Indian/Mahe',
                'enabled'     => 1,
            ],
            196 => 
            [
                'id'          => 'SD',
                'name'        => 'Sudan',
                'code'        => 'SDN',
                'currency_id' => 'SDG',
                'phone_code'  => 249,
                'timezone'    => 'Africa/Khartoum',
                'enabled'     => 1,
            ],
            197 => 
            [
                'id'          => 'SE',
                'name'        => 'Sweden',
                'code'        => 'SWE',
                'currency_id' => 'SEK',
                'phone_code'  => 46,
                'timezone'    => 'Europe/Stockholm',
                'enabled'     => 1,
            ],
            198 => 
            [
                'id'          => 'SG',
                'name'        => 'Singapore',
                'code'        => 'SGP',
                'currency_id' => 'SGD',
                'phone_code'  => 65,
                'timezone'    => 'Asia/Singapore',
                'enabled'     => 1,
            ],
            199 => 
            [
                'id'          => 'SH',
                'name'        => 'Saint Helena Ascension and Tristan da Cunha',
                'code'        => 'SHN',
                'currency_id' => 'SHP',
                'phone_code'  => 290,
                'timezone'    => 'Atlantic/St_Helena',
                'enabled'     => 1,
            ],
            200 => 
            [
                'id'          => 'SI',
                'name'        => 'Slovenia',
                'code'        => 'SVN',
                'currency_id' => 'EUR',
                'phone_code'  => 386,
                'timezone'    => 'Europe/Ljubljana',
                'enabled'     => 1,
            ],
            201 => 
            [
                'id'          => 'SJ',
                'name'        => 'Svalbard and Jan Mayen',
                'code'        => 'SJM',
                'currency_id' => 'NOK',
                'phone_code'  => 47,
                'timezone'    => 'Arctic/Longyearbyen',
                'enabled'     => 1,
            ],
            202 => 
            [
                'id'          => 'SK',
                'name'        => 'Slovakia',
                'code'        => 'SVK',
                'currency_id' => 'EUR',
                'phone_code'  => 421,
                'timezone'    => 'Europe/Bratislava',
                'enabled'     => 1,
            ],
            203 => 
            [
                'id'          => 'SL',
                'name'        => 'Sierra Leone',
                'code'        => 'SLE',
                'currency_id' => 'SLL',
                'phone_code'  => 232,
                'timezone'    => 'Africa/Freetown',
                'enabled'     => 1,
            ],
            204 => 
            [
                'id'          => 'SM',
                'name'        => 'San Marino',
                'code'        => 'SMR',
                'currency_id' => 'EUR',
                'phone_code'  => 378,
                'timezone'    => 'Europe/San_Marino',
                'enabled'     => 1,
            ],
            205 => 
            [
                'id'          => 'SN',
                'name'        => 'Senegal',
                'code'        => 'SEN',
                'currency_id' => 'XOF',
                'phone_code'  => 221,
                'timezone'    => 'Africa/Dakar',
                'enabled'     => 1,
            ],
            206 => 
            [
                'id'          => 'SO',
                'name'        => 'Somalia',
                'code'        => 'SOM',
                'currency_id' => 'SOS',
                'phone_code'  => 252,
                'timezone'    => 'Africa/Mogadishu',
                'enabled'     => 1,
            ],
            207 => 
            [
                'id'          => 'SR',
                'name'        => 'Suriname',
                'code'        => 'SUR',
                'currency_id' => 'SRD',
                'phone_code'  => 597,
                'timezone'    => 'America/Paramaribo',
                'enabled'     => 1,
            ],
            208 => 
            [
                'id'          => 'SS',
                'name'        => 'South Sudan',
                'code'        => 'SSD',
                'currency_id' => 'SSP',
                'phone_code'  => 211,
                'timezone'    => 'Africa/Juba',
                'enabled'     => 1,
            ],
            209 => 
            [
                'id'          => 'ST',
                'name'        => 'Sao Tome and Principe',
                'code'        => 'STP',
                'currency_id' => 'STD',
                'phone_code'  => 239,
                'timezone'    => 'Africa/Sao_Tome',
                'enabled'     => 1,
            ],
            210 => 
            [
                'id'          => 'SV',
                'name'        => 'El Salvador',
                'code'        => 'SLV',
                'currency_id' => 'USD',
                'phone_code'  => 503,
                'timezone'    => 'America/El_Salvador',
                'enabled'     => 1,
            ],
            211 => 
            [
                'id'          => 'SX',
                'name'        => 'Sint Maarten (Dutch part)',
                'code'        => 'SXM',
                'currency_id' => 'ANG',
                'phone_code'  => 1721,
                'timezone'    => 'America/Curacao',
                'enabled'     => 1,
            ],
            212 => 
            [
                'id'          => 'SY',
                'name'        => 'Syrian Arab Republic',
                'code'        => 'SYR',
                'currency_id' => 'SYP',
                'phone_code'  => 963,
                'timezone'    => 'Asia/Damascus',
                'enabled'     => 1,
            ],
            213 => 
            [
                'id'          => 'SZ',
                'name'        => 'Swaziland',
                'code'        => 'SWZ',
                'currency_id' => 'SZL',
                'phone_code'  => 268,
                'timezone'    => 'Africa/Mbabane',
                'enabled'     => 1,
            ],
            214 => 
            [
                'id'          => 'TC',
                'name'        => 'Turks and Caicos Islands',
                'code'        => 'TCA',
                'currency_id' => 'USD',
                'phone_code'  => 1649,
                'timezone'    => 'America/Grand_Turk',
                'enabled'     => 1,
            ],
            215 => 
            [
                'id'          => 'TD',
                'name'        => 'Chad',
                'code'        => 'TCD',
                'currency_id' => 'XAF',
                'phone_code'  => 235,
                'timezone'    => 'Africa/Ndjamena',
                'enabled'     => 1,
            ],
            216 => 
            [
                'id'          => 'TF',
                'name'        => 'French Southern Territories',
                'code'        => 'ATF',
                'currency_id' => 'EUR',
                'phone_code'  => NULL,
                'timezone'    => 'Indian/Kerguelen',
                'enabled'     => 1,
            ],
            217 => 
            [
                'id'          => 'TG',
                'name'        => 'Togo',
                'code'        => 'TGO',
                'currency_id' => 'XOF',
                'phone_code'  => 228,
                'timezone'    => 'Africa/Lome',
                'enabled'     => 1,
            ],
            218 => 
            [
                'id'          => 'TH',
                'name'        => 'Thailand',
                'code'        => 'THA',
                'currency_id' => 'THB',
                'phone_code'  => 66,
                'timezone'    => 'Asia/Bangkok',
                'enabled'     => 1,
            ],
            219 => 
            [
                'id'          => 'TJ',
                'name'        => 'Tajikistan',
                'code'        => 'TJK',
                'currency_id' => 'TJS',
                'phone_code'  => 992,
                'timezone'    => 'Asia/Dushanbe',
                'enabled'     => 1,
            ],
            220 => 
            [
                'id'          => 'TK',
                'name'        => 'Tokelau',
                'code'        => 'TKL',
                'currency_id' => 'NZD',
                'phone_code'  => 690,
                'timezone'    => 'Pacific/Fakaofo',
                'enabled'     => 1,
            ],
            221 => 
            [
                'id'          => 'TL',
                'name'        => 'Timor-Leste',
                'code'        => 'TLS',
                'currency_id' => 'USD',
                'phone_code'  => 670,
                'timezone'    => 'Asia/Dili',
                'enabled'     => 1,
            ],
            222 => 
            [
                'id'          => 'TM',
                'name'        => 'Turkmenistan',
                'code'        => 'TKM',
                'currency_id' => 'TMT',
                'phone_code'  => 993,
                'timezone'    => 'Asia/Ashgabat',
                'enabled'     => 1,
            ],
            223 => 
            [
                'id'          => 'TN',
                'name'        => 'Tunisia',
                'code'        => 'TUN',
                'currency_id' => 'TND',
                'phone_code'  => 216,
                'timezone'    => 'Africa/Tunis',
                'enabled'     => 1,
            ],
            224 => 
            [
                'id'          => 'TO',
                'name'        => 'Tonga',
                'code'        => 'TON',
                'currency_id' => 'TOP',
                'phone_code'  => 676,
                'timezone'    => 'Pacific/Tongatapu',
                'enabled'     => 1,
            ],
            225 => 
            [
                'id'          => 'TR',
                'name'        => 'Turkey',
                'code'        => 'TUR',
                'currency_id' => 'TRY',
                'phone_code'  => 90,
                'timezone'    => 'Asia/Istanbul',
                'enabled'     => 1,
            ],
            226 => 
            [
                'id'          => 'TT',
                'name'        => 'Trinidad and Tobago',
                'code'        => 'TTO',
                'currency_id' => 'TTD',
                'phone_code'  => 1868,
                'timezone'    => 'America/Port_of_Spain',
                'enabled'     => 1,
            ],
            227 => 
            [
                'id'          => 'TV',
                'name'        => 'Tuvalu',
                'code'        => 'TUV',
                'currency_id' => 'AUD',
                'phone_code'  => 688,
                'timezone'    => 'Pacific/Funafuti',
                'enabled'     => 1,
            ],
            228 => 
            [
                'id'          => 'TW',
                'name'        => 'Taiwan',
                'code'        => 'TWN',
                'currency_id' => 'TWD',
                'phone_code'  => 886,
                'timezone'    => 'Asia/Taipei',
                'enabled'     => 1,
            ],
            229 => 
            [
                'id'          => 'TZ',
                'name'        => 'Tanzania United Republic of',
                'code'        => 'TZA',
                'currency_id' => 'TZS',
                'phone_code'  => 255,
                'timezone'    => 'Africa/Dar_es_Salaam',
                'enabled'     => 1,
            ],
            230 => 
            [
                'id'          => 'UA',
                'name'        => 'Ukraine',
                'code'        => 'UKR',
                'currency_id' => 'UAH',
                'phone_code'  => 380,
                'timezone'    => 'Europe/Kiev',
                'enabled'     => 1,
            ],
            231 => 
            [
                'id'          => 'UG',
                'name'        => 'Uganda',
                'code'        => 'UGA',
                'currency_id' => 'UGX',
                'phone_code'  => 256,
                'timezone'    => 'Africa/Kampala',
                'enabled'     => 1,
            ],
            232 => 
            [
                'id'          => 'UM',
                'name'        => 'United States Minor Outlying Islands',
                'code'        => 'UMI',
                'currency_id' => 'USD',
                'phone_code'  => NULL,
                'timezone'    => 'Pacific/Wake',
                'enabled'     => 1,
            ],
            233 => 
            [
                'id'          => 'US',
                'name'        => 'United States of America',
                'code'        => 'USA',
                'currency_id' => 'USD',
                'phone_code'  => 1,
                'timezone'    => 'America/Los_Angeles',
                'enabled'     => 1,
            ],
            234 => 
            [
                'id'          => 'UY',
                'name'        => 'Uruguay',
                'code'        => 'URY',
                'currency_id' => 'UYU',
                'phone_code'  => 598,
                'timezone'    => 'America/Montevideo',
                'enabled'     => 1,
            ],
            235 => 
            [
                'id'          => 'UZ',
                'name'        => 'Uzbekistan',
                'code'        => 'UZB',
                'currency_id' => 'UZS',
                'phone_code'  => 998,
                'timezone'    => 'Asia/Tashkent',
                'enabled'     => 1,
            ],
            236 => 
            [
                'id'          => 'VA',
                'name'        => 'Holy See',
                'code'        => 'VAT',
                'currency_id' => 'EUR',
                'phone_code'  => 379,
                'timezone'    => 'Europe/Vatican',
                'enabled'     => 1,
            ],
            237 => 
            [
                'id'          => 'VC',
                'name'        => 'Saint Vincent and the Grenadines',
                'code'        => 'VCT',
                'currency_id' => 'XCD',
                'phone_code'  => 1784,
                'timezone'    => 'America/St_Vincent',
                'enabled'     => 1,
            ],
            238 => 
            [
                'id'          => 'VE',
                'name'        => 'Venezuela (Bolivarian Republic of)',
                'code'        => 'VEN',
                'currency_id' => 'VEF',
                'phone_code'  => 58,
                'timezone'    => 'America/Caracas',
                'enabled'     => 1,
            ],
            239 => 
            [
                'id'          => 'VG',
                'name'        => 'Virgin Islands (British)',
                'code'        => 'VGB',
                'currency_id' => 'USD',
                'phone_code'  => 1284,
                'timezone'    => 'America/Tortola',
                'enabled'     => 1,
            ],
            240 => 
            [
                'id'          => 'VI',
                'name'        => 'Virgin Islands (U.S.)',
                'code'        => 'VIR',
                'currency_id' => 'USD',
                'phone_code'  => 1340,
                'timezone'    => 'America/St_Thomas',
                'enabled'     => 1,
            ],
            241 => 
            [
                'id'          => 'VN',
                'name'        => 'Vietnam',
                'code'        => 'VNM',
                'currency_id' => 'VND',
                'phone_code'  => 84,
                'timezone'    => 'Asia/Phnom_Penh',
                'enabled'     => 1,
            ],
            242 => 
            [
                'id'          => 'VU',
                'name'        => 'Vanuatu',
                'code'        => 'VUT',
                'currency_id' => 'VUV',
                'phone_code'  => 678,
                'timezone'    => 'Pacific/Efate',
                'enabled'     => 1,
            ],
            243 => 
            [
                'id'          => 'WF',
                'name'        => 'Wallis and Futuna',
                'code'        => 'WLF',
                'currency_id' => 'XPF',
                'phone_code'  => 681,
                'timezone'    => 'Pacific/Wallis',
                'enabled'     => 1,
            ],
            244 => 
            [
                'id'          => 'WS',
                'name'        => 'Samoa',
                'code'        => 'WSM',
                'currency_id' => 'WST',
                'phone_code'  => 685,
                'timezone'    => 'Pacific/Pago_Pago',
                'enabled'     => 1,
            ],
            245 => 
            [
                'id'          => 'XK',
                'name'        => 'Republic of Kosovo',
                'code'        => 'KOS',
                'currency_id' => 'EUR',
                'phone_code'  => 383,
                'timezone'    => 'Europe/Skopje',
                'enabled'     => 1,
                'deleted_at'  => NULL,
                'created_at'  => NULL,
                'updated_at'  => NULL,
            ],
            246 => 
            [
                'id'          => 'YE',
                'name'        => 'Yemen',
                'code'        => 'YEM',
                'currency_id' => 'YER',
                'phone_code'  => 967,
                'timezone'    => 'Asia/Aden',
                'enabled'     => 1,
            ],
            247 => 
            [
                'id'          => 'YT',
                'name'        => 'Mayotte',
                'code'        => 'MYT',
                'currency_id' => 'EUR',
                'phone_code'  => 262,
                'timezone'    => 'Indian/Mayotte',
                'enabled'     => 1,
            ],
            248 => 
            [
                'id'          => 'ZA',
                'name'        => 'South Africa',
                'code'        => 'ZAF',
                'currency_id' => 'ZAR',
                'phone_code'  => 27,
                'timezone'    => 'Africa/Johannesburg',
                'enabled'     => 1,
            ],
            249 => 
            [
                'id'          => 'ZM',
                'name'        => 'Zambia',
                'code'        => 'ZMB',
                'currency_id' => 'ZMW',
                'phone_code'  => 260,
                'timezone'    => 'Africa/Lusaka',
                'enabled'     => 1,
            ],
            250 => 
            [
                'id'          => 'ZW',
                'name'        => 'Zimbabwe',
                'code'        => 'ZWE',
                'currency_id' => 'ZWL',
                'phone_code'  => 263,
                'timezone'    => 'Africa/Harare',
                'enabled'     => 1,
            ],
        ];
        
        foreach ($list as $item) {
            DB::table('countries')->updateOrInsert([ 'id' => $item['id'] ], $item);
        }
    }
}