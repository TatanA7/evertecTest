<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'article'       =>'Camisa Hombre',
            'description'   =>'Camisa para hombre elegante',
            'image_url'     =>'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQLeBNdvHVH8vxZrgQ4tE6DMMHRUzQ4cUi10J_d0HM8K_B7QyXD&usqp=CAU',
            'price'         =>70000,
            'created_at'=>DB::raw('now()'),            
        ]); 
        DB::table('articles')->insert([
            'article'       =>'Pantalón Hombre',
            'description'   =>'Pantalón para hombre elegante',
            'image_url'     =>'https://www.dhresource.com/0x0/f2/albu/g6/M00/FD/11/rBVaSFujVxaAbTabAAFQtBFM_aM564.jpg',
            'price'         => 140000,
            'created_at'=>DB::raw('now()'),            
        ]); 
        DB::table('articles')->insert([
            'article'       =>'Camisetas para hombre',
            'description'   =>'Camisetas',
            'image_url'     =>'https://http2.mlstatic.com/camisetas-para-hombre-estampadas-cruz-creativa-D_NQ_NP_681491-MCO28389335063_102018-F.jpg',
            'price'         => 50000,
            'created_at'=>DB::raw('now()'),            
        ]); 
        DB::table('articles')->insert([
            'article'       =>'Tennis para hombre ',
            'description'   =>'tennis',
            'image_url'     =>'https://img.clasf.co/2018/11/30/Zapatos-Hombre-Tenis-Para-Hombre-Zapatillas-Deportivas-Nik-20181130181936.8707470015.jpg',
            'price'         => 500000,
            'created_at'=>DB::raw('now()'),            
        ]); 
        DB::table('articles')->insert([
            'article'       =>'Pantaloneta para hombre',
            'description'   =>'Pantaloneta deportiva para hombre ',
            'image_url'     =>'https://i.pinimg.com/originals/82/e8/3c/82e83cbac1ed031b4b1bbb158ddf839a.jpg',
            'price'         => 40000,
            'created_at'=>DB::raw('now()'),            
        ]); 
        DB::table('articles')->insert([
            'article'       =>'Chaqueta',
            'description'   =>'Chaqueta hombre ',
            'image_url'     =>'https://tiendasbranchos.vteximg.com.br/arquivos/ids/270104-407-407/DQ3070_1.jpg?v=637202509047430000',
            'price'         => 100000,
            'created_at'=>DB::raw('now()'),            
        ]); 
    }
}
