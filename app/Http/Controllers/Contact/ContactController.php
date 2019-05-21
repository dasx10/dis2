<?php

namespace App\Http\Controllers\Contact;
use App\Model\Photos\Photos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Model\Contact\Contact;
use Exception;
class ContactController extends Controller
{
    private $data;

    public function __construct(Request $request) {
        $this->data = $request->post();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send_email(Request $request)
    {
        try {
            Contact::create($request->all());
//            Mail::send('email.contact', ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'messages' => $request->message, 'department' => $request->department], function ($m) use ($request) {
//                $m->from($request->email, 'DIS');
//                $m->to('dis@yobibyte.in.ua')->subject($request->subject);
//            });
            $text = "Name : ".$this->data['name']." \n";
            $text .= "Email : ".$this->data['email']." \n";
            $text .= "Phone : ".$this->data['phone']." \n";
            $text .= "Department : ".$this->data['department']." \n";
            $text .= "Message : ".$this->data['message']." \n";
            Mail::raw($text,function ($message){
//               $message->from('dis@yobibyte.in.ua');
//               $message->to($this->data['email']);
                $message->from($this->data['email']);
                $message->to('dis@yobibyte.in.ua');
                $message->cc('info@dis-company.com');
               $message->subject($this->data['subject']);
            });
            return response()->json(['success'=>true],200);
        } catch (Exception $e){
            return response()->json(['success'=>false,'message'=>'Something went wrong!'],200);
        }
    }

    public function join_send(Request $request){
        $text = '';
        try {
            $options = [
                'position'=>'Position',
                'company_website'=>'Company Website',
                'industry'=>'Industry',
                'surname'=>'Surname',
                'company_name' => 'Company Name',
                'email' => 'Email',
                'country' => 'Country',
                'phone_number' => 'Phone Number',
                'inquiry' => 'Inquiry',
                'business_scope' => 'Business Scope'
            ];
            foreach ($options as $key=>$full_name) {
                if(!empty($this->data[$key])){
                    $text .= "$full_name : " . $this->data[$key] . " <br>";
                }
            }


            if(!empty($request->file('file'))){
                $link = Photos::upload_photo($request->file('file'),'/cv_files/');
                $text .= "CV link : ".$link." <br>";
            }


//            Mail::raw($text,function ($message){
//                $message->from($this->data['email']);
//                $message->to('calmadeveloper@gmail.com');
////                $message->cc('info@dis-company.com');
//                $message->subject('Join Us!');
//            });


            $to = 'calmadeveloper@gmail.com';

            $subject = 'Join Us!';

            $headers = "From: " . $this->data['email'] . "\r\n";
//            $headers .= "Reply-To: ". 'info@spotasport.com' . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            mail($to, $subject, $text, $headers);
            return response()->json(['success'=>true],200);
        } catch (Exception $e){
            return response()->json(['success'=>false,'data'=>$e->getMessage(),'message'=>'Something went wrong!'],200);
        }
    }
}
