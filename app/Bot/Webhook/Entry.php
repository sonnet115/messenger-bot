<?php

namespace App\Bot\Webhook;

use App\AutoReply\Webhook\Changes;
use Illuminate\Http\Request;

class Entry
{
    private $time;
    private $id;
    private $messagings;
    private $changes;

    private function __construct(array $data)
    {
        $this->id = $data["id"];
        $this->time = $data["time"];

        $this->changes = [];
        if (isset($data["changes"])) {
            foreach ($data["changes"] as $datum) {
                $this->changes[] = new Changes($datum);
            }
        }

        $this->messagings = [];
        if (isset($data["messaging"])) {
            foreach ($data["messaging"] as $datum) {
                $this->messagings[] = new Messaging($datum);
            }
        }
    }

    //extracts entries from a Messenger callback
    public static function getEntries(Request $request)
    {
        $entries = [];
        $data = $request->input("entry");
        foreach ($data as $datum) {
            $entries[] = new Entry($datum);
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

    public function getMessagings()
    {
        return $this->messagings;
    }

    public function getChanges()
    {
        return $this->changes;
    }
}
