<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(30);
        return view('user.index', compact('users'));
    }

    public function display()
    {
        return view('in');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create'); //สร้างก้อนข้อมูลใหม่
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //เก็บลงใน DataBast
        $access_token = 'Z3RQbvbUKr39tXQWEL9jAcfSI2bV19vT'; // <----- API - Access Token Here
        $username = $_POST['id']; // <----- Username for search

        $api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-info'; // <----- API URL
        //$api_url = 'http://202.44.41.31/passport/api/account-api/user-info'; // <----- API URL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => $username));

        if (($response = curl_exec($ch)) === false) {
            echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
        } else {
            $json_data = json_decode($response, true);
            if (!isset($json_data['api_status'])) {
                echo 'API Error ' . print_r($response, true);
            } elseif ('success' == $json_data['api_status']) {
                // if ($json_data['userInfo']['account_type']== 'personel') {
                $this->validate($request, ['id' => 'required',
                    'admin' => 'required',
                    'create_question' => 'required',
                    'screener' => 'required',
                    'prepare' => 'required',
                    'str' => 'required',
                ]);

                $id = $request->get('id');
                if (User::find($id)) {
                    return redirect()->route('user.create')->with('error', "มีบัญชีผู้ใช้งานนี้แล้ว");
                } else {

                    $eng = $json_data['userInfo']['firstname_en'] . "  " . $json_data['userInfo']['lastname_en'];
                    $users = new User(
                        [
                            'id' => $request->get('id'),
                            'name' => $json_data['userInfo']['displayname'],
                            'eng_name' => $eng,
                            'admin' => $request->get('admin'),
                            'create_question' => $request->get('create_question'),
                            'screener' => $request->get('screener'),
                            'prepare' => $request->get('prepare'),
                            'structure' => $request->get('str'),
                        ]
                    );

                    $users->save(); //บันทึกข้อมูลลงไปในตาราง

                    return redirect()->route('user.index')->with('success', 'บันทึกข้อมูลเรียบร้อย'); //เปลี่ยนหน้าไปที่ create และโยน success ไปที่view
                }

                // }else {
                //     return redirect()->route('user.create')->with('error', "คุณสมบัติไม่ตรงตามที่กำหนดไว้");
                // }
            } elseif ('fail' == $json_data['api_status']) {
                if (501 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "Account not found");
                }
            } else {
                echo "Internal Error";
            }
        }
        curl_close($ch);
    }

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
        $users = User::find($id);

        return view('user.edit', compact('users', 'id'));
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
        $access_token = 'Z3RQbvbUKr39tXQWEL9jAcfSI2bV19vT'; // <----- API - Access Token Here
        $username = $_POST['id']; // <----- Username for search

        $api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-info'; // <----- API URL
        //$api_url = 'http://202.44.41.31/passport/api/account-api/user-info'; // <----- API URL

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => $username));

        if (($response = curl_exec($ch)) === false) {
            echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
        } else {
            $json_data = json_decode($response, true);
            if (!isset($json_data['api_status'])) {
                echo 'API Error ' . print_r($response, true);
            } elseif ('success' == $json_data['api_status']) {

                // if ('personel' == $json_data['userInfo']['account_type']) {

                $this->validate(
                    $request,
                    [
                        'id' => 'required',
                        'admin' => 'required',
                        'create_question' => 'required',
                        'screener' => 'required',
                        'prepare' => 'required',
                    ]
                );

                $users = User::find($id);
                $eng = $json_data['userInfo']['firstname_en'] . "  " . $json_data['userInfo']['lastname_en'];
                $users->id = $request->get('id');
                $users->name = $json_data['userInfo']['displayname'];
                $users->eng_name = $eng;
                $users->admin = $request->get('admin');
                $users->create_question = $request->get('create_question');
                $users->screener = $request->get('screener');
                $users->prepare = $request->get('prepare');
                $users->structure = $request->get('str');

                $users->save();
                return redirect()->route('user.index')->with('success', 'อัพเดทเรียบร้อย');
                // } else {
                //     return redirect()->route('user.edit')->with('error', "คุณสมบัติไม่ตรงตามที่กำหนดไว้");
                // }
            } elseif ('fail' == $json_data['api_status']) {
                if (501 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "Account not found");
                } elseif (401 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "No scopes");
                } elseif (402 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "Scopes invalid");
                } elseif (403 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "No username");
                } elseif (404 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "No password");
                } elseif (405 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "Invalid credentials");
                } elseif (502 == $json_data['api_status_code']) {
                    return redirect()->route('user.create')->with('error', "Search fail");}
            } else {
                echo "Internal Error";
            }
        }
        curl_close($ch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->route('user.index')->with('success', 'ลบข้อมูลเรียบร้อย');
    }

}
