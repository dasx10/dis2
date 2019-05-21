<meta charset="UTF-8">
<title>User Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="/public/css/user/bootstrap.css">
<link rel="stylesheet" href="/public/css/user/bootstrap-grid.css">
<link rel="stylesheet" href="/public/css/user/bootstrap-reboot.css">
<link rel="stylesheet" href="/public/css/jquery.sweet-modal.css">
<link rel="stylesheet" href="/public/css/user/fonts.css">
<link rel="stylesheet" href="/public/css/user/style.css">
<style>
    body{
        position: relative!important;
    }
    .sk-circle{
        display: none;
        z-index: 10001;
        width: 70px;
        height: 70px;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        margin: auto;
    }
    .sk-circle .sk-child {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0; }
    .sk-circle .sk-child:before {
        content: '';
        display: block;
        margin: 0 auto;
        width: 15%;
        height: 15%;
        background-color: #333;
        border-radius: 100%;
        animation: sk-circleBounceDelay 1.2s infinite ease-in-out both; }
    .sk-circle .sk-circle2 {
        transform: rotate(30deg); }
    .sk-circle .sk-circle3 {
        transform: rotate(60deg); }
    .sk-circle .sk-circle4 {
        transform: rotate(90deg); }
    .sk-circle .sk-circle5 {
        transform: rotate(120deg); }
    .sk-circle .sk-circle6 {
        transform: rotate(150deg); }
    .sk-circle .sk-circle7 {
        transform: rotate(180deg); }
    .sk-circle .sk-circle8 {
        transform: rotate(210deg); }
    .sk-circle .sk-circle9 {
        transform: rotate(240deg); }
    .sk-circle .sk-circle10 {
        transform: rotate(270deg); }
    .sk-circle .sk-circle11 {
        transform: rotate(300deg); }
    .sk-circle .sk-circle12 {
        transform: rotate(330deg); }
    .sk-circle .sk-circle2:before {
        animation-delay: -1.1s; }
    .sk-circle .sk-circle3:before {
        animation-delay: -1s; }
    .sk-circle .sk-circle4:before {
        animation-delay: -0.9s; }
    .sk-circle .sk-circle5:before {
        animation-delay: -0.8s; }
    .sk-circle .sk-circle6:before {
        animation-delay: -0.7s; }
    .sk-circle .sk-circle7:before {
        animation-delay: -0.6s; }
    .sk-circle .sk-circle8:before {
        animation-delay: -0.5s; }
    .sk-circle .sk-circle9:before {
        animation-delay: -0.4s; }
    .sk-circle .sk-circle10:before {
        animation-delay: -0.3s; }
    .sk-circle .sk-circle11:before {
        animation-delay: -0.2s; }
    .sk-circle .sk-circle12:before {
        animation-delay: -0.1s; }

    @keyframes sk-circleBounceDelay {
        0%, 80%, 100% {
            transform: scale(0); }
        40% {
            transform: scale(1); } }
</style>
