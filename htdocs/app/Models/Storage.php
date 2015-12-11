<?php

namespace App\Models;
use Redis;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
class Storage extends Model
{
    //
    protected $table="storage";
    private $TOKEN = "";
    private $credential =  [
            "auth_url"=> "https://identity.open.softlayer.com",
            "project"=> "object_storage_effb9ff2",
            "projectId"=> "dc5089969c744059be8934fa62f0e2b4",
            "region"=>"dallas",
            "userId"=> "530b0b715ccc4cedb9e36bca44bcc3fc",
            "username"=> "user_50903d7cc128c872195938b2ac8c9cca6d43fc89",
            "password"=> "x!eO2_tG//I{5m#W",
            "domainId"=> "6b1fbe9229db4c67b02783a2499ce708",
            "domainName"=> "811795"
    ];

    protected $primaryKey = "object_id";
    public static function getLink($objectName){
        $result = Storage::where('object_name',$objectName)->first();
        return $result["object_link"];
    }
    public static function createLink($objectName,$objectLink){

    }
    public function getToken(){
        $paramAuth=[
            "auth" =>[
                "identity"=> [
                    "methods"=> [
                        "password"
                    ],
                "password"=> [
                        "user"=> [
                            "id"=> $this->getCredential()["userId"],
                            "password"=> $this->getCredential()["password"]
                    ]
                ]
            ],
            "scope"=> [
                    "project"=> [
                        "id"=>$this->getCredential()["projectId"]
                ]
            ]
        ]];
        $client= new Client();
//        ,
//            ['headers'=>['Content-Type'=>'application/json']]
        $res = $client->request('GET',$this->getCredential()["auth_url"].'/auth/tokens',["headers"=>["content-type"=>'application/json']]);
        return $res->getBody();
    }

    /**
     * @return array
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * @param array $credential
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;
    }

}
