<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\PostRecommend;
use App\Models\PostRecommendView;
use Config;
use Es;
use Illuminate\Http\Request;

//use App\Http\Controllers\Controller;
//use Elasticsearch\Client;
//use App\Http\Controllers\SearchController;
//define("INDEX_NAME","foodiee");
//define("USER_TYPE","user");
//define("POST_TYPE","post");
//define("BOARD_TYPE","board");
class RecommendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getPost($post_id){
//        $client = new Client();
//        $post = Post::getPostById($post_id);
//        $index_name = Config::get('elasticsearch.index_name');
//        $post_type = Config::get('elasticsearch.post_type');
//        $params = [
//            "index"=>$index_name,
//            "analyzer"=>'vi_analyzer',
//            'text'=>$post["description"]
//        ];
//        $tokens = $client->indices()->analyze($params)["tokens"];
//        $search = new SearchController();
//        $results = [];
//        foreach($tokens as $token){
//            $query  = ["description"=>$token["token"]];
//            $results[] = $search->search($post_type,$query);

        $results = PostRecommendView::getPosts($post_id);
        return $results;
    }
    public function setPost(){
        $results = PostRecommend::setRecommend();
        return $results;
    }
}
