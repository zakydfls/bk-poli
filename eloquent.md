# Laravel Cheatsheet: Eloquent ORM

## Table of Contents
1. [Getting Started](#getting-started)
2. [Eloquent Relationships](#eloquent-relationships)
3. [Querying Data](#querying-data)
4. [Inserting & Updating Data](#inserting--updating-data)
5. [Soft Deletes](#soft-deletes)
6. [Scopes](#scopes)
7. [Accessors & Mutators](#accessors--mutators)
8. [Advanced Features](#advanced-features)

---

## Getting Started
### Basic Model Example
```php
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $fillable = ['title', 'content'];
}
```

### Retrieving All Records
```php
$posts = Post::all();
```

### Finding a Record by Primary Key
```php
$post = Post::find(1);
```

### Retrieving First Record
```php
$post = Post::first();
```

### Where Clause
```php
$posts = Post::where('title', 'like', '%Laravel%')->get();
```

---

## Eloquent Relationships
### One to One
```php
// Define the relationship in the model
class User extends Model {
    public function profile() {
        return $this->hasOne(Profile::class);
    }
}

// Usage
$profile = User::find(1)->profile;
```

### One to Many
```php
class Post extends Model {
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}

// Usage
$comments = Post::find(1)->comments;
```

### Many to Many
```php
class User extends Model {
    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}

// Usage
$roles = User::find(1)->roles;
```

### Has Many Through
```php
class Country extends Model {
    public function posts() {
        return $this->hasManyThrough(Post::class, User::class);
    }
}

// Usage
$posts = Country::find(1)->posts;
```

### Polymorphic Relations
```php
class Photo extends Model {
    public function imageable() {
        return $this->morphTo();
    }
}

class Post extends Model {
    public function photos() {
        return $this->morphMany(Photo::class, 'imageable');
    }
}
```

---

## Querying Data
### Basic Where Clauses
```php
$posts = Post::where('status', 'published')->get();
$posts = Post::where('views', '>', 100)->get();
```

### OR Clauses
```php
$posts = Post::where('status', 'draft')->orWhere('views', '>', 100)->get();
```

### Order By
```php
$posts = Post::orderBy('created_at', 'desc')->get();
```

### Limit & Offset
```php
$posts = Post::limit(10)->offset(5)->get();
```

### Chunking
```php
Post::chunk(100, function($posts) {
    foreach ($posts as $post) {
        // Process each post
    }
});
```

### Aggregates
```php
$count = Post::count();
$max = Post::max('views');
$sum = Post::sum('views');
```

---

## Inserting & Updating Data
### Creating Records
```php
$post = new Post;
$post->title = 'New Post';
$post->content = 'This is the content';
$post->save();
```

### Mass Assignment
```php
$post = Post::create(['title' => 'New Post', 'content' => 'This is the content']);
```

### Updating Records
```php
$post = Post::find(1);
$post->title = 'Updated Title';
$post->save();
```

### Bulk Update
```php
Post::where('status', 'draft')->update(['status' => 'published']);
```

### Deleting Records
```php
$post = Post::find(1);
$post->delete();

// Bulk Delete
Post::where('status', 'draft')->delete();
```

---

## Soft Deletes
### Enabling Soft Deletes
```php
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
```

### Retrieving Soft Deleted Records
```php
// Only Trashed
$trashed = Post::onlyTrashed()->get();

// With Trashed
$allPosts = Post::withTrashed()->get();

// Restore
$post = Post::withTrashed()->find(1);
$post->restore();

// Force Delete
$post->forceDelete();
```

---

## Scopes
### Defining a Query Scope
```php
class Post extends Model {
    public function scopePublished($query) {
        return $query->where('status', 'published');
    }
}

// Usage
$posts = Post::published()->get();
```

---

## Accessors & Mutators
### Defining Accessors
```php
class Post extends Model {
    public function getTitleAttribute($value) {
        return strtoupper($value);
    }
}

// Usage
$post = Post::find(1);
echo $post->title; // Uppercase title
```

### Defining Mutators
```php
class Post extends Model {
    public function setTitleAttribute($value) {
        $this->attributes['title'] = strtolower($value);
    }
}

// Usage
$post = new Post;
$post->title = 'New Post';
$post->save();
```

---

## Advanced Features
### Casting Attributes
```php
class Post extends Model {
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
```

### Appending Accessors
```php
class Post extends Model {
    protected $appends = ['summary'];

    public function getSummaryAttribute() {
        return substr($this->content, 0, 100);
    }
}
```

### Events
```php
class Post extends Model {
    protected static function booted() {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }
}
```

### Model Factories
```php
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory {
    protected $model = Post::class;

    public function definition() {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
        ];
    }
}

// Usage
Post::factory()->count(10)->create();