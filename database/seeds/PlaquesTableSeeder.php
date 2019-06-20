<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlaquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @return void
     */
    public function run()
    {
        // Convert the CSV to an array of rows.
        $plaques = str_getcsv(
            Storage::disk('seeds')->get('leeds_blue_plaques.csv'),
            PHP_EOL
        );

        // Convert the array of rows to a two-dimensional array.
        foreach($plaques as &$plaque) {
            $plaque = str_getcsv($plaque, '|');
        }

        // Remove the header row.
        unset($plaques[0]);

        // Parse the plaques so they can be inserted.
        $plaques = array_map(function (array $plaque) {
            return [
                'name' => $plaque[0],
                'address_line_1' => $plaque[1],
                'address_line_2' => $plaque[2],
                'address_line_3' => $plaque[3],
                'city' => $plaque[4],
                'postcode' => $plaque[5],
                'lat' => (float)$plaque[6],
                'lng' => (float)$plaque[7],
                'unveiler' => $plaque[8],
                'date_unveiled' => Date::createFromFormat('d/m/Y', $plaque[9]),
                'sponsor' => $plaque[10],
                'comments' => $plaque[11],
                'created_at' => Date::now(),
                'updated_at' => Date::now(),
            ];
        }, $plaques);

        DB::table('plaques')->insert($plaques);
    }
}
