<?php

namespace App\AutoReply\Webhook;

use Illuminate\Http\Request;

class AREntry
{
    private $time;
    private $id;
    private $changes;

    private function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->time = $data["time"];
        $this->changes = [];
        foreach ($data["changes"] as $datum) {
            $this->changes[] = new Changes($datum);
        }
    }

    //extracts entries from a Messenger callback
    public static function getEntries(Request $request)
    {
        $entries = [];
        $data = $request->input("entry");
        foreach ($data as $datum) {
            $entries[] = new AREntry($datum);
        }
        return $entries;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getChanges()
    {
        return $this->changes;
    }
}
