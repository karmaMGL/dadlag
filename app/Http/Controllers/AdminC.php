<?php

namespace App\Http\Controllers;

use GeoIp2\Exception\GeoIp2Exception;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\users;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\File;
use function Psy\debug;
use GeoIp2\Database\Reader;
class AdminC extends Controller
{
    //
    public function register(Request $request){
        $admin = new Admin();
        $admin->email = $request->email;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->save();
        return redirect("/PageLogin");
    }
    public function login(Request $request)
{
    $credentials = $request->validate(['email' => 'required|email', 'password' => 'required']);

    Log::warning($request->getClientIps() );
    if (Auth::attempt( ['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();

        return redirect()->intended('/Dashboard');
    } else {
        return back()->withErrors('Invalid credentials');
    }
}
    public function logout(){
        Auth::logout();
        Auth::check() ?Log::warning("in"): Log::error('out');
        // Auth::check() ? auth()->logout() : redirect()->route('');
        //
        return redirect()->intended('/');
    }
    public function dashboard(){
        Log::warning(Posts::where('Category','asdasd')->count('id'));
        return view("adminPage/dashboard",['Admins' => Admin::all(),'Category'=>Category::all()]);
    }
    public function AddNewCategory(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect('/Dashboard');
    }
    public function PublishPost(Request $request){
        Log::warning( $request->title." ".$request->category." ".$request->img." ". $request->description);
        $Checked = $request->validate([
            'title'=>'required',
            'description'=> 'required|string',
            'img'=> 'required|file',
            'category'=> 'required'
        ]);

        $newP = new Posts();
        $newP->title = $Checked['title'];
        $newP->Description = $Checked['description'];
        $path = $request->file('img')->move('photos', uniqid().'.png');
        $newP->ImgPath = $path;
        $newP->Category = $Checked['category'];
        $newP->save();
        return redirect()->intended('/Dashboard');

    }
    public function FullPage($id){
        $post = Posts::find($id);
        $post->View++;
        $post->save();
        return view('page', ['data'=> Posts::find($id),'comments'=>Comments::where('PostId',$id)->get()]);
    }
    public function DeleteAccount($id){

        $user = Admin::find($id);
        Log::warning($user->email);
        return redirect('/Dashboard');
    }
    public function Search(Request $Request){
        $match = Posts::where('Title','like',"%$Request->name%")->get();
        return view('search',['data'=>$match]);
    }
    public function Main(){
        $late  = Posts::all();
        $late->reverse();

        $num = rand(0,count(Posts::all())-1);
        $data =  Posts::all();
        $colum1 = Posts::where('Category','like', $data[$num]->Category)->get();

        $most = Posts::orderBy('View','desc')->get();
        return view('main',['data'=> $data ,'latests'=>$late,'Category1'=>$colum1 ,'Trend'=> $most]);
    }
    public function Comment(Request $request, $id)
    {
    $request->validate(['comment' => 'required']);

    $comment = new Comments();
    $comment->ByWho = 'Unknown';
    $comment->PostId = $id;
    $comment->Comment = $request->comment;

    $userip = $request->getClientIp();
    $path = storage_path('app/geoip/GeoLite2-Country.mmdb');
    $reader = new Reader($path);

    try {
        $record = $reader->country($userip);
        $countryCode = $record->country->isoCode; // ISO 3166-1 alpha-2 country code
        $countryName = $record->country->name; // Country name

        $comment->ip = "$userip ($countryName, $countryCode)";
        $comment->save();

        // Log the comment and IP details
        Log::info("New comment from IP: $userip, Country: $countryName ($countryCode), Comment: {$request->comment}");

    }
    catch (\Exception $e) {
        // Log that the IP was not found in the database
        Log::warning("IP: $userip not found in GeoLite2 database.");

        // If IP lookup fails, save comment with IP only
        $comment->ip = $userip;
        $comment->save();

        // Log the comment with IP only
        Log::info("New comment from IP: $userip (Country information not available), Comment: {$request->comment}");
    }

        return redirect('/FullPost/'.$id)->with('success', 'Comment added successfully.');
    }
}
