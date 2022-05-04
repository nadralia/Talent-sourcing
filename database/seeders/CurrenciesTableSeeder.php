<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     *
     * @return void
     */
    public function run()
    {
      $list = [
        0 => 
        [
            'id'      => 'AED',
            'name'    => 'United Arab Emirates Dirham',
            'enabled' => 1,
        ],
        1 => 
        [
            'id'      => 'AFN',
            'name'    => 'Afghanistan Afghani',
            'enabled' => 1,
        ],
        2 => 
        [
            'id'      => 'ALL',
            'name'    => 'Albania Lek',
            'enabled' => 1,
        ],
        3 => 
        [
            'id'      => 'AMD',
            'name'    => 'Armenia Dram',
            'enabled' => 1,
        ],
        4 => 
        [
            'id'      => 'ANG',
            'name'    => 'Netherlands Antilles Guilder',
            'enabled' => 1,
        ],
        5 => 
        [
            'id'      => 'AOA',
            'name'    => 'Angola Kwanza',
            'enabled' => 1,
        ],
        6 => 
        [
            'id'      => 'ARS',
            'name'    => 'Argentina Peso',
            'enabled' => 1,
        ],
        7 => 
        [
            'id'      => 'AUD',
            'name'    => 'Australia Dollar',
            'enabled' => 1,
        ],
        8 => 
        [
            'id'      => 'AWG',
            'name'    => 'Aruba Guilder',
            'enabled' => 1,
        ],
        9 => 
        [
            'id'      => 'AZN',
            'name'    => 'Azerbaijan Manat',
            'enabled' => 1,
        ],
        10 => 
        [
            'id'      => 'BAM',
            'name'    => 'Convertible Mark',
            'enabled' => 1,
        ],
        11 => 
        [
            'id'      => 'BBD',
            'name'    => 'Barbados Dollar',
            'enabled' => 1,
        ],
        12 => 
        [
            'id'      => 'BDT',
            'name'    => 'Bangladesh Taka',
            'enabled' => 1,
        ],
        13 => 
        [
            'id'      => 'BGN',
            'name'    => 'Bulgaria Lev',
            'enabled' => 1,
        ],
        14 => 
        [
            'id'      => 'BHD',
            'name'    => 'Bahrain Dinar',
            'enabled' => 1,
        ],
        15 => 
        [
            'id'      => 'BIF',
            'name'    => 'Burundi Franc',
            'enabled' => 1,
        ],
        16 => 
        [
            'id'      => 'BMD',
            'name'    => 'Bermuda Dollar',
            'enabled' => 1,
        ],
        17 => 
        [
            'id'      => 'BND',
            'name'    => 'Brunei Darussalam Dollar',
            'enabled' => 1,
        ],
        18 => 
        [
            'id'      => 'BOB',
            'name'    => 'Bolivia Bolíviano',
            'enabled' => 1,
        ],
        19 => 
        [
            'id'      => 'BRL',
            'name'    => 'Brazil Real',
            'enabled' => 1,
        ],
        20 => 
        [
            'id'      => 'BSD',
            'name'    => 'Bahamas Dollar',
            'enabled' => 1,
        ],
        21 => 
        [
            'id'      => 'BTN',
            'name'    => 'Bhutan Ngultrum',
            'enabled' => 1,
        ],
        22 => 
        [
            'id'      => 'BWP',
            'name'    => 'Botswana Pula',
            'enabled' => 1,
        ],
        23 => 
        [
            'id'      => 'BYN',
            'name'    => 'Belarus Ruble',
            'enabled' => 1,
        ],
        24 => 
        [
            'id'      => 'BZD',
            'name'    => 'Belize Dollar',
            'enabled' => 1,
        ],
        25 => 
        [
            'id'      => 'CAD',
            'name'    => 'Canada Dollar',
            'enabled' => 1,
        ],
        26 => 
        [
            'id'      => 'CDF',
            'name'    => 'Congolese Franc',
            'enabled' => 1,
        ],
        27 => 
        [
            'id'      => 'CHF',
            'name'    => 'Swiss Franc',
            'enabled' => 1,
        ],
        28 => 
        [
            'id'      => 'CLP',
            'name'    => 'Chile Peso',
            'enabled' => 1,
        ],
        29 => 
        [
            'id'      => 'CNY',
            'name'    => 'China Yuan Renminbi',
            'enabled' => 1,
        ],
        30 => 
        [
            'id'      => 'COP',
            'name'    => 'Colombia Peso',
            'enabled' => 1,
        ],
        31 => 
        [
            'id'      => 'CRC',
            'name'    => 'Costa Rica Colon',
            'enabled' => 1,
        ],
        32 => 
        [
            'id'      => 'CUP',
            'name'    => 'Cuba Peso',
            'enabled' => 1,
        ],
        33 => 
        [
            'id'      => 'CVE',
            'name'    => 'Cape Verde Escudo',
            'enabled' => 1,
        ],
        34 => 
        [
            'id'      => 'CZK',
            'name'    => 'Czech Republic Koruna',
            'enabled' => 1,
        ],
        35 => 
        [
            'id'      => 'DJF',
            'name'    => 'Djibouti Franc',
            'enabled' => 1,
        ],
        36 => 
        [
            'id'      => 'DKK',
            'name'    => 'Denmark Krone',
            'enabled' => 1,
        ],
        37 => 
        [
            'id'      => 'DOP',
            'name'    => 'Dominican Republic Peso',
            'enabled' => 1,
        ],
        38 => 
        [
            'id'      => 'DZD',
            'name'    => 'Algeria Dinar',
            'enabled' => 1,
        ],
        39 => 
        [
            'id'      => 'EGP',
            'name'    => 'Egypt Pound',
            'enabled' => 1,
        ],
        40 => 
        [
            'id'      => 'ERN',
            'name'    => 'Eritrea Nakfa',
            'enabled' => 1,
        ],
        41 => 
        [
            'id'      => 'ETB',
            'name'    => 'Ethiopia Birr',
            'enabled' => 1,
        ],
        42 => 
        [
            'id'      => 'EUR',
            'name'    => 'Euro Member Countries',
            'enabled' => 1,
        ],
        43 => 
        [
            'id'      => 'FJD',
            'name'    => 'Fiji Dollar',
            'enabled' => 1,
        ],
        44 => 
        [
            'id'      => 'FKP',
            'name'    => 'Falkland Islands (Malvinas) Pound',
            'enabled' => 1,
        ],
        45 => 
        [
            'id'      => 'GBP',
            'name'    => 'Pound Sterling',
            'enabled' => 1,
        ],
        46 => 
        [
            'id'      => 'GEL',
            'name'    => 'Georgia Lari',
            'enabled' => 1,
        ],
        47 => 
        [
            'id'      => 'GHS',
            'name'    => 'Ghana Cedi',
            'enabled' => 1,
        ],
        48 => 
        [
            'id'      => 'GIP',
            'name'    => 'Gibraltar Pound',
            'enabled' => 1,
        ],
        49 => 
        [
            'id'      => 'GMD',
            'name'    => 'Gambia Dalasi',
            'enabled' => 1,
        ],
        50 => 
        [
            'id'      => 'GNF',
            'name'    => 'Guinea Franc',
            'enabled' => 1,
        ],
        51 => 
        [
            'id'      => 'GTQ',
            'name'    => 'Guatemala Quetzal',
            'enabled' => 1,
        ],
        52 => 
        [
            'id'      => 'GYD',
            'name'    => 'Guyana Dollar',
            'enabled' => 1,
        ],
        53 => 
        [
            'id'      => 'HKD',
            'name'    => 'Hong Kong Dollar',
            'enabled' => 1,
        ],
        54 => 
        [
            'id'      => 'HNL',
            'name'    => 'Honduras Lempira',
            'enabled' => 1,
        ],
        55 => 
        [
            'id'      => 'HRK',
            'name'    => 'Croatia Kuna',
            'enabled' => 1,
        ],
        56 => 
        [
            'id'      => 'HTG',
            'name'    => 'Haiti Gourde',
            'enabled' => 1,
        ],
        57 => 
        [
            'id'      => 'HUF',
            'name'    => 'Hungary Forint',
            'enabled' => 1,
        ],
        58 => 
        [
            'id'      => 'IDR',
            'name'    => 'Indonesia Rupiah',
            'enabled' => 1,
        ],
        59 => 
        [
            'id'      => 'ILS',
            'name'    => 'Israel Shekel',
            'enabled' => 1,
        ],
        60 => 
        [
            'id'      => 'INR',
            'name'    => 'India Rupee',
            'enabled' => 1,
        ],
        61 => 
        [
            'id'      => 'IQD',
            'name'    => 'Iraq Dinar',
            'enabled' => 1,
        ],
        62 => 
        [
            'id'      => 'IRR',
            'name'    => 'Iran Rial',
            'enabled' => 1,
        ],
        63 => 
        [
            'id'      => 'ISK',
            'name'    => 'Iceland Krona',
            'enabled' => 1,
        ],
        64 => 
        [
            'id'      => 'JMD',
            'name'    => 'Jamaica Dollar',
            'enabled' => 1,
        ],
        65 => 
        [
            'id'      => 'JOD',
            'name'    => 'Jordan Dinar',
            'enabled' => 1,
        ],
        66 => 
        [
            'id'      => 'JPY',
            'name'    => 'Japan Yen',
            'enabled' => 1,
        ],
        67 => 
        [
            'id'      => 'KES',
            'name'    => 'Kenya Shilling',
            'enabled' => 1,
        ],
        68 => 
        [
            'id'      => 'KGS',
            'name'    => 'Kyrgyzstan Som',
            'enabled' => 1,
        ],
        69 => 
        [
            'id'      => 'KHR',
            'name'    => 'Cambodia Riel',
            'enabled' => 1,
        ],
        70 => 
        [
            'id'      => 'KMF',
            'name'    => 'Comorian Franc',
            'enabled' => 1,
        ],
        71 => 
        [
            'id'      => 'KPW',
            'name'    => 'Korea (North) Won',
            'enabled' => 1,
        ],
        72 => 
        [
            'id'      => 'KRW',
            'name'    => 'Korea (South) Won',
            'enabled' => 1,
        ],
        73 => 
        [
            'id'      => 'KWD',
            'name'    => 'Kuwait Dinar',
            'enabled' => 1,
        ],
        74 => 
        [
            'id'      => 'KYD',
            'name'    => 'Cayman Islands Dollar',
            'enabled' => 1,
        ],
        75 => 
        [
            'id'      => 'KZT',
            'name'    => 'Kazakhstan Tenge',
            'enabled' => 1,
        ],
        76 => 
        [
            'id'      => 'LAK',
            'name'    => 'Laos Kip',
            'enabled' => 1,
        ],
        77 => 
        [
            'id'      => 'LBP',
            'name'    => 'Lebanon Pound',
            'enabled' => 1,
        ],
        78 => 
        [
            'id'      => 'LKR',
            'name'    => 'Sri Lankan Rupee',
            'enabled' => 1,
        ],
        79 => 
        [
            'id'      => 'LRD',
            'name'    => 'Liberia Dollar',
            'enabled' => 1,
        ],
        80 => 
        [
            'id'      => 'LSL',
            'name'    => 'Lesotho Loti',
            'enabled' => 1,
        ],
        81 => 
        [
            'id'      => 'LYD',
            'name'    => 'Libya Dinar',
            'enabled' => 1,
        ],
        82 => 
        [
            'id'      => 'MAD',
            'name'    => 'Morocco Dirham',
            'enabled' => 1,
        ],
        83 => 
        [
            'id'      => 'MDL',
            'name'    => 'Moldova Leu',
            'enabled' => 1,
        ],
        84 => 
        [
            'id'      => 'MGA',
            'name'    => 'Madagascar Ariary',
            'enabled' => 1,
        ],
        85 => 
        [
            'id'      => 'MKD',
            'name'    => 'Macedonia Denar',
            'enabled' => 1,
        ],
        86 => 
        [
            'id'      => 'MMK',
            'name'    => 'Myanmar (Burma) Kyat',
            'enabled' => 1,
        ],
        87 => 
        [
            'id'      => 'MNT',
            'name'    => 'Mongolia Tughrik',
            'enabled' => 1,
        ],
        88 => 
        [
            'id'      => 'MOP',
            'name'    => 'Macau Pataca',
            'enabled' => 1,
        ],
        89 => 
        [
            'id'      => 'MRO',
            'name'    => 'Mauritanian Ouguiya',
            'enabled' => 1,
        ],
        90 => 
        [
            'id'      => 'MUR',
            'name'    => 'Mauritius Rupee',
            'enabled' => 1,
        ],
        91 => 
        [
            'id'      => 'MVR',
            'name'    => 'Maldives (Maldive Islands) Rufiyaa',
            'enabled' => 1,
        ],
        92 => 
        [
            'id'      => 'MWK',
            'name'    => 'Malawi Kwacha',
            'enabled' => 1,
        ],
        93 => 
        [
            'id'      => 'MXN',
            'name'    => 'Mexico Peso',
            'enabled' => 1,
        ],
        94 => 
        [
            'id'      => 'MYR',
            'name'    => 'Malaysia Ringgit',
            'enabled' => 1,
        ],
        95 => 
        [
            'id'      => 'MZN',
            'name'    => 'Mozambique Metical',
            'enabled' => 1,
        ],
        96 => 
        [
            'id'      => 'NAD',
            'name'    => 'Namibia Dollar',
            'enabled' => 1,
        ],
        97 => 
        [
            'id'      => 'NGN',
            'name'    => 'Nigeria Naira',
            'enabled' => 1,
        ],
        98 => 
        [
            'id'      => 'NIO',
            'name'    => 'Nicaragua Cordoba',
            'enabled' => 1,
        ],
        99 => 
        [
            'id'      => 'NOK',
            'name'    => 'Norway Krone',
            'enabled' => 1,
        ],
        100 => 
        [
            'id'      => 'NPR',
            'name'    => 'Nepal Rupee',
            'enabled' => 1,
        ],
        101 => 
        [
            'id'      => 'NZD',
            'name'    => 'New Zealand Dollar',
            'enabled' => 1,
        ],
        102 => 
        [
            'id'      => 'OMR',
            'name'    => 'Oman Rial',
            'enabled' => 1,
        ],
        103 => 
        [
            'id'      => 'PAB',
            'name'    => 'Panama Balboa',
            'enabled' => 1,
        ],
        104 => 
        [
            'id'      => 'PEN',
            'name'    => 'Peru Sol',
            'enabled' => 1,
        ],
        105 => 
        [
            'id'      => 'PGK',
            'name'    => 'Papua New Guinea Kina',
            'enabled' => 1,
        ],
        106 => 
        [
            'id'      => 'PHP',
            'name'    => 'Philippines Peso',
            'enabled' => 1,
        ],
        107 => 
        [
            'id'      => 'PKR',
            'name'    => 'Pakistan Rupee',
            'enabled' => 1,
        ],
        108 => 
        [
            'id'      => 'PLN',
            'name'    => 'Poland Zloty',
            'enabled' => 1,
        ],
        109 => 
        [
            'id'      => 'PYG',
            'name'    => 'Paraguay Guarani',
            'enabled' => 1,
        ],
        110 => 
        [
            'id'      => 'QAR',
            'name'    => 'Qatar Riyal',
            'enabled' => 1,
        ],
        111 => 
        [
            'id'      => 'RON',
            'name'    => 'Romania Leu',
            'enabled' => 1,
        ],
        112 => 
        [
            'id'      => 'RSD',
            'name'    => 'Serbia Dinar',
            'enabled' => 1,
        ],
        113 => 
        [
            'id'      => 'RUB',
            'name'    => 'Russia Ruble',
            'enabled' => 1,
        ],
        114 => 
        [
            'id'      => 'RWF',
            'name'    => 'Rwanda Franc',
            'enabled' => 1,
        ],
        115 => 
        [
            'id'      => 'SAR',
            'name'    => 'Saudi Arabia Riyal',
            'enabled' => 1,
        ],
        116 => 
        [
            'id'      => 'SBD',
            'name'    => 'Solomon Islands Dollar',
            'enabled' => 1,
        ],
        117 => 
        [
            'id'      => 'SCR',
            'name'    => 'Seychelles Rupee',
            'enabled' => 1,
        ],
        118 => 
        [
            'id'      => 'SDG',
            'name'    => 'Sudanese Pound',
            'enabled' => 1,
        ],
        119 => 
        [
            'id'      => 'SEK',
            'name'    => 'Swedish Krona',
            'enabled' => 1,
        ],
        120 => 
        [
            'id'      => 'SGD',
            'name'    => 'Singapore Dollar',
            'enabled' => 1,
        ],
        121 => 
        [
            'id'      => 'SHP',
            'name'    => 'Saint Helena Pound',
            'enabled' => 1,
        ],
        122 => 
        [
            'id'      => 'SLL',
            'name'    => 'Sierra Leone Leone',
            'enabled' => 1,
        ],
        123 => 
        [
            'id'      => 'SOS',
            'name'    => 'Somalia Shilling',
            'enabled' => 1,
        ],
        124 => 
        [
            'id'      => 'SRD',
            'name'    => 'Surinamese Dollar',
            'enabled' => 1,
        ],
        125 => 
        [
            'id'      => 'SSP',
            'name'    => 'South Sudanese Pound',
            'enabled' => 1,
        ],
        126 => 
        [
            'id'      => 'STD',
            'name'    => 'Dobra',
            'enabled' => 1,
        ],
        127 => 
        [
            'id'      => 'SYP',
            'name'    => 'Syrian Pound',
            'enabled' => 1,
        ],
        128 => 
        [
            'id'      => 'SZL',
            'name'    => 'eSwatini Lilangeni',
            'enabled' => 1,
        ],
        129 => 
        [
            'id'      => 'THB',
            'name'    => 'Thai Baht',
            'enabled' => 1,
        ],
        130 => 
        [
            'id'      => 'TJS',
            'name'    => 'Tajikistani Somoni',
            'enabled' => 1,
        ],
        131 => 
        [
            'id'      => 'TMT',
            'name'    => 'Turkmenistani Manat',
            'enabled' => 1,
        ],
        132 => 
        [
            'id'      => 'TND',
            'name'    => 'Tunisian Dinar',
            'enabled' => 1,
        ],
        133 => 
        [
            'id'      => 'TOP',
            'name'    => 'Pa’anga',
            'enabled' => 1,
        ],
        134 => 
        [
            'id'      => 'TRY',
            'name'    => 'Turkish Lira',
            'enabled' => 1,
        ],
        135 => 
        [
            'id'      => 'TTD',
            'name'    => 'Trinidad and Tobago Dollar',
            'enabled' => 1,
        ],
        136 => 
        [
            'id'      => 'TWD',
            'name'    => 'New Taiwan Dollar',
            'enabled' => 1,
        ],
        137 => 
        [
            'id'      => 'TZS',
            'name'    => 'Tanzanian Shilling',
            'enabled' => 1,
        ],
        138 => 
        [
            'id'      => 'UAH',
            'name'    => 'Hryvnia',
            'enabled' => 1,
        ],
        139 => 
        [
            'id'      => 'UGX',
            'name'    => 'Uganda Shilling',
            'enabled' => 1,
        ],
        140 => 
        [
            'id'      => 'USD',
            'name'    => 'US Dollar',
            'enabled' => 1,
        ],
        141 => 
        [
            'id'      => 'UYU',
            'name'    => 'Peso Uruguayo',
            'enabled' => 1,
        ],
        142 => 
        [
            'id'      => 'UZS',
            'name'    => 'Uzbekistan Sum',
            'enabled' => 1,
        ],
        143 => 
        [
            'id'      => 'VEF',
            'name'    => 'Bolivar',
            'enabled' => 1,
        ],
        144 => 
        [
            'id'      => 'VND',
            'name'    => 'Dong',
            'enabled' => 1,
        ],
        145 => 
        [
            'id'      => 'VUV',
            'name'    => 'Vatu',
            'enabled' => 1,
        ],
        146 => 
        [
            'id'      => 'WST',
            'name'    => 'Samoa Tala',
            'enabled' => 1,
        ],
        147 => 
        [
            'id'      => 'XAF',
            'name'    => 'CFA Franc BEAC',
            'enabled' => 1,
        ],
        148 => 
        [
            'id'      => 'XCD',
            'name'    => 'East Caribbean Dollar',
            'enabled' => 1,
        ],
        149 => 
        [
            'id'      => 'XOF',
            'name'    => 'CFA Franc BCEAO',
            'enabled' => 1,
        ],
        150 => 
        [
            'id'      => 'XPF',
            'name'    => 'CFP Franc',
            'enabled' => 1,
        ],
        151 => 
        [
            'id'      => 'YER',
            'name'    => 'Yemeni Rial',
            'enabled' => 1,
        ],
        152 => 
        [
            'id'      => 'ZAR',
            'name'    => 'South Africa Rand',
            'enabled' => 1,
        ],
        153 => 
        [
            'id'      => 'ZMW',
            'name'    => 'Zambian Kwacha',
            'enabled' => 1,
        ],
        154 => 
        [
            'id'      => 'ZWL',
            'name'    => 'Zimbabwe Dollar',
            'enabled' => 1,
        ],
    ];

        foreach ($list as $item) {
            DB::table('currencies')->updateOrInsert([ 'id' => $item['id'] ], $item);
        }
    }
}
