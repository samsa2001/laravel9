<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Mail\MailConstruct;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(ContactFormRequest $request){
        $dataRequest = $request->validated();
        $objMail = new \stdClass();
        $objMail->name = $dataRequest['name'];
        $objMail->email = $dataRequest['email'];
        $objMail->content = $dataRequest['content'];
        Mail::to("ramonpons2011@gmail.com")->send(new MailConstruct($objMail));
        return redirect()->route('post.index')->with('status', 'Email enviado');
    }
}
