<?php

namespace Database\Seeders;

use App\Models\Kota;
use App\Models\Salon;
use App\Models\SalonImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SalonSeeder extends Seeder
{
    public function run(): void
    {
        // ── Kota ──────────────────────────────────────────────────────────────
        $kotas = [
            ['nama_kota' => 'Jakarta',   'provinsi' => 'DKI Jakarta'],
            ['nama_kota' => 'Bandung',   'provinsi' => 'Jawa Barat'],
            ['nama_kota' => 'Surabaya',  'provinsi' => 'Jawa Timur'],
            ['nama_kota' => 'Yogyakarta','provinsi' => 'DI Yogyakarta'],
            ['nama_kota' => 'Bali',      'provinsi' => 'Bali'],
        ];

        foreach ($kotas as $kota) {
            Kota::firstOrCreate(['nama_kota' => $kota['nama_kota']], $kota);
        }

        // ── Owner accounts ────────────────────────────────────────────────────
        $owners = [
            ['name' => 'Rina Marlina',   'email' => 'rina@lumiere.test'],
            ['name' => 'Dewi Sartika',   'email' => 'dewi@lumiere.test'],
            ['name' => 'Hana Pratiwi',   'email' => 'hana@lumiere.test'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@lumiere.test'],
            ['name' => 'Laras Wulandari','email' => 'laras@lumiere.test'],
            ['name' => 'Mega Putri',     'email' => 'mega@lumiere.test'],
            ['name' => 'Nadia Cahya',    'email' => 'nadia@lumiere.test'],
            ['name' => 'Rini Susanti',   'email' => 'rini@lumiere.test'],
        ];

        $ownerIds = [];
        foreach ($owners as $owner) {
            $user = User::firstOrCreate(
                ['email' => $owner['email']],
                [
                    'name'     => $owner['name'],
                    'password' => Hash::make('password'),
                    'role'     => 'owner',
                ]
            );
            $ownerIds[] = $user->id;
        }

        // ── Salon data ────────────────────────────────────────────────────────
        // Unsplash images – stable photo IDs (no tracking params needed)
        $salons = [
            [
                'nama_salon' => 'Lumiere Beauty Studio',
                'kota'       => 'Jakarta',
                'alamat'     => 'Jl. Sudirman No. 45, Tanah Abang, Jakarta Pusat',
                'deskripsi'  => 'Salon premium di jantung Jakarta dengan layanan perawatan rambut dan kecantikan modern. Dipercaya lebih dari 5.000 pelanggan sejak 2018.',
                'rating'     => 4.8,
                'jam_buka'   => '09:00',
                'jam_tutup'  => '21:00',
                'latitude'   => -6.2088,
                'longitude'  => 106.8456,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800', 'type' => 'banner',    'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=800', 'type' => 'interior', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=800', 'type' => 'gallery',  'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?w=800', 'type' => 'gallery',  'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Glam House Salon',
                'kota'       => 'Jakarta',
                'alamat'     => 'Jl. Kemang Raya No. 12, Kemang, Jakarta Selatan',
                'deskripsi'  => 'Surga kecantikan di kawasan Kemang. Spesialis hair coloring, nail art, dan perawatan kulit dengan produk internasional.',
                'rating'     => 4.6,
                'jam_buka'   => '10:00',
                'jam_tutup'  => '20:00',
                'latitude'   => -6.2607,
                'longitude'  => 106.8137,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1633681926022-84c23e8cb2d6?w=800', 'type' => 'banner',   'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1595476108010-b4d1f102b1b1?w=800', 'type' => 'interior', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1600948836101-f9ffda59d250?w=800', 'type' => 'gallery',  'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Serene Spa & Salon',
                'kota'       => 'Bandung',
                'alamat'     => 'Jl. Dago No. 88, Coblong, Bandung',
                'deskripsi'  => 'Temukan ketenangan di Serene Spa & Salon. Menawarkan paket lengkap dari hair treatment, facial, hingga full body spa di Dago yang asri.',
                'rating'     => 4.9,
                'jam_buka'   => '08:00',
                'jam_tutup'  => '20:00',
                'latitude'   => -6.8872,
                'longitude'  => 107.6103,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?w=800', 'type' => 'banner',    'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=800', 'type' => 'treatment', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?w=800', 'type' => 'interior',  'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1519823551278-64ac92734fb1?w=800', 'type' => 'gallery',   'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Aura Beauty Lounge',
                'kota'       => 'Bandung',
                'alamat'     => 'Jl. Riau No. 55, Cibeunying, Bandung',
                'deskripsi'  => 'Salon modern berkonsep lounge untuk pengalaman kecantikan yang nyaman dan mewah. Spesialis bridal make-up dan hair styling.',
                'rating'     => 4.5,
                'jam_buka'   => '09:00',
                'jam_tutup'  => '19:00',
                'latitude'   => -6.9147,
                'longitude'  => 107.6098,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1516975080664-ed2fc6a32937?w=800', 'type' => 'banner',   'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1612817288484-6f916006741a?w=800', 'type' => 'interior', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1582095133179-bfd08e2fb6b8?w=800', 'type' => 'gallery',  'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Radiance Salon Surabaya',
                'kota'       => 'Surabaya',
                'alamat'     => 'Jl. Darmo Permai No. 7, Sukomanunggal, Surabaya',
                'deskripsi'  => 'Salon terpercaya di Surabaya Barat dengan tim stylist berpengalaman. Pelayanan ramah dan hasil terbaik untuk setiap pelanggan.',
                'rating'     => 4.7,
                'jam_buka'   => '09:00',
                'jam_tutup'  => '21:00',
                'latitude'   => -7.2756,
                'longitude'  => 112.7270,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800', 'type' => 'banner',    'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1605497788044-5a32c7078486?w=800', 'type' => 'interior', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1610992015732-2449b76344bc?w=800', 'type' => 'gallery',  'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Jogja Cantik Salon',
                'kota'       => 'Yogyakarta',
                'alamat'     => 'Jl. Malioboro No. 120, Gedongtengen, Yogyakarta',
                'deskripsi'  => 'Salon dengan sentuhan budaya Jawa yang kental di jantung Kota Gudeg. Tersedia perawatan tradisional dan modern dalam suasana yang hangat.',
                'rating'     => 4.6,
                'jam_buka'   => '09:00',
                'jam_tutup'  => '20:00',
                'latitude'   => -7.7928,
                'longitude'  => 110.3660,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1527799820374-87036083e756?w=800', 'type' => 'banner',    'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1624374552756-f7b75c2f7e52?w=800', 'type' => 'interior',  'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1610992015749-698d4b7dd3ec?w=800', 'type' => 'treatment', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1601517491119-1ddc40eb0d57?w=800', 'type' => 'gallery',   'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Bali Glow Spa & Salon',
                'kota'       => 'Bali',
                'alamat'     => 'Jl. Oberoi No. 8, Seminyak, Badung, Bali',
                'deskripsi'  => 'Pengalaman spa dan salon terbaik di Seminyak. Nikmati ritual kecantikan khas Bali dengan bahan-bahan alami pilihan dan nuansa tropis yang memanjakan.',
                'rating'     => 5.0,
                'jam_buka'   => '08:00',
                'jam_tutup'  => '22:00',
                'latitude'   => -8.6905,
                'longitude'  => 115.1609,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=800', 'type' => 'banner',    'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1583416750470-965b2707b355?w=800', 'type' => 'interior',  'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?w=800', 'type' => 'treatment', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1552693673-1bf958298935?w=800', 'type' => 'gallery',   'thumb' => false],
                ],
            ],
            [
                'nama_salon' => 'Tropicana Beauty Bar',
                'kota'       => 'Bali',
                'alamat'     => 'Jl. Monkey Forest No. 21, Ubud, Gianyar, Bali',
                'deskripsi'  => 'Beauty bar unik di tengah keindahan alam Ubud. Spesialisasi dalam organic facial, lulur tradisional, dan hair treatment dengan bahan herbal lokal.',
                'rating'     => 4.8,
                'jam_buka'   => '09:00',
                'jam_tutup'  => '21:00',
                'latitude'   => -8.5069,
                'longitude'  => 115.2625,
                'images'     => [
                    ['url' => 'https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?w=800', 'type' => 'banner',    'thumb' => true],
                    ['url' => 'https://images.unsplash.com/photo-1559599101-f09722fb4948?w=800', 'type' => 'interior',  'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1630508963837-c86b3d6e7cc3?w=800', 'type' => 'treatment', 'thumb' => false],
                    ['url' => 'https://images.unsplash.com/photo-1596755389378-c31d21fd1273?w=800', 'type' => 'gallery',   'thumb' => false],
                ],
            ],
        ];

        // ── Insert salons & images ─────────────────────────────────────────────
        foreach ($salons as $index => $data) {
            $kota     = Kota::where('nama_kota', $data['kota'])->first();
            $ownerId  = $ownerIds[$index % count($ownerIds)];

            $salon = Salon::create([
                'owner_id'   => $ownerId,
                'kota_id'    => $kota->kota_id,
                'nama_salon' => $data['nama_salon'],
                'alamat'     => $data['alamat'],
                'deskripsi'  => $data['deskripsi'],
                'rating'     => $data['rating'],
                'jam_buka'   => $data['jam_buka'],
                'jam_tutup'  => $data['jam_tutup'],
                'status'     => 'active',
                'latitude'   => $data['latitude'],
                'longitude'  => $data['longitude'],
            ]);

            foreach ($data['images'] as $img) {
                SalonImage::create([
                    'salon_id'     => $salon->salon_id,
                    'image_path'   => $img['url'],
                    'image_type'   => $img['type'],
                    'is_thumbnail' => $img['thumb'],
                ]);
            }
        }
    }
}
