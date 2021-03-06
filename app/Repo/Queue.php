<?php

namespace Eyewitness\Eye\Repo;

use Eyewitness\Eye\Repo\Model;
use Eyewitness\Eye\Repo\History\Queue as History;

class Queue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eyewitness_io_queues';

    /**
     * The values to cast.
     *
     * @var array
     */
    protected $casts = ['last_heartbeat' => 'datetime',
                        'created_at' => 'datetime'];

    /**
     * Get all of the queue history that belong to this queue.
     */
    public function history()
    {
        return $this->hasMany(History::class)->orderBy('date')->orderBy('hour');
    }

    /**
     * Get the latest queue history that belong to this queue.
     */
    public function latest_history()
    {
        return $this->hasOne(History::class)->orderBy('date')->orderBy('hour');
    }

    /**
     * Set the queue heartbeat to now.
     */
    public function heartbeat()
    {
        $this->last_heartbeat = date('Y-m-d H:i:s');
        $this->save();
    }
}
