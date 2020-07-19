<?php

namespace App\Http\Controllers;

use App\ExamSet;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function checklogin(Request $request)
    {
        $this->validate($request, [
            'txtUsername' => 'required',
            'txtPassword' => 'required',
        ]);
        $access_token = 'Z3RQbvbUKr39tXQWEL9jAcfSI2bV19vT'; // <----- API - Access Token Here
        $scopes = 'personel,student'; // <----- Scopes for search account type
        $username = $_POST['txtUsername']; // <----- Username for authen
        $password = $_POST['txtPassword']; // <----- Password for authen

        $api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-authen'; // <----- API URL

        $ch = curl_init(); // Initiate connection
        curl_setopt($ch, CURLOPT_URL, $api_url); // set url
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10s timeout time for cURL connection
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Allow https verification if true
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // Verify the certificate's name against host
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_POST, true); // Set post method
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // automatically follow Location: headers (ie redirects)
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('scopes' => $scopes, 'username' => $username, 'password' => $password));

        if (($response = curl_exec($ch)) === false) {
            echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
        } else {

            $json_data = json_decode($response, true);
            if (!isset($json_data['api_status'])) {
                echo 'API Error ' . print_r($response, true);
            } elseif ('success' == $json_data['api_status']) {
                //ก็ถ้ามันคืนมาว่า successs
                $id = $request->get('txtUsername');

                if (Auth::loginUsingId($id)) {

                }

                $pass = 0;
                $var = $json_data['userInfo']['account_type'];
                if (User::find($id)) {
                    //ก็ให้มันไปหา id user ใน database ว่ามีไหม
                    $users = User::find($id); //ถ้ามีก็ให้ users เก็บข้อมูลไอดีนั้นแล้วก็ส่งไปหน้าต่อไป
                    Session::put('userID', $id);
                    error_log(Session::get('userID'));
                    $before = DB::table('user_exam_sets')->where('user_id', $id)->orderBy('startdatetime', 'DESC')->get();
                    $ex = ExamSet::all()->toArray();
                    return view('takeexam.index', compact('users', 'id', 'var', 'before', 'ex'));
                } else {
//ถ้าไม่มีก็ให้มันไปสร้าง user ใหม่ใน database

                    $eng = $json_data['userInfo']['firstname_en'] . "  " . $json_data['userInfo']['lastname_en'];
                    error_log($eng);
                    $users = new User(
                        [
                            'id' => $id,
                            'name' => $json_data['userInfo']['displayname'],
                            'eng_name' => $eng,
                            'admin' => $pass,
                            'create_question' => $pass,
                            'screener' => $pass,
                            'prepare' => $pass,
                            'structure' => $pass,
                        ]
                    );

                    $users->save(); //บันทึกข้อมูลลงไปในตาราง

                    if (Auth::loginUsingId($id)) {

                    }

                    Session::put('userID', $id);
                    error_log(Session::get('userID'));
                    $before = DB::table('user_exam_sets')->where('user_id', $id)->orderBy('startdatetime', 'DESC')->get();
                    $ex = ExamSet::all()->toArray();
                    return view('takeexam.index', compact('users', 'id', 'var', 'before', 'ex'));
                }

            } elseif ('fail' == $json_data['api_status']) {

                if (501 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "Account not found" . $json_data['api_status_code']);
                } elseif (401 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "No scopes");
                } elseif (402 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "Scopes invalid");
                } elseif (403 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "No username");
                } elseif (404 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "No password");
                } elseif (405 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "user หรือ  password ไม่ถูกต้อง");
                } elseif (502 == $json_data['api_status_code']) {
                    return redirect()->route('login')->with('error', "Search fail");}
            } else {
                echo "Internal Error";
            }
        }
        curl_close($ch);
    }

    // Login สำเร็จ
    public function successlogin()
    {
        return view('takeexam.index');
    }

    public function logout()
    {
        Auth::logout();
        error_log(Auth::check());
        return view('login');
    }

}
