<?php

namespace App\Services\AllServices;

use App\Jobs\PublishData;
use App\Jobs\SendData;
use App\Models\Message;
use App\Models\Subscriber;
use App\Models\Topic;
use Exception;
use GuzzleHttp\Client;

class Notify
{

    public static function susbcribe(string $topic_string, string $url)
    {
        $topic = Topic::where('name', $topic_string)->first();

        if (!$topic) {
            $topic = new Topic();
            $topic->name = $topic_string;
            $topic->save();
        }

        $subscriber = Subscriber::where('url', $url)->first();
        if (!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->url = $url;
            $subscriber->save();
        }

        $topic->subscribers()->attach($subscriber->id);

        return;
    }

    public static function startPublish(string $topic_string, $data)
    {

        $topic = Topic::where('name', $topic_string)->first();

        if (!$topic) {
            $topic = new Topic();
            $topic->name = $topic_string;
            $topic->save();
        }

        $message = new Message();
        $message->topic_id = $topic->id;
        $message->body = $data;
        $message->save();

        PublishData::dispatch($message);
        return;
    }

    public static function publish(Message $message)
    {
        $topic = $message->topic;
        foreach ($topic->subscribers as $key => $subscriber) {
            SendData::dispatch($subscriber, $message);
        }
        return;
    }

    public static function sendData(Subscriber $subscriber, Message $message)
    {
        // $url = $subscriber->url;
        $fields = [
            'topic' => $message->topic->name,
            'data' => $message->body,
        ];
        // $fields_string = http_build_query($fields);
        // //open connection
        // $ch = curl_init();

        // //set the url, number of POST vars, POST data
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        // //So that curl_exec returns the contents of the cURL; rather than echoing it
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // //execute post
        // $response = curl_exec($ch);
        // $err = curl_error($ch);
        // curl_close($ch);

        // if ($err) {
        //     throw new Exception($err);
        // }

        // $response = json_decode($response);

        $client = new Client();
        $response = $client->request('POST', $subscriber->url, ["form_params" => $fields]);
        return $response->getBody();
    }
}

return new Notify;
