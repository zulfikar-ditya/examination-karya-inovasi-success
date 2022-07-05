<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stories extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        // 'image',
        'short_content',
        'content',
        'user_id',
        'category_id',
    ];

    public function rules($method = 'create', $id = null)
    {
        $validate = [
            'title' => 'required|string|max:255',
            'short_content' => 'required|string|max:350',
            'content' => 'required|string',
            // 'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ];

        if ($method == 'create') {
            $unique = [
                'image' => 'required|file|image|max:8048|mimes:jpg,jpeg,png',
            ];
        } else {
            $unique = [
                'image' => 'nullable|file|image|max:8048|mimes:jpg,jpeg,png',
            ];
        }
        
        return array_merge($validate, $unique);
    }

    public function loadModel($request) {
        foreach ($this->fillable as $key_field) {
            foreach ($request as $key_request => $value) {

                if ($key_field == $key_request && $key_field != 'slug') {
                    $this->setAttribute($key_field, $value);
                }

                if ($key_field == 'slug') {
                    $this->setAttribute('slug', Str::slug($request['title']));
                }
            }
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
