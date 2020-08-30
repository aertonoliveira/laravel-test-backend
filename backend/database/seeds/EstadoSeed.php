<?php

use Illuminate\Database\Seeder;

class EstadoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            ['id' => 1, 'estado' => 'Acre', 'uf' => 'AC'],
            ['id' => 2, 'estado' => 'Alagoas', 'uf' => 'AL'],
            ['id' => 3, 'estado' => 'Amapá', 'uf' => 'AP'],
            ['id' => 4, 'estado' => 'Amazonas', 'uf' => 'AM'],
            ['id' => 5, 'estado' => 'Bahia', 'uf' => 'BA'],
            ['id' => 6, 'estado' => 'Ceará', 'uf' => 'CE'],
            ['id' => 7, 'estado' => 'Distrito Federal', 'uf' => 'DF'],
            ['id' => 8, 'estado' => 'Espírito Santo', 'uf' => 'ES'],
            ['id' => 9, 'estado' => 'Goiás', 'uf' => 'GO'],
            ['id' => 10, 'estado' => 'Maranhão', 'uf' => 'MA'],
            ['id' => 11, 'estado' => 'Mato Grosso', 'uf' => 'MT'],
            ['id' => 12, 'estado' => 'Mato Grosso do Sul', 'uf' => 'MS'],
            ['id' => 13, 'estado' => 'Minas Gerais', 'uf' => 'MG'],
            ['id' => 14, 'estado' => 'Pará', 'uf' => 'PA'],
            ['id' => 15, 'estado' => 'Paraíba', 'uf' => 'PB'],
            ['id' => 16, 'estado' => 'Paraná', 'uf' => 'PR'],
            ['id' => 17, 'estado' => 'Pernambuco', 'uf' => 'PE'],
            ['id' => 18, 'estado' => 'Piauí', 'uf' => 'PI'],
            ['id' => 19, 'estado' => 'Rio de Janeiro', 'uf' => 'RJ'],
            ['id' => 20, 'estado' => 'Rio Grande do Norte', 'uf' => 'RN'],
            ['id' => 21, 'estado' => 'Rio Grande do Sul', 'uf' => 'RS'],
            ['id' => 22, 'estado' => 'Rondônia', 'uf' => 'RO'],
            ['id' => 23, 'estado' => 'Roraima', 'uf' => 'RR'],
            ['id' => 24, 'estado' => 'Santa Catarina', 'uf' => 'SC'],
            ['id' => 25, 'estado' => 'São Paulo', 'uf' => 'SP'],
            ['id' => 26, 'estado' => 'Sergipe', 'uf' => 'SE'],
            ['id' => 27, 'estado' => 'Tocantins', 'uf' => 'TO'],
        ]);
    }
}
