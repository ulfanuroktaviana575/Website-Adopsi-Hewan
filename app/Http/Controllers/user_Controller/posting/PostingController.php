<?php

namespace App\Http\Controllers\user_Controller\posting;

use App\Asset_posting;
use App\Category;
use App\Http\Controllers\Controller;
use App\posting;
use App\Report_posting;
use App\User;
use App\User_accept_choice;
use App\User_like_posting;
use App\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostingController extends Controller
{
    public function index()
    {
        return view('user.submit.submit');
    }

    public function like(Request $request)
    {
        return response()->json($request);
    }

    //tampilan posting hewan peliharaan
    public function index_posting()
    {
        // $data = posting::all();
        $data = Category::all();
        return view('user.submit.submitposting', compact('data'));
    }

    // menyimpan hasil posting hewan peliharaan
    public function store_posting(Request $request)
    {
        // dd($request);
        // validasi posting
        $request->validate([
            'title' => 'required',
            'jenis_kelamin' => 'required',
            'ras' => 'required',
            'kondisi_fisik' => 'required',
            'umur' => 'required|integer',
            'makanan' => 'required',
            'warna' => 'required',
            'lokasi' => '',
            'informasi_lain' => '',

        ]);

        // validasi asset posting
        $this->validate($request, [
            'path' => 'required',
            'path.*' => 'mimes:jpeg,png,jpg,mp4,webm,mpg|max:6000',
        ]);

        $posting = posting::create([
            'title' => $request->title,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ras' => $request->ras,
            'kondisi_fisik' => $request->kondisi_fisik,
            'umur' => $request->umur,
            'makanan' => $request->makanan,
            'warna' => $request->warna,
            'lokasi' => $request->city,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'informasi_lain' => $request->informasi_lain,
            'user_id' => Auth::user()->id,
            'category_id' => $request->submit_category,
        ]);
        if ($request->informasi_vaksin != null) {
            foreach ($request->informasi_vaksin as $k => $v) {
                Vaccine::create([
                    'keterangan' => $v,
                    'tanggal' => Carbon::parse($request->tanggal[$k]),
                    'posting_id' => $posting->id,
                ]);
            }
        }



        if ($request->hasFile('path')) {
            foreach ($request->path as $item) {
                Asset_posting::create([
                    $extension = $item->getClientOriginalName(),
                    $location = 'images/posting',
                    $nameUpload = $posting->id . 'thumbnail.' . $extension,
                    $item->move('assets/' . $location, $nameUpload),
                    $filepath = 'assets/' . $location . '/' . $nameUpload,
                    $data_image = $filepath,
                    'path' => $data_image,
                    'posting_id' => $posting->id,
                ]);
            }
        }

        return redirect(route('landingpage'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Menulis Postingan Hewan!');
    }

    // halaman edit posting
    public function edit_posting(Request $request)
    {
        $sort = "DESC";
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        $data['sort'] = $sort;
        // $edit = posting::where('user_id', Auth::user()->id)->get();
        // $edit = DB::select('SELECT p.*, (SELECT v.keterangan FROM vaccines as v where v.posting_id = p.id LIMIT 1) as vaksin_keterangan, (SELECT v.tanggal FROM vaccines as v where v.posting_id = p.id LIMIT 1) as vaksin_tanggal FROM postings as p ORDER BY p.created_at ' . $sort);
        $edit = DB::table('postings')->where('user_id', Auth::user()->id)
            ->select(
                'postings.*',
                DB::raw('(SELECT vaccines.tanggal FROM vaccines where vaccines.posting_id = postings.id LIMIT 1 ) as vaksin_tanggal'),
                DB::raw('(SELECT vaccines.keterangan FROM vaccines where vaccines.posting_id = postings.id LIMIT 1) as vaksin_keterangan'),
                DB::raw('(SELECT asset_postings.path FROM asset_postings WHERE asset_postings.posting_id = postings.id LIMIT 1) as foto'),
                DB::raw('(SELECT count(*) from user_accept_choices where user_accept_choices.posting_id = postings.id and status = "1") as adopted')
            )
            ->orderBy('postings.created_at', $sort)
            ->paginate(10);
        // dd($edit);
        $category = Category::pluck('nama', 'id');
        // $vaksin1 = Vaccine::where('posting_id',$edit->)->pluck('keterangan', 'posting_id');
        // $data_image = Asset_posting::all();
        // $aset_posting = DB::select('SELECT p.id, (SELECT aset.path FROM asset_postings AS aset WHERE aset.posting_id = p.id LIMIT 1) as path FROM postings as p');
        // dd($edit);
        //$aset_posting = DB::table('postings')->select('postings.*', DB::raw('(SELECT asset_postings.path FROM asset_postings WHERE asset_postings.posting_id = postings.id LIMIT 1) as foto'));
        return view('user/account/mypostingan', compact('edit', 'category', 'data'));
    }

    public function detail()
    {
        // $data = posting::find($id);
        // $user = User::pluck('name', 'id');
        return view('user/posting/detailPosting');
    }

    //list posting pada my akun
    public function list_posting()
    {
        return view('user/account/mypostingan');
    }

    // detail posting hewan pada my account

    public function detail_hewan($id)
    {
        $data = posting::find($id);
        $asset_posting = Asset_posting::where('posting_id', $id)->get();
        $like['counter'] = User_like_posting::where('posting_id', $id)->count();
        $edit = DB::select('SELECT p.*, (SELECT v.keterangan FROM vaccines as v where v.posting_id = p.id LIMIT 1) as keterangan, (SELECT v.tanggal FROM vaccines as v where v.posting_id = p.id LIMIT 1) as tanggal FROM postings as p WHERE p.id = ' . $id);
        if (count($edit) == 0) {
            return redirect(route('landingpage'));
        }
        return view('user/posting/detailPostingAccount', compact('data', 'asset_posting', 'edit', 'like'));
    }

    //redirect ke edit
    public function edit($id)
    {
        $data = posting::find($id);
        $cat = Category::all();
        $vaccinInfo = Vaccine::where('posting_id', $id)->orderBy('tanggal', 'ASC')->get();
        $foto = Asset_posting::where('posting_id', $id)->get();
        return view('user/posting/editpostaccount', compact('data', 'vaccinInfo', 'cat', 'foto'));
    }

    //update postingan hewan di account
    public function update(Request $request, $id)
    {
        if ($request->oldFoto == null && $request->path == null) {
            return back()->with('icon', 'error')->with('text', 'Foto Tidak Boloh Kosong!');
        }
        $request->validate([
            'title' => 'required',
            'jenis_kelamin' => 'required',
            'ras' => 'required',
            'kondisi_fisik' => 'required',
            'umur' => 'required|integer',
            'makanan' => 'required',
            'warna' => 'required',
            'lokasi' => '',
            'informasi_lain' => '',

        ]);
        if ($request->oldFoto == null) {
            Asset_posting::where('posting_id', $id)->delete();
        } else {
            $oldFotoDelete = Asset_posting::where('posting_id', $id)->whereNotIn('id', $request->oldFoto)->get();
            foreach ($oldFotoDelete as $o) {
                File::delete($o->path);
                $o->delete();
            }
        }

        posting::find($id)->update([
            'title' => $request->title,
            'jenis_kelamin' => $request->jenis_kelamin,
            'ras' => $request->ras,
            'kondisi_fisik' => $request->kondisi_fisik,
            'umur' => $request->umur,
            'makanan' => $request->makanan,
            'warna' => $request->warna,
            'lokasi' => $request->city,
            'informasi_lain' => $request->informasi_lain,
            'user_id' => Auth::user()->id,
            'category_id' => $request->submit_category,
        ]);
        Vaccine::where('posting_id', $id)->delete();
        if ($request->informasi_vaksin != null) {
            foreach ($request->informasi_vaksin as $k => $v) {
                Vaccine::create([
                    'keterangan' => $v,
                    'tanggal' => Carbon::parse($request->tanggal[$k]),
                    'posting_id' => $id,
                ]);
            }
        }

        // validasi asset posting
        $this->validate($request, [
            'path.*' => 'mimes:jpeg,png,jpg,mp4,webm,mpg|max:6000',
        ]);

        if ($request->hasFile('path')) {
            foreach ($request->path as $item) {
                Asset_posting::create([
                    $extension = $item->getClientOriginalName(),
                    $location = 'images/posting',
                    $nameUpload = $id . 'thumbnail.' . $extension,
                    $item->move('assets/' . $location, $nameUpload),
                    $filepath = 'assets/' . $location . '/' . $nameUpload,
                    $data_image = $filepath,
                    'path' => $data_image,
                    'posting_id' => $id,
                ]);
            }
        }
        return redirect(route('edit_posting'))->with('icon', 'success')->with('text', 'Informasi Berhasil di Edit!');
    }

    public function delete($id)
    {
        $data = posting::find($id);
        posting::destroy($data->id);
        File::delete($data->picture);
        return redirect(route('edit_posting'))->with('icon_delete', 'success')->with('text', 'Posting Hewan Berhasil di Hapus!');
    }

    public function likePosting(Request $request)
    {
        $user = Auth::guard('user')->user();
        User_like_posting::create([
            'user_id' => $user->id,
            'posting_id' => $request->id,
        ]);
        return response()->json([
            'like' => User_like_posting::where('posting_id', $request->id)->count(),
        ]);
    }
    public function dislikePosting(Request $request)
    {
        $user = Auth::guard('user')->user();
        User_like_posting::where('user_id', $user->id)->where('posting_id', $request->id)->delete();
        return response()->json([
            'like' => User_like_posting::where('posting_id', $request->id)->count(),
        ]);
    }

    public function reportPosting($id, Request $request)
    {
        Report_posting::create([
            'posting_id' => $id,
            'jawaban_report' => $request->excuse,
            'user_id' => Auth::guard('user')->user()->id,
        ]);
        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil Melakukan Report Posting!');
    }

    public function detail_pengadopsi($posting, $id)
    {
        $data = array();
        $data['posting_id'] = $posting;
        $data['adoptInfo'] = User_accept_choice::find($id);
        $data['user'] = User::find($data['adoptInfo']->user_id);
        $data['history'] = User_accept_choice::where('user_id', $data['adoptInfo']->user_id)->get();
        $data['history'] = DB::table('user_accept_choices')
            ->select(
                'user_accept_choices.*',
                DB::raw('(SELECT categories.nama FROM postings JOIN categories on categories.id = postings.category_id where postings.id = user_accept_choices.posting_id) as hewan')
            )
            ->where('user_id', $data['adoptInfo']->user_id)
            ->where('user_accept_choices.status', '=', '1')->get();

        // dd($data);
        return view('user/account/infopengadopsi', compact('data'));
    }
}
