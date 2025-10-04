<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = Quiz::all();

        foreach ($quizzes as $quiz) {
            $questions = match ($quiz->title) {
                'Quiz Olahraga' => [
                    'Siapa pemain dengan gelar Ballon d’Or terbanyak?',
                    'Berapa jumlah pemain dalam satu tim sepak bola?',
                    'Negara mana yang menjadi tuan rumah Piala Dunia 2022?',
                    'Apa nama olahraga yang menggunakan raket dan shuttlecock?',
                    'Berapa menit waktu normal pertandingan sepak bola?',
                    'Siapa pebulutangkis Indonesia yang dijuluki The Minions?',
                    'Dalam olahraga basket, berapa poin yang didapat dari tembakan 3 poin?',
                    'Apa nama ajang olahraga internasional terbesar di dunia?',
                    'Cabang olahraga apa yang dilakukan di kolam renang?',
                    'Siapa pelatih Timnas Indonesia tahun 2024?',
                ],
                'Quiz Film' => [
                    'Film apa yang memenangkan Oscar 2023 untuk Best Picture?',
                    'Siapa sutradara film “Inception”?',
                    'Siapa pemeran utama dalam film “Iron Man”?',
                    'Film “Avatar” disutradarai oleh siapa?',
                    'Apa genre film “The Conjuring”?',
                    'Film “Fast & Furious” berfokus pada tema apa?',
                    'Siapa tokoh utama dalam film “Harry Potter”?',
                    'Apa nama planet dalam film “Avatar”?',
                    'Film “Joker” diperankan oleh aktor siapa?',
                    'Studio apa yang memproduksi film animasi “Toy Story”?',
                ],
                'Quiz Musik' => [
                    'Siapa penyanyi lagu “Shape of You”?',
                    'Genre musik apa yang dibawakan oleh BTS?',
                    'Siapa penyanyi Indonesia yang terkenal dengan lagu “Cinta Luar Biasa”?',
                    'Alat musik gitar termasuk ke dalam jenis apa?',
                    'Apa judul lagu terkenal dari Michael Jackson?',
                    'Musisi mana yang dikenal sebagai “King of Pop”?',
                    'Apa fungsi metronome dalam musik?',
                    'Apa nama alat musik tiup dari logam yang sering digunakan dalam marching band?',
                    'Siapa pencipta lagu kebangsaan Indonesia Raya?',
                    'Musik dangdut berasal dari negara mana?',
                ],
                'Quiz Fashion' => [
                    'Siapa desainer terkenal asal Prancis dengan logo dua huruf “CC”?',
                    'Apa nama pakaian khas Jepang?',
                    'Sepatu “Air Jordan” terinspirasi dari atlet siapa?',
                    'Apa nama bahan dasar jeans?',
                    'Apa fungsi dari catwalk dalam dunia fashion?',
                    'Brand fashion apa yang memiliki logo huruf “LV”?',
                    'Siapa desainer terkenal yang mendirikan brand “Dior”?',
                    'Apa istilah untuk tren berpakaian yang sedang populer?',
                    'Apa nama pakaian adat khas Bali?',
                    'Apa warna dasar seragam formal pria?',
                ],
                'Quiz Science' => [
                    'Apa rumus kimia untuk air?',
                    'Siapa penemu bola lampu?',
                    'Planet terbesar di tata surya adalah?',
                    'Apa satuan gaya dalam fisika?',
                    'Proses perubahan air menjadi uap disebut?',
                    'Apa nama alat untuk mengukur suhu?',
                    'Gas apa yang paling banyak di atmosfer Bumi?',
                    'Berapa kecepatan cahaya?',
                    'Bagian sel yang mengandung DNA disebut?',
                    'Siapa ilmuwan yang menemukan teori relativitas?',
                ],
                'Quiz Sejarah' => [
                    'Siapa proklamator kemerdekaan Indonesia?',
                    'Kapan Indonesia merdeka?',
                    'Kerajaan Hindu tertua di Indonesia adalah?',
                    'Apa nama perjanjian yang mengakui kedaulatan Indonesia oleh Belanda?',
                    'Siapa presiden pertama Republik Indonesia?',
                    'Perang Diponegoro terjadi pada tahun berapa?',
                    'Kapan G30S/PKI terjadi?',
                    'Siapa tokoh yang dikenal sebagai Bapak Pendidikan Nasional?',
                    'Apa nama naskah proklamasi kemerdekaan Indonesia?',
                    'Dimana teks proklamasi diketik?',
                ],
                default => [],
            };

            foreach ($questions as $question) {
                DB::table('questions')->insert([
                    'quiz_id' => $quiz->id,
                    'question_text' => $question,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
