<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Common\ActionSchema;
use Common\FileUpload;
use Common\Generate;
use App\Http\Requests\CreatePostRequest;
use \Exception;

class PostController extends Controller
{
    protected $module = 'post';

    //constructor class
    public function __construct()
    {
        $this->middleware('auth'); #check user is authenticated/login
        $this->middleware('role'); #check user has the access to this function/module
        $this->middleware('permission'); #check permission access
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $actions = ActionSchema::getActionSchema($this->module);
        return view('backend.post.index')
                  ->with('content_title', 'All Posts')
                  ->with('posts', $posts)
                  ->with('actions', $actions)
                  ->with('module', $this->module);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.post.create')
                ->with('content_title', 'New Post')
                ->with('module', $this->module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        try {
          $inputs = $request->all();
          unset($inputs['_token']);
          $photo = $request->file('photo');
          if ($photo) {
              //Upload Image
              $uploaded_path = FileUpload::upload($photo);
              $inputs['photo'] = $uploaded_path;
          }
          Post::create($inputs);
          return redirect()->to('/crm/post/')
                ->withMessage(Generate::success_message('Success', 'Created Successfully'));
        } catch (Exception $e) {
          return redirect()->to('/crm/post/')
                ->withMessage(Generate::error_message('Failed', $e->getMessage()));
        }

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
}
