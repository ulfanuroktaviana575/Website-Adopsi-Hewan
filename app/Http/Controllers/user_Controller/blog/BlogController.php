<?php

namespace App\Http\Controllers\user_Controller\blog;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Report_blog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //list blog pada tampilan umum
    public function index(Request $request)
    {
        //
        $request->search == null ?
            $list = Blog::orderBy('created_at', 'DESC')->paginate(10)
            :
            $list = Blog::orderBy('created_at', 'DESC')->where('title', 'like', "%$request->search%")->paginate(10);
        $data['popular'] = DB::select('SELECT b.*, (SELECT COUNT(*) FROM user_like_blogs as ulb where ulb.blog_id = b.id) as likes FROM blogs as b ORDER BY likes ASC LIMIT 3');
        $user = User::pluck('name', 'id');
        return view('user/blog/blog', compact('list', 'user', 'data'));
    }

    //detail blog (read more)
    public function readMore($id)
    {
        $data = Blog::find($id);
        $user = User::pluck('name', 'id');
        $user_foto = User::pluck('foto_profil', 'id');
        $deskripsi = array();
        $deskripsi['alamat_asal'] = User::pluck('alamat_asal', 'id');
        $deskripsi['email'] = User::pluck('email', 'id');
        $data['popular'] = DB::select('SELECT b.*, (SELECT COUNT(*) FROM user_like_blogs as ulb where ulb.blog_id = b.id) as likes FROM blogs as b ORDER BY likes ASC LIMIT 3');
        $data['repoted'] = 0;
        if (Auth::guard('user')->check())
            $data['repoted'] = Report_blog::where('posting_id', $id)->where('user_id', Auth::guard('user')->user()->id)->count();
        // dd($data);
        return view('user/blog/readMore', compact('data', 'user', 'user_foto', 'deskripsi', 'data'));
    }

    //submit blog
    public function index_blog()
    {

        $blog = Blog::all()->first();
        return view('user.submit.submitblog', compact('blog'));
    }

    //create database submit blog
    public function store_blog(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'isi' => 'required',
            'picture' => 'required|image|mimes:jpeg,svg,jfif,png,jpg|max:2560',
        ]);

        $data2 = User::where('id', Auth::user()->id)->first();
        $data = new Blog();

        $data->title = $request->title;
        $data->isi = $request->isi;
        $data->picture = $request->picture;
        $data->user_id = $data2->id;
        $data->save();

        $extension = $request->file('picture')->getClientOriginalExtension();
        $location = 'images/blog';
        $nameUpload = $data->id . 'thumbnail.' . $extension;
        $request->file('picture')->move('assets/' . $location, $nameUpload);
        $filepath = 'assets/' . $location . '/' . $nameUpload;
        $data->picture = $filepath;
        $data->save();

        return redirect(route('blog'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Blog Berhasil Ditulis!');
    }

    //list blog di akun saya
    public function list_blog(Request $request)
    {
        $sort = "DESC";
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        $data['sort'] = $sort;
        $list = Blog::where('user_id', Auth::user()->id)->orderBy('created_at', $sort)->paginate(10);
        return view('user/account/postingblog', compact('list', 'data'));
    }

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
        $data = Blog::find($id);
        return view('user/blog/EditBlog', compact('data'));
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
        $request->validate([
            'title' => 'required',
            'isi' => 'required',
            'picture' => 'image|mimes:jpeg,svg,jfif,png,jpg|max:2560',
        ]);

        $data = Blog::find($id);
        $data->title = $request->title;
        $data->isi = $request->isi;
        if ($request->file('picture') != "") {
            File::delete($data->picture);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $location = 'images/posting';
            $nameUpload = $data->id . 'thumbnail.' . $extension;
            $request->file('picture')->move('assets/' . $location, $nameUpload);
            $filepath = 'assets/' . $location . '/' . $nameUpload;
            $data->picture = $filepath;
        }

        $data->save();
        return redirect(route('posting_blog'))->with('icon', 'success')->with('text', 'Blog Berhasil di Edit! :');
    }

    public function detail($id)
    {
        $data = Blog::find($id);
        $user = User::pluck('name', 'id');
        return view('user/blog/detailBlog', compact('data', 'user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Blog::find($id);
        Blog::destroy($data->id);
        File::delete($data->picture);
        return redirect(route('posting_blog'))->with('icon_delete', 'success')->with('text', 'Posting Blog Berhasil di Hapus!');
    }

    public function reportBlog($id, Request $request)
    {
        Report_blog::create([
            'posting_id' => $id,
            'jawaban_report' => $request->excuse,
            'user_id' => Auth::guard('user')->user()->id,
        ]);
        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Melakukan Report Blog!');
    }
}
