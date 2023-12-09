<?php

return [
    /*
     * Atur API key yang dibutuhkan untuk mengakses API Raja Ongkir.
     * Dapatkan API key dengan mengakses halaman panel akun Anda.
     */
    'api_key' => env('RAJAONGKIR_API_KEY', 'some32charstring'),

    /*
     * Atur tipe akun sesuai paket API yang Anda pilih di Raja Ongkir.
     * Pilihan yang tersedia: ['starter', 'basic', 'pro'].
     */
    'package' => env('RAJAONGKIR_PACKAGE', 'starter'),

    /*
     * Atur lokasi kota awal untuk pengiriman.
     * Hanya berisi kode dari id kota dimaksud.
     */ 
    'origin' => 118,

    /*
     * Data jasa pengiriman berdasarkan tipe akun.
     * Pilihan yang tersedia: ['starter', 'basic', 'pro'].
     */ 
    'courier' => [
        'starter' => [
            [
                'kode' => 'jne',
                'nama' => 'JNE',
            ],[
                'kode' => 'pos',
                'nama' => 'POS INDONESIA',
            ],[
                'kode' => 'tiki',
                'nama' => 'TIKI',
            ]
        ],
        'basic' => [
            [
                'kode' => 'jne',
                'nama' => 'JNE',
            ],[
                'kode' => 'pos',
                'nama' => 'POS INDONESIA',
            ],[
                'kode' => 'tiki',
                'nama' => 'TIKI',
            ],[
                'kode' => 'rpx',
                'nama' => 'RPX',

            ],[
                'kode' => 'esl',
                'nama' => 'ESL EXPRESS',

            ],[
                'kode' => 'pcp',
                'nama' => 'PCP EXPRESS',
            ]
        ],
        'pro' => [
            [
                'kode' => 'jne',
                'nama' => 'JNE',
            ],[
                'kode' => 'pos',
                'nama' => 'POS INDONESIA',
            ],[
                'kode' => 'tiki',
                'nama' => 'TIKI',
            ],[
                'kode' => 'rpx',
                'nama' => 'RPX',

            ],[
                'kode' => 'sicepat',
                'nama' => 'SICEPAT',

            ],[
                'kode' => 'jnt',
                'nama' => 'JNT',
            ],[
                'kode' => 'antareja',
                'nama' => 'ANTAREJA',
            ]
        ],
    ]
];
