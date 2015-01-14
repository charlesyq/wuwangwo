<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Like;
use App\Services\Auth\Contracts\Auth;
use Symfony\Component\HttpFoundation\Request;

class LikeController extends Controller {

	public function store(Auth $auth, Request $request)
	{
        $type = $request->get('type');
        $object_id = $request->get('object_id');
        $user_id = $request->get('user_id');

        $count = Like::whereRaw('object_id=? and user_id=? and type=?', [$object_id, $user_id, $type])->count();
        if ($count > 0) {
            //return JR::fail(Code::DATA_DUPLICATE);
        }

        $like = new Like();
        $like->object_id = $object_id;
        $like->user_id = $user_id;
        $like->type = $type;
        $like->save();

        if ($type == Like::TYPE_POST) {
            DB::table('posts')->where('id','=',$object_id)->increment('likes_count');
        }

        return JR::ok(['object'=>$like->toArray()]);
	}

	public function destroy($id)
	{
        $like = Like::find($id);
        if (!$like) {
            return JR::fail(Code::FAIL);
        }
        if ($like->user_id != Auth::user()->id) {
            return JR::fail(Code::NOT_ALLOW);
        }

        $like->delete();
        if ($like->type == Like::TYPE_POST) {
            DB::table('posts')->where('id','=',$like->object_id)->decrement('likes_count');
        }
        return JR::ok();
	}

}
