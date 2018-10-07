<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Checkout;
use Session;

class WelcomeController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function create(Request $request)
    {

        // Validate form
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'regex:/^.+@.+$/i|max:55',
            'content' => 'required|max:255',
        ]);

        // Insert data to database
        $checkout = new Checkout;
        $checkout->name = Input::get('name');
        $checkout->email = Input::get('email');
        $checkout->content = Input::get('content');
        $checkout->save();

        // Sending emails
        $this->sendEmailConfirm();
        $this->notifyAdmin();

        return redirect('/')->with( ['data' => $checkout] );
    }

    public function sendEmailConfirm(){

        if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['content'])) {
            $to = 'kontakt@luk-dev.pl';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $content = $_POST['content'];
            $subject = 'Checkout form - confirm your request'; 
            $message = '
            <h2>Thank you for your response !</h2>
            <p><strong>Your name: '. $name .'</strong></p>
            <p><strong>Your email: '. $email .'</strong></p>
            <p><strong>Your message: </strong> '. $content .' </p>
            ';
            $headers = array(
                'From:' . $email . ' ',
                'Reply-To:'  . $email . ' ',
                'Content-Type:text/html;charset=UTF-8',
                'MIME-Version: 1.0'
            );
            $headers = implode("\r\n", $headers);
            mail($to,$subject,$message, $headers);
        }

    }

    public function notifyAdmin(){

        if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['content'])) {
            $to = 'enquiries@example.com';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $content = $_POST['content'];
            $subject = 'Checkout form - new notify request'; 
            $message = '
            <h2>New notify request</h2>
            <p><strong>User name: '. $name .'</strong></p>
            <p><strong>User email: '. $email .'</strong></p>
            <p><strong>User message: </strong> '. $content .' </p>
            ';
            $headers = array(
                'From:' . $email . ' ',
                'Reply-To:'  . $email . ' ',
                'Content-Type:text/html;charset=UTF-8',
                'MIME-Version: 1.0'
            );
            $headers = implode("\r\n", $headers);
            mail($to,$subject,$message, $headers);
        }

    }

}
