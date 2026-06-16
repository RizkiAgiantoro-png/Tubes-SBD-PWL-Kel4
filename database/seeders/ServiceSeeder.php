<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Salon;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories ────────────────────────────────────────────────────────
        $categoryNames = [
            'Hair Care',
            'Hair Coloring',
            'Nail Care',
            'Facial & Skin Care',
            'Body Treatment',
            'Makeup',
            'Eyebrow & Eyelash',
            'Waxing & Threading',
        ];

        foreach ($categoryNames as $name) {
            Category::firstOrCreate(['nama_category' => $name]);
        }

        $cat = Category::pluck('category_id', 'nama_category');

        // ── Service templates per category ────────────────────────────────────
        // [ nama_service, durasi (menit), harga_base, deskripsi ]
        $templates = [
            'Hair Care' => [
                ['Creambath',            60,  85000,  'Perawatan rambut dengan krim nutrisi untuk menjaga kelembapan dan kilau rambut.'],
                ['Hair Mask',            45,  75000,  'Masker rambut intensif untuk memperbaiki kerusakan dan menutrisi dari dalam.'],
                ['Keratin Treatment',   120, 350000,  'Perawatan keratin untuk meluruskan dan menghaluskan rambut hingga 3 bulan.'],
                ['Gunting Rambut',       30,  65000,  'Potong rambut sesuai keinginan dengan stylist berpengalaman.'],
                ['Blow Dry & Styling',   45,  80000,  'Blow dry dan styling rambut untuk penampilan sempurna sehari-hari.'],
                ['Hair Spa',             90, 150000,  'Perawatan spa rambut lengkap dengan pijat kepala, masker, dan kondisioner.'],
            ],
            'Hair Coloring' => [
                ['Highlight',           120, 300000,  'Highlight rambut dengan teknik terkini untuk tampilan segar dan modern.'],
                ['Full Color',           90, 250000,  'Mewarnai seluruh rambut dengan pilihan warna terlengkap.'],
                ['Balayage',            150, 500000,  'Teknik pewarnaan balayage untuk gradasi warna natural yang elegan.'],
                ['Ombre',               120, 400000,  'Efek ombre dari gelap ke terang yang trendi dan menawan.'],
                ['Bleaching',            90, 350000,  'Proses bleaching aman untuk persiapan pewarnaan cerah.'],
            ],
            'Nail Care' => [
                ['Manicure',             45,  65000,  'Perawatan kuku tangan lengkap termasuk pembentukan dan pengecatan.'],
                ['Pedicure',             60,  75000,  'Perawatan kuku kaki lengkap dengan scrub dan moisturizer.'],
                ['Nail Art',             60, 120000,  'Desain nail art kreatif sesuai selera dengan berbagai pilihan motif.'],
                ['Gel Nails',            90, 180000,  'Cat kuku gel tahan lama hingga 3 minggu tanpa retak.'],
                ['Nail Extension',      120, 250000,  'Perpanjangan kuku dengan akrilik atau gel untuk tampilan mewah.'],
                ['Manicure & Pedicure', 100, 130000,  'Paket lengkap perawatan kuku tangan dan kaki dengan harga spesial.'],
            ],
            'Facial & Skin Care' => [
                ['Basic Facial',         60, 120000,  'Pembersihan wajah dasar untuk menjaga kecerahan dan kebersihan kulit.'],
                ['Deep Cleansing Facial',90, 180000,  'Facial pembersihan mendalam untuk mengangkat komedo dan kotoran pori-pori.'],
                ['Brightening Facial',   75, 200000,  'Perawatan wajah untuk mencerahkan kulit kusam dan meratakan warna kulit.'],
                ['Anti-Aging Facial',    90, 250000,  'Facial anti-penuaan dengan serum kolagen untuk kulit kencang dan elastis.'],
                ['Acne Treatment',       60, 150000,  'Perawatan khusus untuk kulit berjerawat dengan teknologi LED therapy.'],
            ],
            'Body Treatment' => [
                ['Lulur Tradisional',    90, 180000,  'Lulur khas Jawa dengan rempah-rempah pilihan untuk kulit halus bercahaya.'],
                ['Body Scrub',           60, 150000,  'Eksfoliasi tubuh menyeluruh untuk mengangkat sel kulit mati.'],
                ['Body Massage',         60, 160000,  'Pijat relaksasi tubuh untuk menghilangkan pegal dan stres.'],
                ['Aromatherapy Massage', 90, 220000,  'Pijat aromaterapi dengan essential oil pilihan untuk relaksasi total.'],
                ['Body Wrap',            90, 200000,  'Perawatan body wrap dengan bahan alami untuk melembapkan dan mengencangkan kulit.'],
                ['Full Body Spa',       180, 450000,  'Paket spa lengkap: lulur, masker, pijat, dan mandi susu untuk kesempurnaan perawatan.'],
            ],
            'Makeup' => [
                ['Makeup Natural',       60, 200000,  'Riasan natural sehari-hari yang cantik dan tahan lama.'],
                ['Makeup Party',         90, 350000,  'Riasan pesta glamor untuk penampilan memukau di berbagai acara.'],
                ['Bridal Makeup',       180, 800000,  'Riasan pengantin lengkap dengan trial dan touch-up untuk hari spesialmu.'],
                ['Makeup Wisuda',        90, 300000,  'Riasan wisuda elegan yang tahan dari pagi hingga malam.'],
            ],
            'Eyebrow & Eyelash' => [
                ['Sulam Alis',          120, 500000,  'Sulam alis semi-permanen dengan teknik microblading untuk alis natural sempurna.'],
                ['Eyebrow Threading',    15,  35000,  'Pembentukan alis dengan benang untuk hasil rapi dan presisi.'],
                ['Eyelash Extension',    90, 280000,  'Sambung bulu mata dengan berbagai pilihan efek: natural, wispy, atau volume.'],
                ['Lash Lift & Tint',     60, 200000,  'Angkat dan warnai bulu mata alami untuk tampilan lentik tanpa maskara.'],
            ],
            'Waxing & Threading' => [
                ['Full Leg Waxing',      45, 120000,  'Waxing kaki menyeluruh untuk kulit mulus dan halus tahan 3–4 minggu.'],
                ['Underarm Waxing',      20,  60000,  'Waxing ketiak untuk membersihkan bulu dengan cepat dan minim nyeri.'],
                ['Full Body Waxing',    120, 350000,  'Waxing seluruh tubuh untuk kulit bersih dan halus sempurna.'],
                ['Facial Threading',     30,  50000,  'Threading wajah untuk membersihkan bulu halus dan membentuk alis.'],
            ],
        ];

        // ── Assign services to each salon ─────────────────────────────────────
        // Each salon gets a curated mix of categories with slight price variation
        $salons = Salon::all();

        // Which categories each salon focuses on (by index into $templates keys)
        $salonFocus = [
            // Lumiere Beauty Studio – Jakarta
            0 => ['Hair Care', 'Hair Coloring', 'Facial & Skin Care', 'Makeup'],
            // Glam House Salon – Jakarta
            1 => ['Hair Care', 'Hair Coloring', 'Nail Care', 'Eyebrow & Eyelash'],
            // Serene Spa & Salon – Bandung
            2 => ['Body Treatment', 'Facial & Skin Care', 'Hair Care', 'Waxing & Threading'],
            // Aura Beauty Lounge – Bandung
            3 => ['Makeup', 'Hair Care', 'Nail Care', 'Facial & Skin Care'],
            // Radiance Salon – Surabaya
            4 => ['Hair Care', 'Hair Coloring', 'Nail Care', 'Makeup'],
            // Jogja Cantik Salon
            5 => ['Hair Care', 'Body Treatment', 'Facial & Skin Care', 'Waxing & Threading'],
            // Bali Glow Spa & Salon
            6 => ['Body Treatment', 'Facial & Skin Care', 'Hair Care', 'Eyebrow & Eyelash'],
            // Tropicana Beauty Bar
            7 => ['Body Treatment', 'Facial & Skin Care', 'Nail Care', 'Hair Care'],
        ];

        foreach ($salons as $idx => $salon) {
            $focusCategories = $salonFocus[$idx] ?? array_keys($templates);

            foreach ($focusCategories as $catName) {
                $categoryId = $cat[$catName];
                $services   = $templates[$catName];

                foreach ($services as [$nama, $durasi, $hargaBase, $deskripsi]) {
                    // Small price variation per salon (±10%)
                    $variation = rand(-10, 10) / 100;
                    $harga     = round($hargaBase * (1 + $variation) / 1000) * 1000;

                    Service::create([
                        'salon_id'     => $salon->salon_id,
                        'category_id'  => $categoryId,
                        'nama_service' => $nama,
                        'durasi'       => $durasi,
                        'harga'        => $harga,
                        'deskripsi'    => $deskripsi,
                    ]);
                }
            }
        }
    }
}
