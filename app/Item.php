<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    //
    protected $table = 'item';
    public $timestamps = false;
    
    public static function add($nama, $price, $id) {

        $item = new Item;

        $item->id_item = $id;
        $item->nama = $nama;
        $item->price = $price;

        $item->save();
    }
    
    public static function getId($id) {
        return DB::table('item')->where('nama', $id)->pluck('id_item');;
    }
    
    public static function getNama($id) {
        return DB::table('item')->where('id_item', $id)->pluck('nama');;
    }
                                        
    public static function getPrice($id) {
        return DB::table('item')->where('id_item', $id)->pluck('price');;
    }
    
    public static function getPriceWithName($name) {
        return DB::table('item')->where('nama', $name)->pluck('price');;
    }
    
    public static function getStock($name) {
        return DB::table('item')->where('nama', $name)->pluck('stock');;
    }
    
    public static function updateNama($id, $nama) {
        DB::table('item')->where('id_item', $id)->update(['nama' => $nama]);;
    }
                                        
    public static function updatePrice($id, $price) {
        DB::table('item')->where('id_item', $id)->update(['price' => $price]);;
    }
                                        
    public static function deleteItem($id) {        
        DB::table('item')->where('id_item', $id)->delete();
    }
    
        public static function deleteItemWithNama($id) {        
        DB::table('item')->where('nama', $id)->delete();
    }
    
    public static function exist($nama) {
        return DB::table('item')->where('nama', $nama)->get();;
    }
    
    public static function exists($id) {
        return DB::table('item')->where('id_item', $id)->count();;
    }
    
    public static function updateStock($nama, $jumlah) {
        return DB::table('item')->where('nama', $nama)->update([ 'stock' => $jumlah ]);;
    }
    
    public static function addStock($nama, $jumlah) {
        $stock = DB::table('item')->where('nama', $nama)->pluck('stock');
        return DB::table('item')->where('nama', $nama)->update([ 'stock' => $jumlah + $stock ]);;
    }
    
    public static function minStock($nama, $jumlah) {
        $saldo = Item::getStock($nama);
        DB::table('item')->where('nama', $nama)->update(['stock' => $saldo - $jumlah]);
    } 
}