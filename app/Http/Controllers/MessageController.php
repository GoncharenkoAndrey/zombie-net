<?php

namespace App\Http\Controllers;

use App\Models\Dialog;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function messages($id = null) {
        if(is_null($id)) {
            $dialogs = Dialog::where("fromId", Auth::id())->get();

            return view("dialogs", compact("dialogs"));
        }
        else {
            $messages = Message::where("fromId", Auth::id())->where("toId", $id)
                ->orWhere("toId", Auth::id())->orWhere("fromId", $id)->orderBy("created_at", "ASC")->get();

            return view("dialog", compact("id","messages"));
        }
    }

    public function sendMessage($id, Request $request) {
        $user = User::find($id);
        if($user) {
            $dialogModel = new Dialog();
            $dialog = $dialogModel->where("toId", $id)->first();
            if(is_null($dialog)){
                $dialogModel->fromId = Auth::id();
                $dialogModel->toId = $id;
                $dialogModel->updateTimestamps();
                $dialogModel->save();
            }
            $messageModel = new Message();
            $messageModel->fromId = Auth::id();
            $messageModel->toId = $id;
            $messageModel->content = $request->get("message");
            $messageModel->updateTimestamps();
            $messageModel->save();

            return redirect(route("dialog", $id));
        }
    }
}
