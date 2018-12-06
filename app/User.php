<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    public function posts()
    {
        return $this->hasMany(Post::class);
        //Comment::class to to samo co App/Comment
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public function publish(Post $post)
    {
        $this->posts()->save($post);
    }
    public function getUsersAvatar()
    {
        return $this->avatar === "default.jpg"
            ? "/uploads/avatars/default.jpg"
            : $this->avatar;
    }

    public function favoritePosts()
    {
        $postIds = $this->likes()
            ->where('like', 1)
            ->pluck('post_id');
        $favoritePosts = collect(Post::findMany($postIds))->paginate(5);

        return $favoritePosts;
    }
}
