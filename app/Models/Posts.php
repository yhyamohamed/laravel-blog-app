<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    public static function getAllPosts(){
        return  $posts = [
            ['id' => 1, 'title' => 'Laravel', 'post_creator' => 'yaya', 'created_at' => '2022-04-16 10:37:00','desc'=>' bla bla bla'],
            ['id' => 2, 'title' => 'PHP', 'post_creator' => 'yahia', 'created_at' => '2022-04-16 10:37:00','desc'=>'any thing here'],
            ['id' => 3, 'title' => 'Javascript', 'post_creator' => 'any one', 'created_at' => '2022-04-16 10:37:00','desc'=>'anpther desc'],
        ];
    }

    public static function findPost($id){
        $posts = self::getAllPosts();
        $index=-1;
        
        foreach ($posts as $key =>$post) {
           if( $post['id'] == $id)
           $index = $key;
        }
        return $posts[$index];
    }
    public static function addPost($psotToAdd){
        $posts = self::getAllPosts();
        array_push($posts , $psotToAdd);
    }
}
