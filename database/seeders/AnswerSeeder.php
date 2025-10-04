<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Question;

class AnswerSeeder extends Seeder
{
    public function run(): void
    {
        $questions = Question::all();

        foreach ($questions as $question) {
            $answers = match ($question->question_text) {
                // =================== OLAHRAGA ===================
                'Siapa pemain dengan gelar Ballon d’Or terbanyak?' => [
                    ['Lionel Messi', true],
                    ['Cristiano Ronaldo', false],
                    ['Luka Modric', false],
                    ['Ronaldinho', false],
                ],
                'Berapa jumlah pemain dalam satu tim sepak bola?' => [
                    ['9', false],
                    ['10', false],
                    ['11', true],
                    ['12', false],
                ],
                'Negara mana yang menjadi tuan rumah Piala Dunia 2022?' => [
                    ['Qatar', true],
                    ['Rusia', false],
                    ['Brasil', false],
                    ['Jepang', false],
                ],
                'Apa nama olahraga yang menggunakan raket dan shuttlecock?' => [
                    ['Tenis', false],
                    ['Bulutangkis', true],
                    ['Squash', false],
                    ['Pingpong', false],
                ],
                'Berapa menit waktu normal pertandingan sepak bola?' => [
                    ['80 menit', false],
                    ['90 menit', true],
                    ['100 menit', false],
                    ['120 menit', false],
                ],
                'Siapa pebulutangkis Indonesia yang dijuluki The Minions?' => [
                    ['Kevin Sanjaya & Marcus Gideon', true],
                    ['Taufik Hidayat', false],
                    ['Jonatan Christie', false],
                    ['Anthony Ginting', false],
                ],
                'Dalam olahraga basket, berapa poin yang didapat dari tembakan 3 poin?' => [
                    ['1', false],
                    ['2', false],
                    ['3', true],
                    ['4', false],
                ],
                'Apa nama ajang olahraga internasional terbesar di dunia?' => [
                    ['Piala Dunia', false],
                    ['Olimpiade', true],
                    ['SEA Games', false],
                    ['Asian Games', false],
                ],
                'Cabang olahraga apa yang dilakukan di kolam renang?' => [
                    ['Renang', true],
                    ['Selam', false],
                    ['Ski air', false],
                    ['Surfing', false],
                ],
                'Siapa pelatih Timnas Indonesia tahun 2024?' => [
                    ['Shin Tae-yong', true],
                    ['Luis Milla', false],
                    ['Indra Sjafri', false],
                    ['Bima Sakti', false],
                ],

                // =================== FILM ===================
                'Film apa yang memenangkan Oscar 2023 untuk Best Picture?' => [
                    ['Oppenheimer', false],
                    ['Everything Everywhere All at Once', true],
                    ['Avatar 2', false],
                    ['Top Gun: Maverick', false],
                ],
                'Siapa sutradara film “Inception”?' => [
                    ['Christopher Nolan', true],
                    ['James Cameron', false],
                    ['Steven Spielberg', false],
                    ['Martin Scorsese', false],
                ],
                'Siapa pemeran utama dalam film “Iron Man”?' => [
                    ['Chris Evans', false],
                    ['Robert Downey Jr.', true],
                    ['Tom Holland', false],
                    ['Mark Ruffalo', false],
                ],
                'Film “Avatar” disutradarai oleh siapa?' => [
                    ['James Cameron', true],
                    ['Ridley Scott', false],
                    ['Peter Jackson', false],
                    ['George Lucas', false],
                ],
                'Apa genre film “The Conjuring”?' => [
                    ['Horror', true],
                    ['Drama', false],
                    ['Komedi', false],
                    ['Romansa', false],
                ],
                'Film “Fast & Furious” berfokus pada tema apa?' => [
                    ['Balapan & Keluarga', true],
                    ['Perang', false],
                    ['Petualangan luar angkasa', false],
                    ['Politik', false],
                ],
                'Siapa tokoh utama dalam film “Harry Potter”?' => [
                    ['Harry Potter', true],
                    ['Hermione Granger', false],
                    ['Ron Weasley', false],
                    ['Draco Malfoy', false],
                ],
                'Apa nama planet dalam film “Avatar”?' => [
                    ['Pandora', true],
                    ['Andromeda', false],
                    ['Naboo', false],
                    ['Zion', false],
                ],
                'Film “Joker” diperankan oleh aktor siapa?' => [
                    ['Joaquin Phoenix', true],
                    ['Heath Ledger', false],
                    ['Christian Bale', false],
                    ['Tom Hardy', false],
                ],
                'Studio apa yang memproduksi film animasi “Toy Story”?' => [
                    ['Pixar', true],
                    ['DreamWorks', false],
                    ['Disney Channel', false],
                    ['Illumination', false],
                ],

                // =================== MUSIK ===================
                'Siapa penyanyi lagu “Shape of You”?' => [
                    ['Ed Sheeran', true],
                    ['Justin Bieber', false],
                    ['Bruno Mars', false],
                    ['Adele', false],
                ],
                'Genre musik apa yang dibawakan oleh BTS?' => [
                    ['Rock', false],
                    ['Pop', false],
                    ['K-Pop', true],
                    ['Jazz', false],
                ],
                'Siapa penyanyi Indonesia yang terkenal dengan lagu “Cinta Luar Biasa”?' => [
                    ['Judika', false],
                    ['Andmesh Kamaleng', true],
                    ['Ari Lasso', false],
                    ['Afgan', false],
                ],
                'Alat musik gitar termasuk ke dalam jenis apa?' => [
                    ['Tiup', false],
                    ['Petik', true],
                    ['Pukul', false],
                    ['Gesek', false],
                ],
                'Apa judul lagu terkenal dari Michael Jackson?' => [
                    ['Thriller', true],
                    ['Perfect', false],
                    ['Shape of You', false],
                    ['My Heart Will Go On', false],
                ],
                'Musisi mana yang dikenal sebagai “King of Pop”?' => [
                    ['Michael Jackson', true],
                    ['Elvis Presley', false],
                    ['Bruno Mars', false],
                    ['Justin Timberlake', false],
                ],
                'Apa fungsi metronome dalam musik?' => [
                    ['Mengatur tempo', true],
                    ['Menambah efek suara', false],
                    ['Menyimpan nada', false],
                    ['Mengubah pitch', false],
                ],
                'Apa nama alat musik tiup dari logam yang sering digunakan dalam marching band?' => [
                    ['Trompet', true],
                    ['Gitar', false],
                    ['Drum', false],
                    ['Suling', false],
                ],
                'Siapa pencipta lagu kebangsaan Indonesia Raya?' => [
                    ['W.R. Supratman', true],
                    ['Ismail Marzuki', false],
                    ['Soekarno', false],
                    ['Hatta', false],
                ],
                'Musik dangdut berasal dari negara mana?' => [
                    ['Indonesia', true],
                    ['India', false],
                    ['Arab Saudi', false],
                    ['Malaysia', false],
                ],

                // =================== FASHION ===================
                'Siapa desainer terkenal asal Prancis dengan logo dua huruf “CC”?' => [
                    ['Christian Dior', false],
                    ['Chanel (Coco Chanel)', true],
                    ['Louis Vuitton', false],
                    ['Yves Saint Laurent', false],
                ],
                'Apa nama pakaian khas Jepang?' => [
                    ['Kimono', true],
                    ['Hanbok', false],
                    ['Sari', false],
                    ['Cheongsam', false],
                ],
                'Sepatu “Air Jordan” terinspirasi dari atlet siapa?' => [
                    ['Kobe Bryant', false],
                    ['Michael Jordan', true],
                    ['LeBron James', false],
                    ['Shaquille O’Neal', false],
                ],
                'Apa nama bahan dasar jeans?' => [
                    ['Katun Denim', true],
                    ['Wol', false],
                    ['Linen', false],
                    ['Polyester', false],
                ],
                'Apa fungsi dari catwalk dalam dunia fashion?' => [
                    ['Tempat peragaan busana', true],
                    ['Tempat penjualan pakaian', false],
                    ['Tempat wawancara model', false],
                    ['Tempat produksi pakaian', false],
                ],
                'Brand fashion apa yang memiliki logo huruf “LV”?' => [
                    ['Louis Vuitton', true],
                    ['Versace', false],
                    ['Gucci', false],
                    ['Balenciaga', false],
                ],
                'Siapa desainer terkenal yang mendirikan brand “Dior”?' => [
                    ['Christian Dior', true],
                    ['Coco Chanel', false],
                    ['Karl Lagerfeld', false],
                    ['Ralph Lauren', false],
                ],
                'Apa istilah untuk tren berpakaian yang sedang populer?' => [
                    ['Fashion Trend', true],
                    ['Style Board', false],
                    ['Catwalk', false],
                    ['Runway', false],
                ],
                'Apa nama pakaian adat khas Bali?' => [
                    ['Kebaya Bali', true],
                    ['Ulos', false],
                    ['Songket', false],
                    ['Beskap', false],
                ],
                'Apa warna dasar seragam formal pria?' => [
                    ['Hitam', true],
                    ['Merah', false],
                    ['Kuning', false],
                    ['Hijau', false],
                ],

                // =================== SCIENCE ===================
                'Apa rumus kimia untuk air?' => [
                    ['H2O', true],
                    ['CO2', false],
                    ['O2', false],
                    ['NaCl', false],
                ],
                'Siapa penemu bola lampu?' => [
                    ['Nikola Tesla', false],
                    ['Thomas Alva Edison', true],
                    ['Albert Einstein', false],
                    ['Alexander Graham Bell', false],
                ],
                'Planet terbesar di tata surya adalah?' => [
                    ['Jupiter', true],
                    ['Saturnus', false],
                    ['Neptunus', false],
                    ['Bumi', false],
                ],
                'Apa satuan gaya dalam fisika?' => [
                    ['Newton (N)', true],
                    ['Joule', false],
                    ['Pascal', false],
                    ['Watt', false],
                ],
                'Proses perubahan air menjadi uap disebut?' => [
                    ['Evaporasi', true],
                    ['Kondensasi', false],
                    ['Sublimasi', false],
                    ['Presipitasi', false],
                ],
                'Apa nama alat untuk mengukur suhu?' => [
                    ['Termometer', true],
                    ['Barometer', false],
                    ['Higrometer', false],
                    ['Voltmeter', false],
                ],
                'Gas apa yang paling banyak di atmosfer Bumi?' => [
                    ['Nitrogen', true],
                    ['Oksigen', false],
                    ['Karbon Dioksida', false],
                    ['Argon', false],
                ],
                'Berapa kecepatan cahaya?' => [
                    ['300.000 km/s', true],
                    ['150.000 km/s', false],
                    ['1.000.000 km/s', false],
                    ['30.000 km/s', false],
                ],
                'Bagian sel yang mengandung DNA disebut?' => [
                    ['Nukleus', true],
                    ['Mitokondria', false],
                    ['Ribosom', false],
                    ['Sitoplasma', false],
                ],
                'Siapa ilmuwan yang menemukan teori relativitas?' => [
                    ['Albert Einstein', true],
                    ['Isaac Newton', false],
                    ['Galileo Galilei', false],
                    ['Nikola Tesla', false],
                ],

                // =================== SEJARAH ===================
                'Siapa proklamator kemerdekaan Indonesia?' => [
                    ['Soekarno & Mohammad Hatta', true],
                    ['Jenderal Sudirman', false],
                    ['Bung Tomo', false],
                    ['Sutan Syahrir', false],
                ],
                'Kapan Indonesia merdeka?' => [
                    ['17 Agustus 1945', true],
                    ['1 Juni 1945', false],
                    ['20 Mei 1908', false],
                    ['28 Oktober 1928', false],
                ],
                'Kerajaan Hindu tertua di Indonesia adalah?' => [
                    ['Kutai', true],
                    ['Majapahit', false],
                    ['Sriwijaya', false],
                    ['Mataram Kuno', false],
                ],
                'Apa nama perjanjian yang mengakui kedaulatan Indonesia oleh Belanda?' => [
                    ['Konferensi Meja Bundar (KMB)', true],
                    ['Linggarjati', false],
                    ['Renville', false],
                    ['Roem-Royen', false],
                ],
                'Siapa presiden pertama Republik Indonesia?' => [
                    ['Ir. Soekarno', true],
                    ['Mohammad Hatta', false],
                    ['BJ Habibie', false],
                    ['Suharto', false],
                ],
                'Perang Diponegoro terjadi pada tahun berapa?' => [
                    ['1825-1830', true],
                    ['1908', false],
                    ['1945', false],
                    ['1965', false],
                ],
                'Kapan G30S/PKI terjadi?' => [
                    ['1965', true],
                    ['1945', false],
                    ['1950', false],
                    ['1970', false],
                ],
                'Siapa tokoh yang dikenal sebagai Bapak Pendidikan Nasional?' => [
                    ['Ki Hajar Dewantara', true],
                    ['Mohammad Yamin', false],
                    ['Tan Malaka', false],
                    ['Ahmad Dahlan', false],
                ],
                'Apa nama naskah proklamasi kemerdekaan Indonesia?' => [
                    ['Teks Proklamasi', true],
                    ['Piagam Jakarta', false],
                    ['UUD 1945', false],
                    ['Naskah Sumpah Pemuda', false],
                ],
                'Dimana teks proklamasi diketik?' => [
                    ['Rumah Laksamana Maeda', true],
                    ['Istana Merdeka', false],
                    ['Gedung MPR/DPR', false],
                    ['Gedung Sumpah Pemuda', false],
                ],


                default => [],
            };

            foreach ($answers as [$text, $isCorrect]) {
                DB::table('answers')->insert([
                    'question_id' => $question->id,
                    'answer_text' => $text,
                    'is_correct' => $isCorrect,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
