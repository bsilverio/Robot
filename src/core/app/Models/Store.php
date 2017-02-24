<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $grid = [];

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);

        for($y = 0;$y <= $this->height;$y++) {
            $this->grid[$y] = [];
            for($x = 0;$x <= $this->width;$x++) {
                $this->grid[$y][$x] = null;
            }
        }
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'robot_storesph';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['width','height'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at'
    ];

    /**
     * The static field validators.
     *
     * @var array
     */

    public static $rules = [
        'width'     => 'required|numeric|min:2',
        'height'     => 'required|numeric|min:2',
    ];

    public function robots() {
        return $this->hasMany('App\Models\Robot', "store_id");
    }

    public function execute() {
        if(count($this->robots())) {
            $this->positionRobots();
            $commandCount = $this->getMaxCommandCount();

            for($commandCounter = 1;$commandCounter <= $commandCount;$commandCounter++) {
                foreach($this->robots as $robot) {
                    $robot->executeCommand($commandCounter);
                }
            }
        } else {
            return ['success' => 0, 'errors' => [trans('request.store.no_robots')]];
        }
    }

    protected function positionRobots() {
        foreach($this->robots as $robot) {
            $this->grid[$robot->y][$robot->x] = $robot;
            $robot->translateCommands();
        }
    }

    protected function getMaxCommandCount() {
        $max = 0;
        foreach($this->robots as $robot) {
            $max = strlen($robot->commands) > $max ? strlen($robot->commands) : $max;
        }

        return $max;
    }
}
