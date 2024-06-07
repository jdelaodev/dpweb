<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use App\Models\ReactionType;
use Illuminate\Support\Facades\Auth;

class ReactionsController extends Controller
{
    public function create(Request $request, $post_id)
    {
        $current_reaction = Reaction::where(['user_id' => Auth::user()->id, 'post_id' => $post_id])->first();
        if(!$current_reaction)
        {
            Reaction::create([
                'user_id' => Auth::user()->id,
                'post_id' => $post_id,
                'reaction_type_id' => $request->reaction == 'like' ? ReactionType::where(['slug' => 'like'])->first()->id : ReactionType::where(['slug' => 'dislike'])->first()->id
            ]);
        }
        
        if($current_reaction && $current_reaction->reaction_type->slug != $request->reaction)
        {
            $current_reaction->update(['reaction_type_id' =>ReactionType::where(['slug' => $request->reaction])->first()->id]);
        } 
        
        if($current_reaction && $current_reaction->reaction_type->slug == $request->reaction)
        {
            $current_reaction->delete();
        }
        return redirect()->route('user.posts.show', $post_id);
    }
}
