@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
        @include('admin.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid">
                <div class="card box-shadow">

                </div>
            </div>
        </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script>
        var str = "{\n" +
            "    \"success\": true,\n" +
            "    \"message\": \"The list was successfully received\",\n" +
            "    \"response\": [\n" +
            "        {\n" +
            "            \"id\": 4,\n" +
            "            \"first_name\": \"Bohdan\",\n" +
            "            \"last_name\": \"Piskun\",\n" +
            "            \"email\": \"calmadeveloper@gmail.com\",\n" +
            "            \"age\": \"30\",\n" +
            "            \"gender\": \"Male\",\n" +
            "            \"photo_url\": \"https://graph.facebook.com/279608945959395/picture?type=large\",\n" +
            "            \"photo_url_small\": \"https://graph.facebook.com/279608945959395/picture?type=large\",\n" +
            "            \"login_with\": \"facebook\",\n" +
            "            \"is_private\": \"0\",\n" +
            "            \"qr_code\": \"jjNcRMsYno\",\n" +
            "            \"qr_photo_url\": \"http://bean.yobibyte.in.ua/public/qr_codes/1539084276_jjNcRMsYno.png\",\n" +
            "            \"notifications_turn_all\": \"1\",\n" +
            "            \"notifications_join_your_events\": \"1\",\n" +
            "            \"notifications_follow_your_business\": \"1\",\n" +
            "            \"quickblox_users_id\": \"62907875\",\n" +
            "            \"description\": \"31\",\n" +
            "            \"events_count\": \"2\",\n" +
            "            \"photos_count\": \"6\",\n" +
            "            \"connections_count\": \"2\",\n" +
            "            \"chat_exists\": \"1\",\n" +
            "            \"chat_data\": {\n" +
            "                \"id\": 4,\n" +
            "                \"users_id\": \"4\",\n" +
            "                \"chat_name\": \"chat_name123\",\n" +
            "                \"chat_photo_url\": \"\",\n" +
            "                \"chat_photo_url_small\": \"\",\n" +
            "                \"selected_people\": \"5\",\n" +
            "                \"quickblox_chat_id\": \"5bc89924a28f9a21778753f5\",\n" +
            "                \"occupants_ids\": \"62907972,62907875\",\n" +
            "                \"chat_type\": \"basic\",\n" +
            "                \"created_at\": \"1539873060\"\n" +
            "            },\n" +
            "            \"is_following\": \"0\",\n" +
            "            \"beans_count\": \"2\"\n" +
            "        }\n" +
            "    ]\n" +
            "}";
    </script>
@endsection