<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;


class Module extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'url',
        'description',
        'slug',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $model->url)) {

            } else {
                // Not URL
                $response = Http::get("https://packagist.org/search.json?q={$model->url}")->collect();
                if ($response->get('total')) {
                    $results = Collect($response->get('results'))->first();
                    if ($results['name']) {
                        $responseGH = Http::get("https://raw.githubusercontent.com/{$results['name']}/master/module.json")->collect();
                        if ($responseGH->count()) {
                            $model->title = $responseGH->get('name');
                        }
                    }
                }
            }
            $model->slug = strtolower($model->title);
        });

        static::saved(function ($model) {
        });

    }

    private function isUrl($url){
        return preg_match('%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu', $url);
    }

    public function isValid() {
        $response = Http::get("https://packagist.org/search.json?q={$this->url}")->collect();
        if ($response->get('total')) {
            $results = Collect($response->get('results'))->first();
            if ($results['name']) {
                $responseGH = Http::get("https://raw.githubusercontent.com/{$results['name']}/master/module.json")->collect();
                if ($responseGH->count()) {
                    return true;
                }
            }
        }
        return false;
    }

}
