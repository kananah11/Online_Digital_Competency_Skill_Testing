
@extends('master')
@section('title', 'เข้าสู่ระบบผู้ใช้งาน')
@section('content')
<style>

            *,
            body {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            body {
                width: 100vw;
                height: 100vh;
                background: linear-gradient(to right, #ffffff 0 40%, #e8e7ed 0 60%);
                font-family: "Source Code Pro", monospace;
            }

            .login-container {
                display: flex;
                position: absolute;
                overflow: hidden;
                top: 50%;
                left: 50%;
                width: 850px;
                height: 550px;
                border-radius: 13px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                transform: translate(-50%, -50%);
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                animation: containerAnimation 2s ease-in-out infinite alternate;
            }
            .login-container:hover {
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }
            .login-container > .-banner {
                overflow: hidden;
                width: 60%;
            }
            .login-container > .-banner > .banner-img {
                background-image: url(/images/pictures/tggs.jpg);
                background-size: cover;
                background-repeat: no-repeat;
                width: 100%;
                height: 100%;
                transition: all 0.75s cubic-bezier(0.25, 0.8, 0.25, 1);
                animation: backgroundAnimation 2s ease-in-out infinite alternate;
            }
            .login-container > .-banner > .banner-img:hover {
                transform: scale(1.11);
            }
            .login-container > .-form {
                width: 40%;
                background: #ffffff;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0 20px;
            }
            .login-container > .-form > .header-text {
                box-sizing: border-box;
                font-size: 1rem;
                border-radius: 8px;
                padding: 5px 10px;
                width: 100%;
                text-align: center;
            }
            .login-container > .-form > .block-input {
                width: 100%;
                position: relative;
                margin-top: 20px;
            }
            .login-container > .-form > .block-input > .input {
                width: 100%;
                padding: 10px 10px;
                box-sizing: border-box;
                font-size: 18px;
                border: solid 1px #888888;
                border-radius: 5px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            }
            .login-container > .-form > .block-input > .input:focus {
                outline: none;
                animation: boxshadowRunRight;
                transform-origin: left bottom;
                animation-delay: 0.5s;
                animation-duration: 0.3s;
                animation-fill-mode: forwards;
                animation-timing-function: ease-out;
            }
            .login-container > .-form > .block-input > .input.error {
                box-shadow: 0px 0px 0px 3px #d9534f;
            }
            .login-container > .-form > .block-input > .icon-div {
                box-sizing: border-box;
                position: absolute;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                height: 100%;
                width: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #888888;
                color: white;
            }
            .login-container > .-form > .block-input > .icon-div.error {
                background-color: #d9534f;
            }
            .login-container > .-form > .block-input > .fa-user {
                box-sizing: border-box;
                position: absolute;
                right: 20px;
                top: 50%;
                color: white;
                padding: 20px;
                background-color: #888888;
            }
            .login-container > .-form > .block-input > .fa-key {
                box-sizing: border-box;
                position: absolute;
                right: 20px;
                top: 50%;
                color: white;
                padding: 20px;
                background-color: #888888;
            }
            .login-container > .-form > .error-label {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                margin-top: 10px;
                background-color: #d9534f;
                color: white;
                font-weight: bold;
                border-radius: 8px;
                padding: 5px 10px;
                transform: translateX(0px);
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                animation: errorlabelAnimation 2s ease-in-out infinite alternate;
            }
            .login-container > .-form > .error-label:hover {
                transform: translateX(2px);
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }
            .login-container > .-form > .forgot-button {
                color: #d9534f;
                margin: 20px 0;
                text-decoration: none;
                transform: translateX(0px);
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                background-color: transparent;
            }
            .login-container > .-form > .forgot-button::after {
                margin-top: 5px;
                content: "";
                display: block;
                width: 0;
                height: 2px;
                background: #d9534f;
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                animation: forgotbtnlineAnimation 2s ease-in-out infinite alternate;
            }
            .login-container > .-form > .forgot-button:hover {
                transform: translateX(2px);
            }
            .login-container > .-form > .forgot-button:hover::after {
                width: 100%;
            }
            .login-container > .-form > .signin-button {
                cursor: pointer;
                padding: 10px 20px;
                font-size: 16px;
                width: 100%;
                background-color: #f77100;
                color: white;
                font-weight: bold;
                border-radius: 8px;
                border: none;
                outline: none;
                transform: translateX(0px);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                animation: btnsigninAnimation 2s ease-in-out infinite alternate;
            }
            .login-container > .-form > .signin-button:hover {
                transform: translateX(2px);
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }
            .login-container > .-form > .signin-button:active {
                transform: translateX(-2px);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            }

            @keyframes boxshadowRunRight {
                0% {
                    box-shadow: 0px 3px 0px 0px #0275d8;
                }
                25% {
                    box-shadow: 3px 3px 0px 0px #0275d8;
                }
                50% {
                    box-shadow: 3px 0px 0px 3px #0275d8;
                }
                100% {
                    box-shadow: 0px 0px 0px 3px #0275d8;
                }
            }
            @keyframes containerAnimation {
                0% {
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                    transform: translate(-50%, -50%);
                }
                100% {
                    box-shadow: 0 24px 38px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                    transform: translate(-50%, -55%);
                }
            }

            @keyframes errorlabelAnimation {
                0% {
                    transform: translateY(0px);
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                }
                100% {
                    transform: translateY(-2px);
                    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                }
            }
            @keyframes btnsigninAnimation {
                0% {
                    transform: translateY(0px);
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                }
                100% {
                    transform: translateY(-2px);
                    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                }
            }
            @keyframes forgotbtnlineAnimation {
                0% {
                    width: 0;
                }
                100% {
                    width: 100%;
                }
            }
            @media (max-width: 767.98px) {
                .login-container {
                    flex-direction: column;
                    width: 80%;
                    height: 600px;
                }
                .login-container > .-banner {
                    width: 100%;
                    height: 100%;
                }
                .login-container > .-form {
                    width: unset;
                    padding: 20px;
                }
            }


        </style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

@if(\Session::has('errors'))

    <?php

$mas = Session::get('errors');
echo "<script type='text/javascript'> window.alert('$mas');</script>"; ?>


    @endif

        <div class="login-container">

            <div class="-banner">
                <div class="banner-img"></div>
            </div>
            <form action="{{url('/')}}" method="POST" class="-form" autocomplete="off">
            {{csrf_field()}}
            <img src="/images/pictures/555.png" style="width:120px;">
                <h6  class="header-text">Sign in to take the exam.</h6>
                <div style="text-align:center;margin-bottom:10px;">
                <a class="" href="https://account.kmutnb.ac.th" target="_blank"><img src="http://account.kmutnb.ac.th/web/images/icit_account_logo.png" alt="ICIT Account" style="width:100px;"></a>
                </div>
                <div class="block-input">
                    <input
                        class="username-input input"
                        type="text"
                        name="txtUsername"
                        placeholder="Username"
                        id=""
                          required/>

                        <div class="icon-div">
            <i class="fa fa-user" aria-hidden="true"></i>
          </div>
                </div>
                <div class="block-input">
                    <input
                        class="password-input input "
                        type="password"
                        name="txtPassword"
                        placeholder="Password"
                        id=""
                        required />

                        <div class="icon-div ">
            <i class="fa fa-key" aria-hidden="true"></i>
          </div>

                </div>
                @if(\Session::has('error'))

<label class="error-label" for="password">{{ \Session::get('error') }}</label>

@endif
                <p style="color:green;"><ins>เข้าสู่ระบบด้วย ICIT Account</ins></p>
                <a class="" href="https://account.kmutnb.ac.th/web/recovery/index" target="_blank"><i class="fa fa-history" aria-hidden="true"></i> ลืมรหัสผ่าน</a>
                <br>







                <button class="signin-button"     type="submit">sign in</button>
            </form>
        </div>
    </body>

@stop
